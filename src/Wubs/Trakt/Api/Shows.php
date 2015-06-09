<?php


namespace Wubs\Trakt\Api;


use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\ClientId;
use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\Parameters\Language;
use Wubs\Trakt\Request\Parameters\MediaId;
use Wubs\Trakt\Request\Parameters\StartDate;
use Wubs\Trakt\Request\Shows\Aliases;
use Wubs\Trakt\Request\Shows\Comments;
use Wubs\Trakt\Request\Shows\People;
use Wubs\Trakt\Request\Shows\Popular;
use Wubs\Trakt\Request\Shows\Ratings;
use Wubs\Trakt\Request\Shows\Related;
use Wubs\Trakt\Request\Shows\Stats;
use Wubs\Trakt\Request\Shows\Summary;
use Wubs\Trakt\Request\Shows\Translations;
use Wubs\Trakt\Request\Shows\Trending;
use Wubs\Trakt\Request\Shows\Updates;
use Wubs\Trakt\Request\Shows\Watching;

class Shows
{
    use RequestMaker;

    /**
     * @param ClientId $clientId
     */
    public function __construct(ClientId $clientId)
    {
        $this->clientId = $clientId;
    }

    public function aliases($id)
    {
        $mediaId = MediaId::set($id);
        return $this->request(new Aliases($mediaId));
    }

    public function comments($id, AccessToken $token)
    {
        $id = MediaId::set($id);
        return $this->request(new Comments($id), $token);
    }

    public function people($id)
    {
        $id = MediaId::set($id);
        return $this->request(new People($id));
    }

    public function popular()
    {
        return $this->request(new Popular());
    }

    public function ratings($id)
    {
        $id = MediaId::set($id);
        return $this->request(new Ratings($id));
    }

    public function Related($id)
    {
        $id = MediaId::set($id);
        return $this->request(new Related($id));
    }

    public function stats($id)
    {
        $id = MediaId::set($id);
        return $this->request(new Stats($id));
    }

    public function summary($id)
    {
        $id = MediaId::set($id);
        return $this->request(new Summary($id));
    }

    public function get($id)
    {
        return $this->summary($id);
    }

    public function translations($id, $language)
    {
        $id = MediaId::set($id);
        $language = Language::set($language);
        return $this->request(new Translations($id, $language));
    }

    public function trending(AccessToken $token)
    {
        return $this->request(new Trending(), $token);
    }

    public function updates($startDate = null)
    {
        $startDate = ($startDate === null) ? StartDate::standard() : StartDate::set($startDate);
        return $this->request(new Updates($startDate));
    }

    public function watching($id)
    {
        $id = MediaId::set($id);
        return $this->request(new Watching($id));
    }
}