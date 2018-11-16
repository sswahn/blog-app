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

            $cookie = Cookie::get($request);

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

    public function getOne(Request $request, Response $response, array $args) : Response
    {
        try {

            $cookie = Cookie::get($request);

            $model = new Blog();

            $data = $model->getOne($request, $args, $cookie);

            $code = $response->getStatusCode();

            return $response->withJson($data, $code);

        } catch (\Exception $e) {

            $error = $e->getMessage();

            $code = $e->getCode();

            return $response->withJson($error, $code);
        }
    }

    public function post(Request $request, Response $response) : Response
    {
        try {

            $cookie = Cookie::get($request);

            $model = new Blog();

            $data = $model->post($request, $cookie);

            $code = $response->getStatusCode();

            return $response->withJson($data, $code);

        } catch (\Exception $e) {

            $error = $e->getMessage();

            $code = $e->getCode();

            return $response->withJson($error, $code);
        }
    }

    public function put(Request $request, Response $response, array $args) : Response
    {
        try {

            $cookie = Cookie::get($request);

            $model = new Blog();

            $data = $model->put($request, $args, $cookie);

            $code = $response->getStatusCode();

            return $response->withJson($data, $code);

        } catch (\Exception $e) {

            $error = $e->getMessage();

            $code = $e->getCode();

            return $response->withJson($error, $code);
        }
    }

    public function delete(Request $request, Response $response, array $args) : Response
    {
        try {

            $cookie = Cookie::get($request);

            $model = new Blog();

            $data = $model->delete($args, $cookie);

            $code = $response->getStatusCode();

            return $response->withJson($data, $code);

        } catch (\Exception $e) {

            $error = $e->getMessage();

            $code = $e->getCode();

            return $response->withJson($error, $code);
        }
    }
}