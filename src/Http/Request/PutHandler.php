<?php
/**
 * Created by PhpStorm.
 * User: erhan
 * Date: 03.10.2018
 * Time: 18:40
 */

namespace Vivense\Http\Request;


use Vivense\Providers\Item;
use Vivense\Providers\OperationManagement;
use Vivense\Providers\Stock;
use Vivense\Providers\StockCountSynchronizer;
use Vivense\Http\Response\ResponseProvider;
use Vivense\Providers\StockSynchronizer;

class PutHandler extends RequestHandler
{
    public function handleRequest(){

        parent::handleRequest();

        switch (strtolower($this->request->getURI()[1])){

            case strtolower('receiveGoods') :
                $this->handleReceiveGoodsRequest();
                break;

            case strtolower('stockOut') :
                $this->handleStockOutRequest();
                break;

            case strtolower('stockCountSynchronise') :
                $this->handleStockCountSynchroniseRequest();
                break;

            case strtolower('stockSynchronise') :
                $this->handleStockSynchroniseRequest();
                break;

            case strtolower('bulkStockSynchronise') :
                $this->handleBulkStockSynchroniseRequest();
                break;

            case strtolower('receiveItems') :
                $this->handleReceiveItemsRequest();
                break;

            case strtolower('outItems') :
                $this->handleOutItemsRequest();
                break;

            case strtolower('setItemsToShelf') :
                $this->handleSetItemsToShelfRequest();
                break;

            case strtolower("updatePackageCount") :
                $this->handleUpdatePackageCountRequest();
                break;

            case strtolower("pickupItems") :
                $this->handlePickupItemsRequest();
                break;

            default :

                $response = ResponseProvider::getInstance()->createResponse(405);
                $this->returnResponse($response);
                break;
        }


    }


    private function handleReceiveGoodsRequest(){

        if(is_null($this->request->getRequestBody()) ||
            !isset($this->request->getRequestBody()->userLocation) ||
            !isset($this->request->getRequestBody()->items) ||
            !isset($this->request->getRequestBody()->userId)){

            $response = ResponseProvider::getInstance()->createResponse(400);
            $this->returnResponse($response);

        }

        $result = Stock::receiveGoods($this->request->getRequestBody());
        $response = ResponseProvider::getInstance()->createResponse(200,$result);
        $this->returnResponse($response);


    }



    private function handleStockOutRequest(){

        if(is_null($this->request->getRequestBody()) ||
            !isset($this->request->getRequestBody()->itemId) ||
            !isset($this->request->getRequestBody()->userLocation)||
            !isset($this->request->getRequestBody()->userId)||
            !isset($this->request->getRequestBody()->type) ||
            !isset($this->request->getRequestBody()->packageQuantity)||
            !isset($this->request->getRequestBody()->productIdArray)||
            !isset($this->request->getRequestBody()->printerName)){

            $response = ResponseProvider::getInstance()->createResponse(400);
            $this->returnResponse($response);


        }

        $result = Stock::stockOut($this->request->getRequestBody());
        $response = ResponseProvider::getInstance()->createResponse(200,$result);
        $this->returnResponse($response);


    }


    private function handleStockCountSynchroniseRequest(){

        if(is_null($this->request->getRequestBody())){

            $response = ResponseProvider::getInstance()->createResponse(400);
            $this->returnResponse($response);

        }

        $result = StockCountSynchronizer::getInstance()->synchronizeStockCount($this->request->getRequestBody());
        $response = ResponseProvider::getInstance()->createResponse(200,$result);
        $this->returnResponse($response);

    }


    private function handleStockSynchroniseRequest(){

        if(is_null($this->request->getRequestBody()) ||
            !isset($this->request->getRequestBody()->productId)){

            $response = ResponseProvider::getInstance()->createResponse(400);
            $this->returnResponse($response);

        }

        $result = StockSynchronizer::getInstance()->synchronizeStockTables([$this->request->getRequestBody()->productId]);
        $response = ResponseProvider::getInstance()->createResponse(200,$result);
        $this->returnResponse($response);

    }

    private function handleBulkStockSynchroniseRequest(){

        $result = StockSynchronizer::getInstance()->synchronizeStockTables();
        $response = ResponseProvider::getInstance()->createResponse(200,$result);
        $this->returnResponse($response);

    }


    private function handleReceiveItemsRequest(){

        $result = OperationManagement::receiveItems($this->request);

        $response = ResponseProvider::getInstance()->createResponse(200,$result);
        $this->returnResponse($response);

    }

    private function handleOutItemsRequest(){

        $result = OperationManagement::outItems($this->request);

        $response = ResponseProvider::getInstance()->createResponse(200,$result);
        $this->returnResponse($response);
    }

    private function handleSetItemsToShelfRequest(){

        $result = OperationManagement::setItemsToShelf($this->request);

        $response = ResponseProvider::getInstance()->createResponse(200,$result);
        $this->returnResponse($response);

    }

    private function handleUpdatePackageCountRequest(){

        $result = Item::updateItemsPackageCount($this->request);

        $response = ResponseProvider::getInstance()->createResponse(200,$result);
        $this->returnResponse($response);
    }

    private function handlePickupItemsRequest(){
        $result = OperationManagement::pickupItems($this->request);

        $response = ResponseProvider::getInstance()->createResponse(200,$result);
        $this->returnResponse($response);
    }
}