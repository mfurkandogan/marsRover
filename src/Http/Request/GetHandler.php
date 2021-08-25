<?php

namespace Marsrover\Http\Request;

use Marsrover\Http\Response\ResponseProvider;

class GetHandler extends RequestHandler
{
    public function handleRequest(){

        parent::handleRequest();

        switch (strtolower($this->request->getURI()[1])){
            case strtolower('getRover') :
                $this->getRover();
                break;
            case strtolower('getPlateau') :
                $this->getPlateau();
                break;
            case strtolower('getRoverState') :
                $this->getRoverState();
                break;
            default :
                $response = ResponseProvider::getInstance()->createResponse(405);
                $this->returnResponse($response);
                break;
        }
    }

    private function getPlateau(){

    }

    private function getRover(){

    }

    private function getRoverState(){

    }
}