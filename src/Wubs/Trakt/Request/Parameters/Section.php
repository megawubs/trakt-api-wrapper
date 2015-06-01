<?php


namespace Wubs\Trakt\Request\Parameters;

class Section extends AbstractParameter
{
    public static function calendar()
    {
        return new static("calendar");
    }

    public static function progressWatched()
    {
        return new static('progress_watched');
    }

    public static function progressCollected()
    {
        return new static("progress_collected");
    }
}