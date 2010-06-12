<?php defined('SYSPATH') OR die('No direct access allowed.');

class JSON
{
    static function encode($data)
    {
        if (function_exists('json_encode'))
            return json_encode($data);
        $json = new Services_JSON();
        return $json->encode($data);
    }
    
    static function decode($data)
    {
        if (function_exists('json_decode'))
            return json_decode($data);
        $json = new Services_JSON();
        return $json->decode($data);
    }
}
