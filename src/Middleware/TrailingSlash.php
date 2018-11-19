<?php
/**
 * Trailing Slash Middleware
 * 
 */

namespace src\Middleware;

use Psr\Http\Message\RequestInterface as Request;

use Psr\Http\Message\ResponseInterface as Response;

class TrailingSlash
{
    public function __invoke(Request $request, Response $response, callable $next)
    {
        $uri = $request->getUri();

        $path = $uri->getPath();
        
        if ($path !== '/' && substr($path, -1) === '/') {
        
            $uri = $uri->withPath(substr($path, 0, -1));
            
            return ($request->getMethod() === 'GET')
                ? $response->withRedirect((string)$uri, 301)
                : $next($request->withUri($uri), $response);
        }
        
        return $next($request, $response);
    }
}