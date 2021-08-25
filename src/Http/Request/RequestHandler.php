<?php

namespace Marsrover\Http\Request;

use Marsrover\Http\Request\Model\Request;
use Marsrover\Http\Response\Response;
use Marsrover\Http\Response\ResponseProvider;

class RequestHandler
{
    private static $instance;

    /**@var $request Request
     */
    protected $request;

    public static function getInstance() {
        if (empty(self::$instance)) {
            self::$instance = self::createInstance();
        }

        return self::$instance;
    }


    private static function createInstance(){

        switch ($_SERVER["REQUEST_METHOD"]) {
            case "POST":
                return new PostHandler();
            case "GET":
                return new GetHandler();

            case "PUT":
                return new PutHandler();

            default:
                return new RequestHandler();
        }

    }


    public function handleRequest(){

        $this->request = new Request();
    }

    /**
     * @param $response Response
     */
    public function returnResponse(&$response){

        header("HTTP/1.1 ".$response->getStatuCode()." ".$response->getStatu());
        header("Content-Type: application/json; charset=utf-8");

        if($response->hasBody()){
            echo json_encode($response->getResponseBody());
        }

        exit;
    }

}