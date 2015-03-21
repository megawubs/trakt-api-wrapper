<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 18/03/15
 * Time: 14:17
 */

namespace Wubs\Trakt\Request\Comments;


trait CommentSize
{
    /**
     * @return bool
     */
    private function commentIsNotAllowedSize()
    {
        return (str_word_count($this->comment) < 5);
    }
}