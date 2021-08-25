<?php
/**
 * Created by PhpStorm.
 * User: erhan
 * Date: 03.10.2018
 * Time: 18:15
 */

namespace Vivense\Http\Request;

use Vivense\Http\Request\Model\Request;
use Vivense\Providers\Item;
use Vivense\Providers\OperationManagement;
use Vivense\Providers\OperationProcessor;
use Vivense\Providers\Order;
use Vivense\Providers\LoginProvider;
use Vivense\Http\Response\ResponseProvider;
use Vivense\Providers\Shelf;

class PostHandler extends RequestHandler
{
    public function handleRequest(){

        parent::handleRequest();

        switch (strtolower($this->request->getURI()[1])){

            case strtolower('login') :
                $this->handleLoginRequest();
                break;

            case strtolower('itemsBarcode') :
                $this->handleItemsBarcodeRequest();
                break;

            case strtolower('orders') :
                $this->handleOrdersRequest();
                break;

            case strtolower('shelfs'):
                $this->handleShelfRequest();
                break;

            case strtolower('firstMileExpedition'):
                $this->handleFirstMileExpedition();
                break;
            case strtolower('itemFirstMileExpedition'):
                $this->handleItemFirstMileExpedition();
                break;
            case strtolower('controlIsItemCollectable');
                $this->controlIsItemCollectable();
                break;
            case strtolower('controlIsItemPickupable');
                $this->controlIsItemPickupable();
                break;
            default :

                $response = ResponseProvider::getInstance()->createResponse(405);
                $this->returnResponse($response);
                break;
        }

    }

    private function handleLoginRequest(){

        if (isset($this->request->getRequestBody()->username) && isset($this->request->getRequestBody()->password)){

            $result = LoginProvider::login($this->request->getRequestBody()->username, $this->request->getRequestBody()->password);
            $response = ResponseProvider::getInstance()->createResponse(200,$result);
            $this->returnResponse($response);

        }

        $response = ResponseProvider::getInstance()->createResponse(405);
        $this->returnResponse($response);

    }

    private function handleItemsBarcodeRequest(){

        $result = Item::getItemsBarcodes($this->request);

        $response = ResponseProvider::getInstance()->createResponse(200,$result);
        $this->returnResponse($response);

    }

    private function handleOrdersRequest(){

        if(isset($this->request->getURI()[2])){

            switch (strtolower($this->request->getURI()[2])){

                case strtolower('search') :
                    $result = Order::searchOrder($this->request);
                    $response = ResponseProvider::getInstance()->createResponse(200,$result);
                    $this->returnResponse($response);
                    break;

                default :
                    $response = ResponseProvider::getInstance()->createResponse(405);
                    $this->returnResponse($response);
                    break;

            }
        }

        $response = ResponseProvider::getInstance()->createResponse(404);
        $this->returnResponse($response);
    }

    private function handleShelfRequest(){

        if (isset($this->request->getRequestBody()->shelfCode) && isset($this->request->getRequestBody()->userLocation)){

            $result = Shelf::getShelfBarcode($this->request);
            $response = ResponseProvider::getInstance()->createResponse(200,$result);
            $this->returnResponse($response);

        }

        $response = ResponseProvider::getInstance()->createResponse(404);
        $this->returnResponse($response);
    }

    private function handleFirstMileExpedition(){

        $result = OperationManagement::getFirstMileExpeditions($this->request);

        $response = ResponseProvider::getInstance()->createResponse(200,$result);

        $this->returnResponse($response);
    }

    private function handleItemFirstMileExpedition(){
        $result = OperationProcessor::setItemToFirstMileExpedition($this->request);

        $response = ResponseProvider::getInstance()->createResponse(200,$result);

        $this->returnResponse($response);
    }

    private function controlIsItemCollectable(){
        $result = OperationManagement::controlIsItemCollectable($this->request);
        $response = ResponseProvider::getInstance()->createResponse(200,$result);
        $this->returnResponse($response);
    }

    private function controlIsItemPickupable(){
        $result = OperationManagement::controlIsItemPickupable($this->request);
        $response = ResponseProvider::getInstance()->createResponse(200,$result);
        $this->returnResponse($response);
    }
}