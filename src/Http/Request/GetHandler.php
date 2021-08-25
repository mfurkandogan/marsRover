<?php
/**
 * Created by PhpStorm.
 * User: erhan
 * Date: 03.10.2018
 * Time: 18:38
 */

namespace Vivense\Http\Request;


use Vivense\Providers\ItemInfoLoader;
use Vivense\Providers\Item;
use Vivense\Providers\LocationProvider;
use Vivense\Http\Response\ResponseProvider;
use Vivense\Providers\OperationManagement;
use Vivense\Providers\Order;
use Vivense\Providers\Product;
use Vivense\Providers\Stock;

class GetHandler extends RequestHandler
{

    public function handleRequest(){

        parent::handleRequest();

        switch (strtolower($this->request->getURI()[1])){

            case strtolower('locations') :
                $this->handleLocationsRequest();
                break;

            case strtolower('products')  :
                $this->handleProductsRequest();
                break;

            case strtolower('destinations') :
                $this->handleDestinationsRequest();
                break;

            case strtolower('items') :
                $this->handleItemsRequest();
                break;

            case strtolower('getCanBeDeliveredCustomerItems') :
                $this->handleCanBeDeliveredCustomerItemsRequest();
                break;
            default :
                $response = ResponseProvider::getInstance()->createResponse(405);
                $this->returnResponse($response);
                break;

        }

    }


    private function handleLocationsRequest(){

        $result = LocationProvider::getLocations();
        $response = ResponseProvider::getInstance()->createResponse(200,$result);
        $this->returnResponse($response);

    }


    private function handleProductsRequest(){

        $productId = isset($this->request->getURI()[2]) ? $this->request->getURI()[2] : null;
        $variantId = isset($this->request->getURI()[3]) ? $this->request->getURI()[3] : null;

        $result = Product::getProductDetails($productId,$variantId);

        if(!is_null($result)){
            $response = ResponseProvider::getInstance()->createResponse(200,$result);
            $this->returnResponse($response);

        }

        $response = ResponseProvider::getInstance()->createResponse(404);
        $this->returnResponse($response);

    }

    private function handleDestinationsRequest(){

        $userLocationId = isset($this->request->getURI()[2]) ? $this->request->getURI()[2] : null;
        $productId = isset($this->request->getURI()[3]) ? $this->request->getURI()[3] : null;
        $variantId = isset($this->request->getURI()[4]) ? $this->request->getURI()[4] : null;

        $result = Stock::getDestinations($userLocationId,$productId,$variantId);

        $response = ResponseProvider::getInstance()->createResponse(200,$result);
        $this->returnResponse($response);

    }

    private function handleItemsRequest(){

        $result = Item::getItemInfo($this->request);

        $statusCode = 200;

        $response = ResponseProvider::getInstance()->createResponse($statusCode,$result);
        $this->returnResponse($response);

    }

    private function handleCanBeDeliveredCustomerItemsRequest(){

        $result = OperationManagement::getCanBeDeliveredCustomerItemsInSameLocation($this->request);

        $statusCode = 200;

        $response = ResponseProvider::getInstance()->createResponse($statusCode,$result);
        $this->returnResponse($response);
    }

}