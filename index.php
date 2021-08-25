<?php




namespace marsRover;

define('DS',DIRECTORY_SEPARATOR);

use Vivense\Http\Request\RequestHandler;

$requestHandler = RequestHandler::getInstance();

$requestHandler->handleRequest();