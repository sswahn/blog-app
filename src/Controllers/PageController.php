<?php
/**
 * Page Controller
 *
 */

namespace src\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;

use Psr\Http\Message\ResponseInterface as Response;

use Slim\Views\Twig as View;

use src\Helpers\TemplateHelper as Template;

class PageController
{
    private $view;

    public function __construct(View $view)
    {
        $this->view = $view;
    }

    public function render(Request $request, Response $response) : Response
    {
        try {

            $template = Template::make($request);

            return $this->view->render($response, $template);

        } catch (\Exception $e) {

            return $response->write($e->getMessage());
        }
    }
}