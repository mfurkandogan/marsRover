<?php

namespace marsRover\Http\Request;

use marsRover\Http\Response\ResponseProvider;

class PutHandler extends RequestHandler
{
    public function handleRequest(){

        parent::handleRequest();

        switch (strtolower($this->request->getURI()[1])){
            default :
                $response = ResponseProvider::getInstance()->createResponse(405);
                $this->returnResponse($response);
                break;
        }


    }

}