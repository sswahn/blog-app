<?php
/**
 * Blog Controller
 * 
 */

namespace src\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;

use Psr\Http\Message\ResponseInterface as Response;

use src\Utilities\CookieUtility as Cookie;

use src\Utilities\UserUtility as User;

use src\Models\Blog;

class BlogController
{
    public function get(Request $request, Response $response) : Response
    {
        try {

            $cookie = Cookie::get($request);

            $user = User::validate($cookie);

            $model = new Blog($user);

            $data = $model->get();

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

            $user = User::validate($cookie);

            $model = new Blog($user);

            $data = $model->getOne($request, $args);

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

            $user = User::validate($cookie);

            $model = new Blog($user);

            $data = $model->post($request);

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

            $user = User::validate($cookie);

            $model = new Blog($user);

            $data = $model->put($request, $args);

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

            $user = User::validate($cookie);

            $model = new Blog($user);

            $data = $model->delete($args);

            $code = $response->getStatusCode();

            return $response->withJson($data, $code);

        } catch (\Exception $e) {

            $error = $e->getMessage();

            $code = $e->getCode();

            return $response->withJson($error, $code);
        }
    }
}