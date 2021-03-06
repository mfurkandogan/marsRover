<?php
namespace Marsrover;

if (!defined("DS")) {
    define('DS', DIRECTORY_SEPARATOR);
}

require __DIR__.DS.'vendor'.DS.'autoload.php';

use Marsrover\Http\Request\RequestHandler;

$requestHandler = RequestHandler::getInstance();

$requestHandler->handleRequest();