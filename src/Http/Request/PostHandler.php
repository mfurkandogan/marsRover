<?php

namespace Marsrover\Http\Request;

use Marsrover\Action;
use Marsrover\Entity\Rover;
use Marsrover\Helpers\Input;
use Marsrover\Http\Response\ResponseProvider;
use Marsrover\Models\Coordinate;
use Marsrover\Models\Direction;
use Marsrover\Models\Position;

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
            case strtolower('commands') :
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
        $args = $this->setRoverArgs();
        $roverResult = new Rover($args['position'], $args['direction']);
        if($roverResult){
            $responseCode  = 200;
        } else {
            $responseCode  = 500;
        }

        $response = ResponseProvider::getInstance()->createResponse($responseCode,$roverResult);
        $this->returnResponse($response);
    }

    private function createPlateau()
    {
        $result = new Position(new Coordinate(5), new Coordinate(5));
        $response = ResponseProvider::getInstance()->createResponse(200,$result);
        $this->returnResponse($response);
    }

    private function setRoverArgs(){
        return  [
            'position'  => new Position(new Coordinate(1), new Coordinate(2)),
            'direction' => new Direction('N')
        ];
    }

    private function setRoverCommand(){

        $result=null;

        if(isset($this->request->getRequestBody()->commands)){
            $args = $this->setRoverArgs();
            $rover = new Rover($args['position'], $args['direction']);
            $action = new Action($rover);
            $result = $action->act(Input::movementCommands($this->request->getRequestBody()->commands));
            $response = ResponseProvider::getInstance()->createResponse(200,$result);
            $this->returnResponse($response);
        } else {
            $response = ResponseProvider::getInstance()->createResponse(500,$result);
            $this->returnResponse($response);
        }
    }
}