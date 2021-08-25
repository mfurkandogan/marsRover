<?php

namespace marsRover\Http\Response;


class ResponseProvider
{

    private static $instance;

    public static function getInstance() {
        if (empty(self::$instance)) {
            self::$instance = self::createInstance();
        }

        return self::$instance;
    }


    private static function createInstance(){
        return new ResponseProvider();
    }

    /**
     * @param $statuCode
     * @param null $responseBody
     * @return Response
     */
    public function createResponse($statuCode,$responseBody=null){
        $response = new Response();
        $response->setStatuCode($statuCode);
        $response->setResponseBody($responseBody);

        return $response;
    }

}