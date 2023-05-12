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
        $this->options['headers']['Authorization'] = sprintf(
            $this->options['headers']['Authorization'],
            $this->config['token']
        );
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
     * @param int $page
     * @param int $limit
     * @return ResponseInterface
     * @throws GuzzleException
     * Todo: make pagination optional
     */
    public function getSystemList(int $page, int $limit): ResponseInterface
    {
        $this->logger->debug(
            "Getting system list",
        );
        $response = $this->client->get(
            $this->config['url'] . '/systems?page=' . $page . '&limit=' . $limit,
            array_merge_recursive(
                $this->options
            )
        );
        $this->logger->debug("Ship list response", [$response->getBody()->getContents()]);
        return $response;
    }

    /**
     * @param string $systemSymbol
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function getSystem(string $systemSymbol): ResponseInterface
    {
        $this->logger->debug(
            "Getting system details",
        );
        $response = $this->client->get(
            $this->config['url'] . '/systems/'. $systemSymbol,
            array_merge_recursive(
                $this->options
            )
        );
        $this->logger->debug("Get system response", [$response->getBody()->getContents()]);
        return $response;
    }

    /**
     * @param string $systemSymbol
     * @param int $page
     * @param int $limit
     * @return ResponseInterface
     * @throws GuzzleException
     * Todo: make pagination optional
     */
    public function getSystemWaypointList(string $systemSymbol, int $page, int $limit): ResponseInterface
    {
        $this->logger->debug(
            "Getting system waypoint list",
        );
        $response = $this->client->get(
            $this->config['url'] . '/systems/'. $systemSymbol . '/waypoints?page=' . $page . '&limit=' . $limit,
            array_merge_recursive(
                $this->options
            )
        );
        $this->logger->debug("Get system waypoint list response", [$response->getBody()->getContents()]);
        return $response;
    }

    /**
     * @param string $systemSymbol
     * @param string $waypointSymbol
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function getSystemWaypoint(string $systemSymbol, string $waypointSymbol): ResponseInterface
    {
        $this->logger->debug(
            "Getting system waypoint details",
        );
        $response = $this->client->get(
            $this->config['url'] . '/systems/'. $systemSymbol . '/waypoints/'. $waypointSymbol,
            array_merge_recursive(
                $this->options
            )
        );
        $this->logger->debug("Get system waypoint response", [$response->getBody()->getContents()]);
        return $response;
    }

    /**
     * @param string $systemSymbol
     * @param string $waypointSymbol
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function getSystemWaypointMarket(string $systemSymbol, string $waypointSymbol): ResponseInterface
    {
        $this->logger->debug(
            "Getting system waypoint market listings",
        );
        $response = $this->client->get(
            sprintf(
                '%s/systems/%s/waypoints/%s/market',
                $this->config['url'],
                $systemSymbol,
                $waypointSymbol
            ),
            array_merge_recursive(
                $this->options
            )
        );
        $this->logger->debug("Get system waypoint market response", [$response->getBody()->getContents()]);
        return $response;
    }

    /**
     * @param string $systemSymbol
     * @param string $waypointSymbol
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function getSystemWaypointShipyard(string $systemSymbol, string $waypointSymbol): ResponseInterface
    {
        $this->logger->debug(
            "Getting system waypoint shipyard",
        );
        $response = $this->client->get(
            sprintf(
                '%s/systems/%s/waypoints/%s/shipyard',
                $this->config['url'],
                $systemSymbol,
                $waypointSymbol
            ),
            array_merge_recursive(
                $this->options
            )
        );
        $this->logger->debug("Get system waypoint shipyard response", [$response->getBody()->getContents()]);
        return $response;
    }

    /**
     * @param string $systemSymbol
     * @param string $waypointSymbol
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function getSystemWaypointJumpgate(string $systemSymbol, string $waypointSymbol): ResponseInterface
    {
        $this->logger->debug(
            "Getting system waypoint jump-gate",
        );
        $response = $this->client->get(
            sprintf(
                '%s/systems/%s/waypoints/%s/jump-gate',
                $this->config['url'],
                $systemSymbol,
                $waypointSymbol
            ),
            array_merge_recursive(
                $this->options
            )
        );
        $this->logger->debug("Get system waypoint jump-gate response", [$response->getBody()->getContents()]);
        return $response;
    }

    /**
     * @param int $page
     * @param int $limit
     * @return ResponseInterface
     * @throws GuzzleException
     * Todo: make pagination optional
     */
    public function getFactionList(int $page, int $limit): ResponseInterface
    {
        $this->logger->debug(
            "Getting faction list",
        );
        $response = $this->client->get(
            $this->config['url'] . '/faction?page=' . $page . '&limit=' . $limit,
            array_merge_recursive(
                $this->options
            )
        );
        $this->logger->debug("Faction list response", [$response->getBody()->getContents()]);
        return $response;
    }

    /**
     * @param string $factionSymbol
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function getFaction(string $factionSymbol): ResponseInterface
    {
        $this->logger->debug(
            "Getting faction details",
        );
        $response = $this->client->get(
            $this->config['url'] . '/factions/'. $factionSymbol,
            array_merge_recursive(
                $this->options
            )
        );
        $this->logger->debug("Get faction response", [$response->getBody()->getContents()]);
        return $response;
    }

    /**
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function getMyAgent(): ResponseInterface
    {
        $this->logger->debug(
            "Getting my agent details",
        );
        $response = $this->client->get(
            $this->config['url'] . '/my/agent',
            array_merge_recursive(
                $this->options
            )
        );
        $this->logger->debug("Faction list response", [$response->getBody()->getContents()]);
        return $response;
    }

    /**
     * @param int $page
     * @param int $limit
     * @return ResponseInterface
     * @throws GuzzleException
     * Todo: make pagination optional
     */
    public function getMyContractList(int $page, int $limit): ResponseInterface
    {
        $this->logger->debug(
            "Getting my contract list",
        );
        $response = $this->client->get(
            $this->config['url'] . '/my/contracts?page=' . $page . '&limit=' . $limit,
            array_merge_recursive(
                $this->options
            )
        );
        $this->logger->debug("My contract list response", [$response->getBody()->getContents()]);
        return $response;
    }

    /**
     * @param string $contractId
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function getMyContract(string $contractId): ResponseInterface
    {
        $this->logger->debug(
            "Getting My Contract details",
        );
        $response = $this->client->get(
            $this->config['url'] . '/my/contracts/'. $contractId,
            array_merge_recursive(
                $this->options
            )
        );
        $this->logger->debug("Get My Contract response", [$response->getBody()->getContents()]);
        return $response;
    }

    /**
     * @param string $contractId
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function acceptMyContract(string $contractId): ResponseInterface
    {
        $this->logger->debug(
            "Post accept My Contract details",
        );
        $response = $this->client->post(
            $this->config['url'] . '/my/contracts/'. $contractId . '/accept',
            array_merge_recursive(
                $this->options,
                []
            )
        );
        $this->logger->debug("Accept My Contract response", [$response->getBody()->getContents()]);
        return $response;
    }

    /**
     * @param string $contractId
     * @param string $shipSymbol
     * @param string $tradeSymbol
     * @param int $units
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function deliverMyContract(
        string $contractId,
        string $shipSymbol,
        string $tradeSymbol,
        int $units
    ): ResponseInterface {
        $this->logger->debug(
            "post Deliver My Contract",
        );
        $response = $this->client->post(
            $this->config['url'] . '/my/contracts/'. $contractId . '/deliver',
            array_merge_recursive(
                $this->options,
                [
                    'shipSymbol' => $shipSymbol,
                    'tradeSymbol' => $tradeSymbol,
                    'units' => $units
                ]
            )
        );
        $this->logger->debug("post deliver My Contract response", [$response->getBody()->getContents()]);
        return $response;
    }

    /**
     * @param string $contractId
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function fulfillMyContract(string $contractId): ResponseInterface
    {
        $this->logger->debug(
            "Post fulfill My Contract details",
        );
        $response = $this->client->post(
            $this->config['url'] . '/my/contracts/'. $contractId . '/fulfill',
            array_merge_recursive(
                $this->options,
                []
            )
        );
        $this->logger->debug("Fulfill My Contract response", [$response->getBody()->getContents()]);
        return $response;
    }

    /**
     * @param int $page
     * @param int $limit
     * @return ResponseInterface
     * @throws GuzzleException
     * Todo: make pagination optional
     */
    public function getMyShipList(int $page, int $limit): ResponseInterface
    {
        $this->logger->debug(
            "Getting my ship list",
        );
        $response = $this->client->get(
            $this->config['url'] . '/my/ships?page=' . $page . '&limit=' . $limit,
            array_merge_recursive(
                $this->options
            )
        );
        $this->logger->debug("My ships list response", [$response->getBody()->getContents()]);
        return $response;
    }

    /**
     * @param ShipType $shipType
     * @param string $waypointSymbol
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function buyShip(ShipType $shipType, string $waypointSymbol): ResponseInterface
    {
        $this->logger->debug(
            "Buying new ship {type} at location {waypointSymbol}",
            ['waypointSymbol' => $waypointSymbol, 'shipType' => $shipType]
        );
        $response = $this->client->post(
            $this->config['url'] . '/my/ships',
            array_merge_recursive(
                $this->options,
                [
                    'json' => [
                        'shipType' => $shipType->name,
                        'waypointSymbol' => $waypointSymbol
                    ]
                ]
            )
        );
        $this->logger->debug("Ship buying response", [$response->getBody()->getContents()]);
        return $response;
    }

    /**
     * @param string $shipSymbol
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function getMyShip(string $shipSymbol): ResponseInterface
    {
        $this->logger->debug(
            "Getting My Ship details",
        );
        $response = $this->client->get(
            $this->config['url'] . '/my/ships/'. $shipSymbol,
            array_merge_recursive(
                $this->options
            )
        );
        $this->logger->debug("Get My Ship response", [$response->getBody()->getContents()]);
        return $response;
    }

    /**
     * @param string $shipSymbol
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function getMyShipCargo(string $shipSymbol): ResponseInterface
    {
        $this->logger->debug(
            "Getting My Ship cargo",
        );
        $response = $this->client->get(
            $this->config['url'] . '/my/ships/'. $shipSymbol . '/cargo',
            array_merge_recursive(
                $this->options
            )
        );
        $this->logger->debug("Get My Ship cargo response", [$response->getBody()->getContents()]);
        return $response;
    }

    /**
     * @param string $shipSymbol
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function orbitMyShip(string $shipSymbol): ResponseInterface
    {
        $this->logger->debug(
            "post orbit My Ship",
        );
        $response = $this->client->post(
            $this->config['url'] . '/my/ships/'. $shipSymbol . '/orbit',
            array_merge_recursive(
                $this->options,
                []
            )
        );
        $this->logger->debug("post orbit My Ship response", [$response->getBody()->getContents()]);
        return $response;
    }

    /**
     * @param string $shipSymbol
     * @param OreType $produce
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function refineOreOnMyShip(string $shipSymbol, OreType $produce): ResponseInterface
    {
        $this->logger->debug(
            "post refine My Ship",
        );
        $response = $this->client->post(
            $this->config['url'] . '/my/ships/'. $shipSymbol . '/refine',
            array_merge_recursive(
                $this->options,
                [
                    'json' => [
                        'produce' => $produce->name
                    ]
                ]
            )
        );
        $this->logger->debug("post refine My Ship response", [$response->getBody()->getContents()]);
        return $response;
    }

    /**
     * @param string $shipSymbol
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function chartMyShip(string $shipSymbol): ResponseInterface
    {
        $this->logger->debug(
            "post chart My Ship",
        );
        $response = $this->client->post(
            $this->config['url'] . '/my/ships/'. $shipSymbol . '/chart',
            array_merge_recursive(
                $this->options,
                []
            )
        );
        $this->logger->debug("post chart My Ship response", [$response->getBody()->getContents()]);
        return $response;
    }

    /**
     * @param string $shipSymbol
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function getMyShipCooldown(string $shipSymbol): ResponseInterface
    {
        $this->logger->debug(
            "Getting My Ship Cooldown",
        );
        $response = $this->client->get(
            $this->config['url'] . '/my/ships/'. $shipSymbol . '/cooldown',
            array_merge_recursive(
                $this->options
            )
        );
        $this->logger->debug("Get My Ship cooldown response", [$response->getBody()->getContents()]);
        return $response;
    }

    /**
     * @param string $shipSymbol
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function dockMyShip(string $shipSymbol): ResponseInterface
    {
        $this->logger->debug(
            "post dock My Ship",
        );
        $response = $this->client->post(
            $this->config['url'] . '/my/ships/'. $shipSymbol . '/dock',
            array_merge_recursive(
                $this->options,
                []
            )
        );
        $this->logger->debug("post dock My Ship response", [$response->getBody()->getContents()]);
        return $response;
    }

    /**
     * @description If you want to target specific yields for an extraction, you can survey a waypoint, such as an
     *              asteroid field, and send the survey in the body of the extract request. Each survey may have
     *              multiple deposits, and if a symbol shows up more than once, that indicates a higher chance of
     *              extracting that resource.\n\nYour ship will enter a cooldown between consecutive survey requests.
     *              Surveys will eventually expire after a period of time. Multiple ships can use the
     *              same survey for extraction.
     * @param string $shipSymbol
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function surveyMyShip(string $shipSymbol): ResponseInterface
    {
        $this->logger->debug(
            "post dock My Ship",
        );
        $response = $this->client->post(
            $this->config['url'] . '/my/ships/'. $shipSymbol . '/survey',
            array_merge_recursive(
                $this->options,
                []
            )
        );
        $this->logger->debug("post survey My Ship response", [$response->getBody()->getContents()]);
        return $response;
    }

    /**
     * @description Extract resources from the waypoint into your ship. Send an optional survey as the payload to
     *              target specific yields.
     * @param string $shipSymbol
     * @param Survey|null $survey
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function extractOreMyShip(string $shipSymbol, ?Survey $survey = null): ResponseInterface
    {
        $this->logger->debug(
            "post extract My Ship",
        );
        $data = [];
        if (!empty($survey)) {
            $data['survey'] = $survey;
        }

        $response = $this->client->post(
            $this->config['url'] . '/my/ships/'. $shipSymbol . '/extract',
            array_merge_recursive(
                $this->options,
                [
                    'json' => $data
                ]
            )
        );
        $this->logger->debug("post extract My Ship response", [$response->getBody()->getContents()]);
        return $response;
    }

    /**
     * @description Jettison cargo from your ship's cargo hold.
     * @param string $shipSymbol
     * @param string $symbol
     * @param int $units
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function jettisonFromMyShip(string $shipSymbol, string $symbol, int $units = 1): ResponseInterface
    {
        $this->logger->debug(
            "post jettison My Ship",
        );
        $response = $this->client->post(
            $this->config['url'] . '/my/ships/'. $shipSymbol . '/jettison',
            array_merge_recursive(
                $this->options,
                [
                    'json' => [
                        'symbol' => $symbol,
                        'units'  => $units
                    ]
                ]
            )
        );
        $this->logger->debug("post refine My Ship response", [$response->getBody()->getContents()]);
        return $response;
    }

    /**
     * @description Jump your ship instantly to a target system. Unlike other forms of navigation, jumping requires
     *              a unit of antimatter.
     * @param string $shipSymbol
     * @param string $systemSymbol
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function jumpMyShip(string $shipSymbol, string $systemSymbol): ResponseInterface
    {
        $this->logger->debug(
            "post jump My Ship",
        );
        $response = $this->client->post(
            $this->config['url'] . '/my/ships/'. $shipSymbol . '/jump',
            array_merge_recursive(
                $this->options,
                [
                    'json' => [
                        'systemSymbol' => $systemSymbol
                    ]
                ]
            )
        );
        $this->logger->debug("post jump My Ship response", [$response->getBody()->getContents()]);
        return $response;
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
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function navigateMyShip(string $shipSymbol, string $waypointSymbol): ResponseInterface
    {
        $this->logger->debug(
            "post navigate My Ship",
        );
        $response = $this->client->post(
            $this->config['url'] . '/my/ships/'. $shipSymbol . '/navigate',
            array_merge_recursive(
                $this->options,
                [
                    'json' => [
                        'waypointSymbol' => $waypointSymbol
                    ]
                ]
            )
        );
        $this->logger->debug("post navigate My Ship response", [$response->getBody()->getContents()]);
        return $response;
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
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function warpMyShip(string $shipSymbol, string $waypointSymbol): ResponseInterface
    {
        $this->logger->debug(
            "post warp My Ship",
        );
        $response = $this->client->post(
            $this->config['url'] . '/my/ships/'. $shipSymbol . '/warp',
            array_merge_recursive(
                $this->options,
                [
                    'json' => [
                        'waypointSymbol' => $waypointSymbol
                    ]
                ]
            )
        );
        $this->logger->debug("post warp My Ship response", [$response->getBody()->getContents()]);
        return $response;
    }

    /**
     * @description Sell cargo from your ship's cargo hold.
     * @param string $shipSymbol
     * @param string $symbol
     * @param int $units
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function sellFromMyShip(string $shipSymbol, string $symbol, int $units = 1): ResponseInterface
    {
        $this->logger->debug(
            "post sell from My Ship",
        );
        $response = $this->client->post(
            $this->config['url'] . '/my/ships/'. $shipSymbol . '/sell',
            array_merge_recursive(
                $this->options,
                [
                    'json' => [
                        'symbol' => $symbol,
                        'units'  => $units
                    ]
                ]
            )
        );
        $this->logger->debug("post sell from My Ship response", [$response->getBody()->getContents()]);
        return $response;
    }

    /**
     * @description Activate your ship's sensor arrays to scan for system information.
     * @param string $shipSymbol
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function scanSystemsAtMyShip(string $shipSymbol): ResponseInterface
    {
        $this->logger->debug(
            "post scan system My Ship",
        );
        $response = $this->client->post(
            $this->config['url'] . '/my/ships/'. $shipSymbol . '/scan/systems',
            array_merge_recursive(
                $this->options,
                []
            )
        );
        $this->logger->debug("post scan system My Ship response", [$response->getBody()->getContents()]);
        return $response;
    }

    /**
     * @description Activate your ship's sensor arrays to scan for waypoint information.
     * @param string $shipSymbol
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function scanWaypointsAtMyShip(string $shipSymbol): ResponseInterface
    {
        $this->logger->debug(
            "post scan waypoints My Ship",
        );
        $response = $this->client->post(
            $this->config['url'] . '/my/ships/'. $shipSymbol . '/scan/waypoints',
            array_merge_recursive(
                $this->options,
                []
            )
        );
        $this->logger->debug("post scan waypoints My Ship response", [$response->getBody()->getContents()]);
        return $response;
    }

    /**
     * @description Activate your ship's sensor arrays to scan for ship information.
     * @param string $shipSymbol
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function scanShipsAtMyShip(string $shipSymbol): ResponseInterface
    {
        $this->logger->debug(
            "post scan ships My Ship",
        );
        $response = $this->client->post(
            $this->config['url'] . '/my/ships/'. $shipSymbol . '/scan/ships',
            array_merge_recursive(
                $this->options,
                []
            )
        );
        $this->logger->debug("post scan waypoints My Ship response", [$response->getBody()->getContents()]);
        return $response;
    }

    /**
     * @description Refuel your ship from the local market.
     * @param string $shipSymbol
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function refuelMyShip(string $shipSymbol): ResponseInterface
    {
        $this->logger->debug(
            "post refuel My Ship",
        );
        $response = $this->client->post(
            $this->config['url'] . '/my/ships/'. $shipSymbol . '/refuel',
            array_merge_recursive(
                $this->options,
                []
            )
        );
        $this->logger->debug("post refuel My Ship response", [$response->getBody()->getContents()]);
        return $response;
    }

    /**
     * @description Purchase cargo from local market to your ship's cargo hold.
     * @param string $shipSymbol
     * @param string $symbol
     * @param int $units
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function purchaseToMyShip(string $shipSymbol, string $symbol, int $units = 1): ResponseInterface
    {
        $this->logger->debug(
            "post purchase to My Ship",
        );
        $response = $this->client->post(
            $this->config['url'] . '/my/ships/'. $shipSymbol . '/purchase',
            array_merge_recursive(
                $this->options,
                [
                    'json' => [
                        'symbol' => $symbol,
                        'units'  => $units
                    ]
                ]
            )
        );
        $this->logger->debug("post purchase to My Ship response", [$response->getBody()->getContents()]);
        return $response;
    }

    /**
     * @description Transfer cargo between ships.
     * @param string $fromShipSymbol
     * @param string $toShipSymbol
     * @param string $symbol
     * @param int $units
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function transferFromMyShip(
        string $fromShipSymbol,
        string $toShipSymbol,
        string $symbol,
        int $units = 1
    ): ResponseInterface {
        $this->logger->debug(
            "post transfer from My Ship",
        );
        $response = $this->client->post(
            $this->config['url'] . '/my/ships/'. $fromShipSymbol . '/transfer',
            array_merge_recursive(
                $this->options,
                [
                    'json' => [
                        'tradeSymbol' => $symbol,
                        'units'  => $units,
                        'shipSymbol' => $toShipSymbol
                    ]
                ]
            )
        );
        $this->logger->debug("post transfer from My Ship response", [$response->getBody()->getContents()]);
        return $response;
    }

    /**
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function getServerStatus(): ResponseInterface
    {
        $this->logger->debug(
            "Getting server status",
        );
        var_dump($this->config['url']);
        var_dump($this->options);

        $response = $this->client->get(
            $this->config['url'] //,
            //$this->options
        );
        $this->logger->debug("Get server status response", [$response->getBody()->getContents()]);
        return $response;
    }
}
