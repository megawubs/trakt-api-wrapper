<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 01/03/15
 * Time: 21:27
 */

namespace Wubs\Trakt\Request\Parameters;


class Days implements Parameter
{
    private $num;

    /**
     * @param int $num
     */
    public function __construct($num = 7)
    {
        $this->num = $num;
    }

    public static function standard()
    {
        return new static();
    }

    public static function num($num)
    {
        return new static($num);
    }

    public function __toString()
    {
        return (string)$this->num;
    }
}