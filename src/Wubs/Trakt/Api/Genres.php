<?php
/*
|--------------------------------------------------------------------------
| Generated code
|--------------------------------------------------------------------------
| This class is auto generated. Please do not edit
|
|
*/
namespace Wubs\Trakt\Api;

use Wubs\Trakt\Request\Genres\GenresList as GenresListRequest;

class Genres extends Endpoint {
    


    public function genresList($type)
    {
        return $this->request(new GenresListRequest($type));
    }

}

