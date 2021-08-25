<?php
/**
 * Created by PhpStorm.
 * User: erhan
 * Date: 03.10.2018
 * Time: 18:15
 */

namespace Vivense\Http\Request;

use Vivense\Http\Request\Model\Request;
use Vivense\Http\Response\Response;
use Vivense\Http\Response\ResponseProvider;

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

        if(!$this->controlApiKey()){
            $response = ResponseProvider::getInstance()->createResponse(401);
            $this->returnResponse($response);
            exit;
        }
    }

    private function controlApiKey(){

        $apiKey ="Basic ".base64_encode(\Config::getInstance()->vivenseApiKey.":".\Config::getInstance()->vivenseApiPass);

        if (isset($this->request->getHeaders()['Authorization'])){
            if ($this->request->getHeaders()['Authorization'] == $apiKey){
                return true;
            }
        }

        return false;

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