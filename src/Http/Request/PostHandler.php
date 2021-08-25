<?php

namespace marsRover\Http\Request;

use marsRover\Http\Request\Model\Request;
use marsRover\Http\Response\ResponseProvider;

class PostHandler extends RequestHandler
{
    public function handleRequest()
    {
        parent::handleRequest();

        switch (strtolower($this->request->getURI()[1])) {
            case strtolower('createRover') :
                $this->createRover();
                break;
            case strtolower('createPlateau') :
                $this->createPlateau();
                break;
            case strtolower('sendCommandsToRover') :
                $this->setRoverCommand();
                break;
            default:
                $response = ResponseProvider::getInstance()->createResponse(405);
                $this->returnResponse($response);
                break;
        }
    }

    private function createRover()
    {

    }

    private function createPlateau()
    {

    }

    private function setRoverCommand(){

    }
}