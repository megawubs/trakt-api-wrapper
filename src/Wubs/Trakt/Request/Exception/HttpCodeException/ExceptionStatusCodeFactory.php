<?php
namespace Wubs\Trakt\Request\Exception\HttpCodeException;


class ExceptionStatusCodeFactory 
{

    public static function create($statusCode)
    {
        switch($statusCode) {
            case "400":
                return new BadRequestException();
                break;
            case "401":
                return new UnauthorizedException();
                break;
            case "403":
                return new ForbiddenException();
                break;
            case "404":
                return new NotFoundException();
                break;
            case "405":
                return new MethodNotFoundException();
                break;
            case "409":
                return new ConflictException();
                break;
            case "412":
                return new PreconditionException();
                break;
            case "422":
                return new UnprocessableEntityException();
                break;
            case "429":
                return new RateLimitExceededException();
                break;
            case "500":
                return new ServerErrorException();
                break;
            case "503":
                return new ServerUnavailableException();
                break;
        }
        return new StatusCodeException($statusCode);
    }

}
