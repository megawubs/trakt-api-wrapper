<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 14/03/15
 * Time: 12:22
 */

namespace Wubs\Trakt\Request\Parameters;


class AbstractParameter
{
    /**
     * @var
     */
    protected $value;

    /**
     * @param $value
     */
    protected function __construct($value)
    {

        $this->value = $value;
    }

    public function __toString()
    {
        return (string)$this->value;
    }

    /**
     * @param $value
     * @return static
     */
    public static function set($value)
    {
        return new static($value);
    }
}