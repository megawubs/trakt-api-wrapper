<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 12/03/15
 * Time: 12:50
 */

namespace Wubs\Trakt\Request\Parameters;


class CommentId
{
    private $id;

    /**
     * @param $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    public static function set($id)
    {
        return new static($id);
    }

    function __toString()
    {
        return (string)$this->id;
    }


}