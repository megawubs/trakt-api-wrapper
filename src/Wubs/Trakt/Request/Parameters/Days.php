<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 01/03/15
 * Time: 21:27
 */

namespace Wubs\Trakt\Request\Parameters;


class Days extends AbstractParameter implements Parameter
{
    /**
     * @param int $value
     */
    public function __construct($value = 7)
    {
        $this->value = (string)$value;
    }

    public static function standard()
    {
        return new static();
    }

    public static function set($num)
    {
        return new static($num);
    }
}