<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 01/03/15
 * Time: 22:30
 */

namespace Wubs\Trakt\Media;


interface Media
{
    public function __construct($json);

    public function getTitle();

    public function getIds();

    public static function find($searchParam);
}