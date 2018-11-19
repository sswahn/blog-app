<?php
/**
 * Blog Page Route
 * 
 */

$app->group('/', function () {
    
    $this->get('', 'PageController:render')
         ->setName('blog.page');

    $this->get('create', 'PageController:render')
         ->setName('create.blog.page');
    
});