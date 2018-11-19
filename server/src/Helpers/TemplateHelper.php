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

        return $path === '/' ? 'blog.html' : str_replace('/', '', $path) . '.html';
    }
}