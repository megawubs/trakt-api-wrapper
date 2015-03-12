<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 12/03/15
 * Time: 13:12
 */

namespace Wubs\Trakt\Request\Parameters;


class Type implements Parameter
{
    private $type;

    /**
     * @param $type
     */
    protected function __construct($type)
    {
        $this->type = $type;
    }

    public static function movies()
    {
        return new static("movies");
    }

    public static function shows()
    {
        return new static("shows");
    }

    public function __toString()
    {
        return $this->type;
    }

    public static function standard()
    {
        return new static("shows");
    }
}