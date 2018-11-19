<?php
/**
 * Blog Page Route
 * 
 */

$app->group('/', function () {
    
    $this->get('', 'PageController:render')
         ->setName('blog.page.render');
    
});