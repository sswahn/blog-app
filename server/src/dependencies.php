<?php
// DIC configuration

$container = $app->getContainer();

// Twig View
$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig('../src/Views/Templates', [
        'cache' => false, //'../cache/templates',
    ]);
    $view->addExtension(new \Slim\Views\TwigExtension(
        $container->router,
        $container->request->getUri()
    ));
    return $view;
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

$container['PageController'] = function ($container) {
    return new \src\Controllers\PageController($container->view);
};

$container['BlogController'] = function ($container) {
    return new \src\Controllers\BlogController();
};