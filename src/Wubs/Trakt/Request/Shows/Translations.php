<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 18/03/15
 * Time: 15:02
 */

namespace Wubs\Trakt\Request\Shows;

use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\Parameters\MediaIdTrait;
use Wubs\Trakt\Request\Parameters\Language;
use Wubs\Trakt\Request\Parameters\MediaId;
use Wubs\Trakt\Request\RequestType;

class Translations extends AbstractRequest
{
    use MediaIdTrait;
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
        return "shows/:id/translations/:language";
    }
}