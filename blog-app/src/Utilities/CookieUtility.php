<?php
/**
 * Cookie Utility
 * 
 */

namespace src\Utilities;

use Dflydev\FigCookies\FigRequestCookies;

use Dflydev\FigCookies\FigResponseCookies;

class CookieUtility
{
    public static function get($request)
    {
        return 'test get method.';
    }
    
    public static function set($response)
    {
        return 'test set method.';
    }
}