<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 21/03/15
 * Time: 09:41
 */

namespace Wubs\Trakt\Request\Movies;


use Wubs\Trakt\Request\Parameters\MediaId;

trait MediaIdTrait
{
    /**
     * @var MediaId
     */
    private $id;

    /**
     * @return MediaId
     */
    public function getId()
    {
        return $this->id;
    }
}