<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 18/03/15
 * Time: 15:02
 */

namespace Wubs\Trakt\Response\Handlers\Movies;


use Wubs\Trakt\Media\Movie;
use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\Movies\MovieId;
use Wubs\Trakt\Request\Parameters\Language;
use Wubs\Trakt\Request\Parameters\MediaId;
use Wubs\Trakt\Request\RequestType;

class Translations extends AbstractRequest
{
    use MovieId;
    /**
     * @var Language
     */
    private $language;

    /**
     * @param MediaId $id
     * @param Language $language
     */
    public function __construct(MediaId $id, Language $language)
    {
        parent::__construct();
        $this->id = $id;
        $this->language = $language;
    }

    public function getRequestType()
    {
        return RequestType::GET;
    }

    /**
     * @return Language
     */
    public function getLanguage()
    {
        return $this->language;
    }


    public function getUri()
    {
        return "movies/:id/translations/:language";
    }
}