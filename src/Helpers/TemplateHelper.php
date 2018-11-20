<?php
/**
 * Template Helper
 *
 */

namespace src\Helpers;

class TemplateHelper
{
    public static function make($request)
    {
        $path = $request->getUri()->getPath();

        return $path === '/' ? 'blog.html' : explode('/', $path)[1] . '.html';
    }
}