<?php

namespace App\SpaceTraders;

use App\Logger\LoggerFactory;
use App\SpaceTraders\Dto\Survey;
use App\SpaceTraders\Enum\FactionName;
use App\SpaceTraders\Enum\OreType;
use App\SpaceTraders\Enum\ShipNavFlightMode;
use App\SpaceTraders\Enum\ShipType;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Monolog\Logger;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\ResponseInterface;

class ApiService
{
    private array $config;
    private Logger $logger;
    private Client $client;
    private array $options;

    /**
     * @param ContainerInterface $container
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __construct(ContainerInterface $container)
    {
        /** @var array $settings */
        $settings = $container->get('settings');
        $this->config = $settings[self::class];
        $this->logger = $container->get(LoggerFactory::class)->getRotatingFileLogger('CheckMkService');

        $this->client = new Client(
            array_merge_recursive(
                $container->get('settings')[Client::class],
                []
            )
        );

        $this->options = ['headers' => $this->config['headers']];
    }

    /**
     * toggles RequestExceptions on Guzzle client
     * @return bool
     */
    public function toggleExceptions(): bool
    {
        if (!array_key_exists('http_errors', $this->options)
            || $this->options['http_errors'] === true
        ) {
            $this->options['http_errors'] = false;
        } else {
            $this->options['http_errors'] = true;
        }
        return $this->options['http_errors'];
    }

    /**
     * @param int|null $page
     * @param int|null $limit
     * @return array|array[]
     */
    private function buildPaginationParameters(?int $page = null, ?int $limit = null): array
    {
        if (empty($page) && empty($limit)) {
            return [];
        }

        // handle pagination
        $params = ['query' => []];
        if (is_int($page)) {
            $params['query']['page'] = $page;
        }
        if (is_int($limit)) {
            $params['query']['limit'] = $limit;
        }
        return $params;
    }

    /**
     * @param string|null $token
     * @return array|array[]
     */
    private function buildAuthorizationHeader(?string $token = null): array
    {
        // handle token
        if (!empty($token)) {
            return [
                'header' => [
                    'Authorization' => sprintf($this->config['authHeader'], $this->config['token'])
                ]
            ];
        }
        return [];
    }

    /**
     * @param array $data
     * @return array|array[]
     */
    private function buildJsonBody(array $data = []): array
    {
        // handle token
        if (!empty($data)) {
            return [
                'json' => $data
            ];
        }
        return [];
    }

    /**
     * @param string|array $endpoint
     * @param int|null $page
     * @param int|null $limit
     * @param string|null $token
     * @return ResponseInterface
     * @throws GuzzleException
     */
    private function paginatedGetRequest(
        string|array $endpoint = '',
        ?int    $page = null,
        ?int    $limit = null,
        ?string $token = null
    ): ResponseInterface {
        $this->logger->debug(
            "GET {$endpoint}",
            [
                'endpoint' => $endpoint,
                'page'     => $page,
                'limit'    => $limit,
                'usingToken' => !(empty($token)) ? 'yes' : 'no' // don't log sensitive user data ^^
            ]
        );

        $response = $this->client->get(
            $this->config['url'] . ((empty($endpoint)) ? '/' . $endpoint : ''),
            array_merge_recursive(
                $this->options,
                $this->buildPaginationParameters($page, $limit),
                $this->buildAuthorizationHeader($token)
            )
        );
        $this->logger->debug(
            "GET {endpoint} response: {statusCode}",
            [
                'endpoint' => $endpoint,
                'content' => $response->getBody()->getContents(),
                'headers' => $response->getHeaders(),
                'statusCode' => $response->getStatusCode()
            ]
        );
        return $response;
    }

    /**
     * @param string|array $endpoint
     * @param array $jsonData
     * @param string|null $token
     * @return ResponseInterface
     * @throws GuzzleException
     */
    private function postRequest(
        string|array $endpoint = '',
        array $jsonData = [],
        ?string $token = null,
    ): ResponseInterface {
        $this->logger->debug(
            "GET {$endpoint}",
            [
                'endpoint'   => $endpoint,
                'jsonData'   => $jsonData,
                'usingToken' => !(empty($token)) ? 'yes' : 'no' // don't log sensitive user data ^^
            ]
        );

        $response = $this->client->post(
            $this->config['url'] . ((empty($endpoint)) ? '/' . $endpoint : ''),
            array_merge_recursive(
                $this->options,
                $this->buildJsonBody($jsonData),
                $this->buildAuthorizationHeader($token)
            )
        );
        $this->logger->debug(
            "GET {endpoint} response: {statusCode}",
            [
                'endpoint' => $endpoint,
                'content' => $response->getBody()->getContents(),
                'headers' => $response->getHeaders(),
                'statusCode' => $response->getStatusCode()
            ]
        );
        return $response;
    }

    /**
     * @description Creates a new agent and ties it to a temporary Account.
     *              The agent symbol is a 3-14 character string that will represent your agent. This symbol will
     *              prefix the symbol of every ship you own. Agent symbols will be cast to all uppercase characters.
     *              A new agent will be granted an authorization token, a contract with their starting faction,
     *              a command ship with a jump drive, and one hundred thousand credits.
     *              > #### Keep your token safe and secure
     *              >
     *              > Save your token during the alpha phase. There is no way to regenerate this token without starting
     *                a new agent. In the future you will be able to generate and manage your tokens from the
     *                SpaceTraders website.
     *              You can accept your contract using the `/my/contracts/{contractId}/accept` endpoint. You will
     *              want to navigate your command ship to a nearby asteroid field and execute the
     *              `/my/ships/{shipSymbol}/extract` endpoint to mine various types of ores and minerals.
     *              Return to the contract destination and execute the `/my/ships/{shipSymbol}/deliver`
     *              endpoint to deposit goods into the contract.
     *              When your contract is fulfilled, you can call `/my/contracts/{contractId}/fulfill`
     *              to retrieve payment.
     * @param FactionName $faction
     * @param string $symbol
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function register(FactionName $faction, string $symbol): ResponseInterface
    {
        $this->logger->debug(
            "Registering new user {symbol}, faction {faction}",
            ['symbol' => $symbol, 'faction' => $faction]
        );
        $response = $this->client->post(
            $this->config['url'] . '/register',
            array_merge_recursive(
                $this->options,
                [
                    'json' => [
                        'faction' => $faction->name,
                        'symbol' => $symbol
                    ]
                ]
            )
        );
        $this->logger->debug("Register response", [$response->getBody()->getContents()]);
        return $response;
    }

    /**
     * @description Return a list of all systems.
     * @param string $token
     * @param int|null $page
     * @param int|null $limit
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function getSystemList(string $token, ?int $page = null, ?int $limit = null): ResponseInterface
    {
        return $this->paginatedGetRequest('systems', $page, $limit, $token);
    }

    /**
     * @description Get the details of a system.
     * @param string $systemSymbol
     * @param string $token
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function getSystem(string $systemSymbol, string $token): ResponseInterface
    {
        return $this->paginatedGetRequest(
            [
                'systems/{systemSymbol}',
                [
                    'systemSymbol' => $systemSymbol
                ]
            ],
            null,
            null,
            $token
        );
    }

    /**
     * @description Fetch all the waypoints for a given system. System must be charted or a ship must be
     *              present to return waypoint details.
     * @param string $systemSymbol
     * @param string $token
     * @param int|null $page
     * @param int|null $limit
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function getSystemWaypointList(
        string $systemSymbol,
        string $token,
        ?int $page = null,
        ?int $limit = null
    ): ResponseInterface {
        return $this->paginatedGetRequest(
            [
                'systems/{systemSymbol}/waypoints',
                [
                    'systemSymbol' => $systemSymbol
                ]
            ],
            $page,
            $limit,
            $token
        );
    }

    /**
     * @description View the details of a waypoint.
     * @param string $systemSymbol
     * @param string $waypointSymbol
     * @param string $token
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function getSystemWaypoint(string $systemSymbol, string $waypointSymbol, string $token): ResponseInterface
    {
        return $this->paginatedGetRequest(
            [
                'systems/{systemSymbol}/waypoints/{waypointSymbol}',
                [
                    'systemSymbol' => $systemSymbol,
                    'waypointSymbol' => $waypointSymbol
                ]
            ],
            null,
            null,
            $token
        );
    }

    /**
     * @description Retrieve imports, exports and exchange data from a marketplace. Imports can be sold, exports can be
     *              purchased, and exchange goods can be purchased or sold. Send a ship to the waypoint to access trade
     *              good prices and recent transactions.
     * @param string $systemSymbol
     * @param string $waypointSymbol
     * @param string $token
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function getSystemWaypointMarket(
        string $systemSymbol,
        string $waypointSymbol,
        string $token
    ): ResponseInterface {
        return $this->paginatedGetRequest(
            [
                'systems/{systemSymbol}/waypoints/{waypointSymbol}/market',
                [
                    'systemSymbol' => $systemSymbol,
                    'waypointSymbol' => $waypointSymbol
                ]
            ],
            null,
            null,
            $token
        );
    }

    /**
     * @description Get the shipyard for a waypoint.
     * @param string $systemSymbol
     * @param string $waypointSymbol
     * @param string $token
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function getSystemWaypointShipyard(
        string $systemSymbol,
        string $waypointSymbol,
        string $token
    ): ResponseInterface {
        return $this->paginatedGetRequest(
            [
                'systems/{systemSymbol}/waypoints/{waypointSymbol}/shipyard',
                [
                    'systemSymbol' => $systemSymbol,
                    'waypointSymbol' => $waypointSymbol
                ]
            ],
            null,
            null,
            $token
        );
    }

    /**
     * @description Get jump gate details for a waypoint.
     * @param string $systemSymbol
     * @param string $waypointSymbol
     * @param string $token
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function getSystemWaypointJumpgate(
        string $systemSymbol,
        string $waypointSymbol,
        string $token
    ): ResponseInterface {
        return $this->paginatedGetRequest(
            [
                'systems/{systemSymbol}/waypoints/{waypointSymbol}/jump-gate',
                [
                    'systemSymbol' => $systemSymbol,
                    'waypointSymbol' => $waypointSymbol
                ]
            ],
            null,
            null,
            $token
        );
    }

    /**
     * @description List all discovered factions in the game.
     * @param int|null $page
     * @param int|null $limit
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function getFactionList(
        ?int $page = null,
        ?int $limit = null
    ): ResponseInterface {
        return $this->paginatedGetRequest('faction', $page, $limit);
    }

    /**
     * @description View the details of a faction.
     * @param string $factionSymbol
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function getFaction(string $factionSymbol): ResponseInterface
    {
        return $this->paginatedGetRequest(
            [
                'factions/{factionSymbol}',
                [
                    'factionSymbol' => $factionSymbol
                ]
            ]
        );
    }

    /**
     * @description Fetch your agent's details.
     * @param string $token
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function getMyAgent(string $token): ResponseInterface
    {
        return $this->paginatedGetRequest('my/agent', null, null, $token);
    }

    /**
     * @description List all of your contracts.
     * @param string $token
     * @param int|null $page
     * @param int|null $limit
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function getMyContractList(string $token, ?int $page = null, ?int $limit = null): ResponseInterface
    {
        return $this->paginatedGetRequest('my/contracts', $page, $limit, $token);
    }

    /**
     * @description Get the details of a contract by ID.
     * @param string $contractId
     * @param string $token
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function getMyContract(string $contractId, string $token): ResponseInterface
    {
        return $this->paginatedGetRequest(
            [
                'my/contracts/{contractId}',
                [
                    'contractId' => $contractId,
                ]
            ],
            null,
            null,
            $token
        );
    }

    /**
     * @description Accept a contract.
     * @param string $contractId
     * @param string $token
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function acceptMyContract(string $contractId, string $token): ResponseInterface
    {
        return $this->postRequest(
            [
                'my/contracts/{contractId}/accept',
                [
                    'contractId' => $contractId,
                ]
            ],
            [],
            $token
        );
    }

    /**
     * @description Deliver cargo on a given contract.
     * @param string $contractId
     * @param string $shipSymbol
     * @param string $tradeSymbol
     * @param int $units
     * @param string $token
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function deliverMyContract(
        string $contractId,
        string $shipSymbol,
        string $tradeSymbol,
        int $units,
        string $token
    ): ResponseInterface {
        return $this->postRequest(
            [
                'my/contracts/{contractId}/deliver',
                [
                    'contractId' => $contractId,
                ]
            ],
            [
                'shipSymbol' => $shipSymbol,
                'tradeSymbol' => $tradeSymbol,
                'units' => $units
            ],
            $token
        );
    }

    /**
     * @description Fulfill a contract
     * @param string $contractId
     * @param string $token
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function fulfillMyContract(string $contractId, string $token): ResponseInterface
    {
        return $this->postRequest(
            [
                'my/contracts/{contractId}/fulfill',
                [
                    'contractId' => $contractId,
                ]
            ],
            [],
            $token
        );
    }

    /**
     * @description Retrieve all of your ships.
     * @param string $token
     * @param int|null $page
     * @param int|null $limit
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function getMyShipList(string $token, ?int $page = null, ?int $limit = null): ResponseInterface
    {
        return $this->paginatedGetRequest('my/ships', $page, $limit, $token);
    }

    /**
     * @description Purchase a ship.
     * @param ShipType $shipType
     * @param string $waypointSymbol
     * @param string $token
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function buyShip(ShipType $shipType, string $waypointSymbol, string $token): ResponseInterface
    {
        $this->logger->debug(
            "Buying new ship {type} at location {waypointSymbol}",
            ['waypointSymbol' => $waypointSymbol, 'shipType' => $shipType]
        );
        return $this->postRequest(
            'my/ships',
            [
                'shipType' => $shipType->name,
                'waypointSymbol' => $waypointSymbol
            ],
            $token
        );
    }

    /**
     * @description Retrieve the details of your ship.
     * @param string $shipSymbol
     * @param string $token
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function getMyShip(string $shipSymbol, string $token): ResponseInterface
    {
        return $this->paginatedGetRequest(
            [
                'my/ships/{shipSymbol}',
                [
                    'shipSymbol' => $shipSymbol,
                ]
            ],
            null,
            null,
            $token
        );
    }

    /**
     * @description Retrieve the cargo of your ship.
     * @param string $shipSymbol
     * @param string $token
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function getMyShipCargo(string $shipSymbol, string $token): ResponseInterface
    {
        return $this->paginatedGetRequest(
            [
                'my/ships/{shipSymbol}/cargo',
                [
                    'shipSymbol' => $shipSymbol,
                ]
            ],
            null,
            null,
            $token
        );
    }

    /**
     * @description Attempt to move your ship into orbit at it`s current location. The request will only succeed if
     *              your ship is capable of moving into orbit at the time of the request.
     *              The endpoint is idempotent - successive calls will succeed even if the ship is already in orbit.
     * @param string $shipSymbol
     * @param string $token
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function orbitMyShip(string $shipSymbol, string $token): ResponseInterface
    {
        return $this->postRequest(
            [
                '/my/ships/{shipSymbol}/orbit',
                [
                    'shipSymbol' => $shipSymbol,
                ]
            ],
            [],
            $token
        );
    }

    /**
     * @description Attempt to refine the raw materials on your ship. The request will only succeed if your ship is
     *              capable of refining at the time of the request.
     * @param string $shipSymbol
     * @param OreType $produce
     * @param string $token
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function refineOreOnMyShip(string $shipSymbol, OreType $produce, string $token): ResponseInterface
    {
        return $this->postRequest(
            [
                '/my/ships/{shipSymbol}/refine',
                [
                    'shipSymbol' => $shipSymbol,
                ]
            ],
            [
                'produce' => $produce->name
            ],
            $token
        );
    }

    /**
     * @description Command a ship to chart the current waypoint.
     *              Waypoints in the universe are uncharted by default. These locations will not show up in the API
     *              until they have been charted by a ship.
     *              Charting a location will record your agent as the one who created the chart.
     * @param string $shipSymbol
     * @param string $token
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function chartMyShip(string $shipSymbol, string $token): ResponseInterface
    {
        return $this->postRequest(
            [
                '/my/ships/{shipSymbol}/chart',
                [
                    'shipSymbol' => $shipSymbol,
                ]
            ],
            [],
            $token
        );
    }

    /**
     * @description Retrieve the details of your ship's reactor cooldown. Some actions such as activating your jump
     *              drive, scanning, or extracting resources taxes your reactor and results in a cooldown.
     *              Your ship cannot perform additional actions until your cooldown has expired. The duration of your
     *              cooldown is relative to the power consumption of the related modules or mounts for the action taken.
     *              Response returns a 204 status code (no-content) when the ship has no cooldown.
     * @param string $shipSymbol
     * @param string $token
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function getMyShipCooldown(string $shipSymbol, string $token): ResponseInterface
    {
        return $this->paginatedGetRequest(
            [
                'my/ships/{shipSymbol}/cooldown',
                [
                    'shipSymbol' => $shipSymbol,
                ]
            ],
            null,
            null,
            $token
        );
    }

    /**
     * @description Attempt to dock your ship at it´s current location. Docking will only succeed if the waypoint is a
     *              dockable location, and your ship is capable of docking at the time of the request.
     *              The endpoint is idempotent - successive calls will succeed even if the ship is already docked.
     * @param string $shipSymbol
     * @param string $token
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function dockMyShip(string $shipSymbol, string $token): ResponseInterface
    {
        return $this->postRequest(
            [
                '/my/ships/{shipSymbol}/dock',
                [
                    'shipSymbol' => $shipSymbol,
                ]
            ],
            [],
            $token
        );
    }

    /**
     * @description If you want to target specific yields for an extraction, you can survey a waypoint, such as an
     *              asteroid field, and send the survey in the body of the extract request. Each survey may have
     *              multiple deposits, and if a symbol shows up more than once, that indicates a higher chance of
     *              extracting that resource.\n\nYour ship will enter a cooldown between consecutive survey requests.
     *              Surveys will eventually expire after a period of time. Multiple ships can use the
     *              same survey for extraction.
     * @param string $shipSymbol
     * @param string $token
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function surveyMyShip(string $shipSymbol, string $token): ResponseInterface
    {
        return $this->postRequest(
            [
                '/my/ships/{shipSymbol}/dock',
                [
                    'shipSymbol' => $shipSymbol,
                ]
            ],
            [],
            $token
        );
    }

    /**
     * @description Extract resources from the waypoint into your ship. Send an optional survey as the payload to
     *              target specific yields.
     * @param string $shipSymbol
     * @param Survey|null $survey
     * @param string $token
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function extractOreMyShip(string $shipSymbol, ?Survey $survey, string $token): ResponseInterface
    {
        $data = [];
        if (!empty($survey)) {
            $data['survey'] = $survey;
        }

        return $this->postRequest(
            [
                '/my/ships/{shipSymbol}/extract',
                [
                    'shipSymbol' => $shipSymbol,
                ]
            ],
            $data,
            $token
        );
    }

    /**
     * @description Jettison cargo from your ship's cargo hold.
     * @param string $shipSymbol
     * @param string $symbol
     * @param int $units
     * @param string $token
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function jettisonFromMyShip(string $shipSymbol, string $symbol, int $units, string $token): ResponseInterface
    {
        return $this->postRequest(
            [
                '/my/ships/{shipSymbol}/jettison',
                [
                    'shipSymbol' => $shipSymbol,
                ]
            ],
            [
                'symbol' => $symbol,
                'units'  => $units
            ],
            $token
        );
    }

    /**
     * @description Jump your ship instantly to a target system. Unlike other forms of navigation, jumping requires
     *              a unit of antimatter.
     * @param string $shipSymbol
     * @param string $systemSymbol
     * @param string $token
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function jumpMyShip(string $shipSymbol, string $systemSymbol, string $token): ResponseInterface
    {
        return $this->postRequest(
            [
                '/my/ships/{shipSymbol}/jump',
                [
                    'shipSymbol' => $shipSymbol,
                ]
            ],
            [
                'systemSymbol' => $systemSymbol
            ],
            $token
        );
    }

    /**
     * @description Navigate to a target destination. The destination must be located within the same system as the
     *              ship. Navigating will consume the necessary fuel and supplies from the ship's manifest, and will
     *              pay out crew wages from the agent's account.
     *              The returned response will detail the route information including the expected time of arrival.
     *              Most ship actions are unavailable until the ship has arrived at it`s destination.
     *              To travel between systems, see the ship's warp or jump actions.
     * @param string $shipSymbol
     * @param string $waypointSymbol
     * @param string $token
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function navigateMyShip(string $shipSymbol, string $waypointSymbol, string $token): ResponseInterface
    {
        return $this->postRequest(
            [
                '/my/ships/{shipSymbol}/navigate',
                [
                    'shipSymbol' => $shipSymbol,
                ]
            ],
            [
                'waypointSymbol' => $waypointSymbol
            ],
            $token
        );
    }

    /**
     * @description Navigate to a target destination. The destination must be located within the same system as the
     *              ship. Navigating will consume the necessary fuel and supplies from the ship's manifest, and will
     *              pay out crew wages from the agent's account.
     *              The returned response will detail the route information including the expected time of arrival.
     *              Most ship actions are unavailable until the ship has arrived at it`s destination.
     *              To travel between systems, see the ship's warp or jump actions.
     * @param string $shipSymbol
     * @param ShipNavFlightMode $nav
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function updateMyShipNavigation(
        string $shipSymbol,
        ShipNavFlightMode $nav = ShipNavFlightMode::CRUISE
    ): ResponseInterface {
        $this->logger->debug(
            "patch update navigation My Ship",
        );
        $response = $this->client->patch(
            $this->config['url'] . '/my/ships/'. $shipSymbol . '/nav',
            array_merge_recursive(
                $this->options,
                [
                    'json' => [
                        'flightMode' => $nav->name
                    ]
                ]
            )
        );
        $this->logger->debug("patch update navigation My Ship response", [$response->getBody()->getContents()]);
        return $response;
    }

    /**
     * @description Warp your ship to a target destination in another system. Warping will consume the necessary fuel
     *              and supplies from the ship's manifest, and will pay out crew wages from the agent's account.
     *              The returned response will detail the route information including the expected time of arrival.
     *              Most ship actions are unavailable until the ship has arrived at it's destination.
     * @param string $shipSymbol
     * @param string $waypointSymbol
     * @param string $token
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function warpMyShip(string $shipSymbol, string $waypointSymbol, string $token): ResponseInterface
    {
        return $this->postRequest(
            [
                '/my/ships/{shipSymbol}/warp',
                [
                    'shipSymbol' => $shipSymbol,
                ]
            ],
            [
                'waypointSymbol' => $waypointSymbol
            ],
            $token
        );
    }

    /**
     * @description Sell cargo from your ship's cargo hold.
     * @param string $shipSymbol
     * @param string $symbol
     * @param int $units
     * @param string $token
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function sellFromMyShip(string $shipSymbol, string $symbol, int $units, string $token): ResponseInterface
    {
        return $this->postRequest(
            [
                '/my/ships/{shipSymbol}/sell',
                [
                    'shipSymbol' => $shipSymbol,
                ]
            ],
            [
                'symbol' => $symbol,
                'units'  => $units
            ],
            $token
        );
    }

    /**
     * @description Activate your ship's sensor arrays to scan for system information.
     * @param string $shipSymbol
     * @param string $token
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function scanSystemsAtMyShip(string $shipSymbol, string $token): ResponseInterface
    {
        return $this->postRequest(
            [
                '/my/ships/{shipSymbol}/scan/systems',
                [
                    'shipSymbol' => $shipSymbol,
                ]
            ],
            [],
            $token
        );
    }

    /**
     * @description Activate your ship's sensor arrays to scan for waypoint information.
     * @param string $shipSymbol
     * @param string $token
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function scanWaypointsAtMyShip(string $shipSymbol, string $token): ResponseInterface
    {
        return $this->postRequest(
            [
                '/my/ships/{shipSymbol}/scan/waypoints',
                [
                    'shipSymbol' => $shipSymbol,
                ]
            ],
            [],
            $token
        );
    }

    /**
     * @description Activate your ship's sensor arrays to scan for ship information.
     * @param string $shipSymbol
     * @param string $token
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function scanShipsAtMyShip(string $shipSymbol, string $token): ResponseInterface
    {
        return $this->postRequest(
            [
                '/my/ships/{shipSymbol}/scan/ships',
                [
                    'shipSymbol' => $shipSymbol,
                ]
            ],
            [],
            $token
        );
    }

    /**
     * @description Refuel your ship from the local market.
     * @param string $shipSymbol
     * @param string $token
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function refuelMyShip(string $shipSymbol, string $token): ResponseInterface
    {
        return $this->postRequest(
            [
                '/my/ships/{shipSymbol}/scan/refuel',
                [
                    'shipSymbol' => $shipSymbol,
                ]
            ],
            [],
            $token
        );
    }

    /**
     * @description Purchase cargo from local market to your ship's cargo hold.
     * @param string $shipSymbol
     * @param string $symbol
     * @param int $units
     * @param string $token
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function purchaseToMyShip(string $shipSymbol, string $symbol, int $units, string $token): ResponseInterface
    {
        return $this->postRequest(
            [
                '/my/ships/{shipSymbol}/purchase',
                [
                    'shipSymbol' => $shipSymbol,
                ]
            ],
            [
                'symbol' => $symbol,
                'units'  => $units
            ],
            $token
        );
    }

    /**
     * @description Transfer cargo between ships.
     * @param string $fromShipSymbol
     * @param string $toShipSymbol
     * @param string $symbol
     * @param int $units
     * @param string $token
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function transferFromMyShip(
        string $fromShipSymbol,
        string $toShipSymbol,
        string $symbol,
        int $units,
        string $token
    ): ResponseInterface {
        return $this->postRequest(
            [
                '/my/ships/{shipSymbol}/transfer',
                [
                    'shipSymbol' => $fromShipSymbol,
                ]
            ],
            [
                'symbol' => $symbol,
                'units'  => $units,
                'shipSymbol' => $toShipSymbol
            ],
            $token
        );
    }

    /**
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function getServerStatus(): ResponseInterface
    {
        return $this->paginatedGetRequest('');
    }
}
