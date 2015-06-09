<?php


namespace Wubs\Trakt;


class Api
{
    /**
     * @var ClientId
     */
    private $id;

    /**
     * @param ClientId $id
     */
    public function __construct(ClientId $id)
    {
        $this->id = $id;
    }
}