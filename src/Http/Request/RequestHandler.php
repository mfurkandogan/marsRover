<?php

namespace marsRover\Http\Request;

use marsRover\Http\Request\Model\Request;
use marsRover\Http\Response\Response;
use marsRover\Http\Response\ResponseProvider;

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

            case "DELETE":
                return new DeleteHandler();

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