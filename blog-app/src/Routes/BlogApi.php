<?php
/**
 * Blog Api Route
 * 
 */

$app->group('/api/v1/blog', function () {
    
    $this->get('', 'BlogController:get')
         ->setName('blog.api.get');
    
    $this->get('/{id}', 'BlogController:getOne')
         ->setName('blog.api.getOne');
    
    $this->post('', 'BlogController:post')
         ->setName('blog.api.post');

    $this->put('/{id}', 'BlogController:put')
         ->setName('blog.api.put');

    $this->delete('/{id}', 'BlogController:delete')
         ->setName('blog.api.delete');
});