<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 26/02/15
 * Time: 00:29
 */

namespace Wubs\Trakt\Response;


class DefaultResponseHandler extends AbstractResponse
{
    public function handle()
    {
        return $this->getResponse()->json();
    }
}