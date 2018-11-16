<?php
/**
 * Blog Api Route
 * 
 */

$app->group('/api/v1/blog', function () {
    
    $this->get('', 'BlogController:get')
         ->setName('blog.api.get');
    

});