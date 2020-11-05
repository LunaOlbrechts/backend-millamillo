<?php

use App\Kernel;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\ErrorHandler\Debug;
use Symfony\Component\HttpFoundation\Request;

require dirname(__DIR__).'/vendor/autoload.php';

(new Dotenv())->bootEnv(dirname(__DIR__).'/.env');

if ($_SERVER['APP_DEBUG']) {
    umask(0000);

    Debug::enable();
}


$request = Request::createFromGlobals();

// tell Symfony about your reverse proxy
Request::setTrustedProxies(
    // the IP address (or range) of your proxy
    ['127.0.0.1', 'REMOTE_ADDR'],

    // trust *all* "X-Forwarded-*" headers
    Request::HEADER_X_FORWARDED_ALL

    // or, if your proxy instead uses the "Forwarded" header
    // Request::HEADER_FORWARDED

    // or, if you're using AWS ELB
    // Request::HEADER_X_FORWARDED_AWS_ELB
);

$kernel = new Kernel($_SERVER['APP_ENV'], (bool) $_SERVER['APP_DEBUG']);
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
