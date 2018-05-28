<?php
/**
 * Basic application handler and router. This file builds up the various
 * paths and mappings supported by the module and routes requests to
 * specific methods implemented in the `lesson.php` file for the module.
 */

namespace EAMann\Contacts;

use EAMann\Contacts\Lesson;
use EAMann\Contacts\Util;

use League\Container\Container;
use League\Route\RouteCollection;
use League\Route\Http\Exception\NotFoundException;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

use Zend\Diactoros\{Response, ServerRequestFactory};
use Zend\Diactoros\Response\{RedirectResponse, SapiEmitter};

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/util.php';
require_once __DIR__ . '/lesson.php';

session_start();

$container = new Container;

$container->share('response', Response::class);
$container->share('request', function () {
    return ServerRequestFactory::fromGlobals(
        $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
    );
});

$container->share('emitter', SapiEmitter::class);

$route = new RouteCollection($container);

// Present the authentication screen, along with any
$route->map('GET', '/', function (ServerRequestInterface $request, ResponseInterface $response) {
    return Util\show_landing($request, $response, '');
});

// Handle form submission and maybe redirect
$route->map('POST', '/', function(ServerRequestInterface $request, ResponseInterface $response) {
    $body = $request->getParsedBody();

    return Util\show_landing($request, $response, $body['email']);
});

// Present our "secret page" but only if we're logged in
$route->map('POST', '/create', function(ServerRequestInterface $request, ResponseInterface $response) {
    $body = $request->getParsedBody();

    Lesson\create_contact($body['name'], $body['email']);

    return new RedirectResponse('http://localhost:8888/');
});

// Handle 404s specifically (i.e. for missing favicons)
try {
    $response = $route->dispatch($container->get('request'), $container->get('response'));
} catch( NotFoundException $e ) {
    $response = new Response("Not found", 404);
}

$container->get('emitter')->emit($response);