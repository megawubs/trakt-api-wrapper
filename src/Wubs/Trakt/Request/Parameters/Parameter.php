<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 01/03/15
 * Time: 22:04
 */

namespace Wubs\Trakt\Request\Parameters;


interface Parameter
{

    public function __toString();

    public static function set($value);

    public static function standard();
}