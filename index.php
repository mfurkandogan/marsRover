<?php

namespace marsRover;

define('DS',DIRECTORY_SEPARATOR);

use marsRover\Http\Request\RequestHandler;

$requestHandler = RequestHandler::getInstance();

$requestHandler->handleRequest();