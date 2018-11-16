<?php
/**
 * Blog Controller
 * 
 */

namespace src\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;

use Psr\Http\Message\ResponseInterface as Response;

use src\Utilities\CookieUtility as Cookie;

use src\Models\Blog;

class BlogController
{
    public function get(Request $request, Response $response) : Response
    {
        try {

            $cookie = '';//Cookie::get($request);

            $model = new Blog();

            $data = $model->get($cookie);

            $code = $response->getStatusCode();

            return $response->withJson($data, $code);

        } catch (\Exception $e) {

            $error = $e->getMessage();

            $code = $e->getCode();

            return $response->withJson($error, $code);
        }
    }
}