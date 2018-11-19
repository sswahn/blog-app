<?php
/**
 * Base Middleware
 * 
 */

namespace src\Middleware;

class Middleware
{
    protected $container;

    public function __construct($container)
    {
        $this->container = $container;
    }
}