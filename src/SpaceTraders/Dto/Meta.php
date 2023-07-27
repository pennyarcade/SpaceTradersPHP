<?php

namespace App\SpaceTraders\Dto;

use App\Common\Deserializable;
use JsonSerializable;

class Meta implements JsonSerializable, Deserializable
{
    protected int $total;
    protected int $page;
    protected int $limit;

    /**
     * @param int $total
     * @param int $page
     * @param int $limit
     */
    public function __construct(int $total, int $page, int $limit)
    {
        $this->total = $total;
        $this->page = $page;
        $this->limit = $limit;
    }

    /**
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }

    /**
     * @param  int $total
     * @return Meta
     */
    public function setTotal(int $total): Meta
    {
        $this->total = $total;
        return $this;
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @param  int $page
     * @return Meta
     */
    public function setPage(int $page): Meta
    {
        $this->page = $page;
        return $this;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @param  int $limit
     * @return Meta
     */
    public function setLimit(int $limit): Meta
    {
        $this->limit = $limit;
        return $this;
    }

    public static function fromArray(array $data): self
    {
        // TODO: Implement fromArray() method.
    }

    public function jsonSerialize(): mixed
    {
        // TODO: Implement jsonSerialize() method.
    }
}
