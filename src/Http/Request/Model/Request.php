<?php
/**
 * Created by PhpStorm.
 * User: erhan
 * Date: 03.10.2018
 * Time: 18:25
 */

namespace Vivense\Http\Request\Model;


class Request
{
    private $requestBody;
    private $headers = [];
    private $requestUri = [];

    public function __construct()
    {
        $this->setRequestBody();
        $this->setHeaders();
        $this->setRequestUri();
    }


    private function setRequestBody(){
        $this->requestBody = json_decode(file_get_contents("php://input"));
    }


    private function setHeaders()
    {

        $headers = [];
        foreach ($_SERVER as $name => $value) {
            if (substr($name, 0, 5) == 'HTTP_') {
                $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
            }
        }

        if(!isset($this->headers['Authorization']) && isset($_SERVER["PHP_AUTH_PW"]) && isset($_SERVER["PHP_AUTH_USER"])){
            $headers['Authorization'] = "Basic ".base64_encode($_SERVER["PHP_AUTH_USER"].":".$_SERVER["PHP_AUTH_PW"]);
        }

        $this->headers = $headers;

    }

    private function setRequestUri(){

        $this->requestUri = array_filter(explode('/',$_SERVER["REQUEST_URI"]));

    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @return mixed
     */
    public function getRequestBody()
    {
        return $this->requestBody;
    }


    /**
     * @return array()
     */
    public function getURI(){
        return $this->requestUri;
    }
}