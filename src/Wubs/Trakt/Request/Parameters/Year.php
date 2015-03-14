<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 14/03/15
 * Time: 12:19
 */

namespace Wubs\Trakt\Request\Parameters;


use Carbon\Carbon;

class Year extends AbstractParameter implements Parameter
{
    public static function standard()
    {
        return new static(Carbon::now()->year);
    }
}