<?php

use PHPUnit\Framework\TestCase;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TestBasketServiceImpl
 *
 * @author maqsudmohammad
 */
class BasketServiceImplTest extends TestCase {
    
    //private BasketServiceImpl $basketServiceTest;
   

    public function testProductCatalogue() {
        require 'Product.php';
        require 'Offer.php';
        $productRed = new Product("Red Widget", "R01", 32.95, Offer::BUY_ONE_GET_OTHER_HALF);
        $productGreen = new Product("Green Widget", "G01", 24.95, "");
        $productBlue = new Product("Blue Widget", "B01", 7.95, "");

        $productCatalogue = array();
        $productCatalogue[$productRed->getCode()] = $productRed;
        $productCatalogue[$productGreen->getCode()] = $productGreen;
        $productCatalogue[$productBlue->getCode()] = $productBlue;

        $products = array($productRed, $productGreen, $productBlue);

        $this->assertEquals(3, count($products));
    }
    
    
    public function testGetBasketItems(){
        require 'BasketService.php';
        require 'BasketServiceImpl.php';
        require 'BasketItem.php';
        
        $productRed = new Product("Red Widget", "R01", 32.95, Offer::BUY_ONE_GET_OTHER_HALF);
        $productGreen = new Product("Green Widget", "G01", 24.95, "");
        $productBlue = new Product("Blue Widget", "B01", 7.95, "");

        $productCatalogue = array();
        $productCatalogue[$productRed->getCode()] = $productRed;
        $productCatalogue[$productGreen->getCode()] = $productGreen;
        $productCatalogue[$productBlue->getCode()] = $productBlue;

        //$products = array($productRed, $productGreen, $productBlue);
        
        $itemRed = new BasketItem($productRed, 1);
        $itemGreen =  new BasketItem($productGreen, 1);
        $itemBlue =  new BasketItem($productBlue, 2);
        
        $basketItems= array();
        $basketItems[$productRed->getCode()]=$itemRed;
        $basketItems[$productGreen->getCode()]=$itemGreen;
        $basketItems[$productBlue->getCode()]=$itemBlue;
        
        $basketServiceTest = new BasketServiceImpl($basketItems, $productCatalogue);

        $this->assertEquals(3, count($basketServiceTest->getBasketItems()));
    }
    
    public function testAddNewItemToBasket(){
        $productRed = new Product("Red Widget", "R01", 32.95, Offer::BUY_ONE_GET_OTHER_HALF);
        $productGreen = new Product("Green Widget", "G01", 24.95, "");
        $productBlue = new Product("Blue Widget", "B01", 7.95, "");

        $productCatalogue = array();
        $productCatalogue[$productRed->getCode()] = $productRed;
        $productCatalogue[$productGreen->getCode()] = $productGreen;
        $productCatalogue[$productBlue->getCode()] = $productBlue;

        //$products = array($productRed, $productGreen, $productBlue);
        
        $itemRed = new BasketItem($productRed, 1);
        $itemGreen =  new BasketItem($productGreen, 1);
        $itemBlue =  new BasketItem($productBlue, 2);
        
        $basketItems= array();
        $basketItems[$productGreen->getCode()]=$itemGreen;
        $basketItems[$productBlue->getCode()]=$itemBlue;
        
        $basketServiceTest = new BasketServiceImpl($basketItems, $productCatalogue);

        $this->assertEquals(2, count($basketServiceTest->getBasketItems()));
        
        $basketServiceTest->addProductToBasket("R01", 3);
        
        $this->assertEquals(3, count($basketServiceTest->getBasketItems()));
    }
    
    public function testAddExistingItemToBasket(){
        $productRed = new Product("Red Widget", "R01", 32.95, Offer::BUY_ONE_GET_OTHER_HALF);
        $productGreen = new Product("Green Widget", "G01", 24.95, "");
        $productBlue = new Product("Blue Widget", "B01", 7.95, "");

        $productCatalogue = array();
        $productCatalogue[$productRed->getCode()] = $productRed;
        $productCatalogue[$productGreen->getCode()] = $productGreen;
        $productCatalogue[$productBlue->getCode()] = $productBlue;

        //$products = array($productRed, $productGreen, $productBlue);
        
        $itemGreen =  new BasketItem($productGreen, 1);
        $itemBlue =  new BasketItem($productBlue, 2);
        
        $basketItems= array();
        $basketItems[$productGreen->getCode()]=$itemGreen;
        $basketItems[$productBlue->getCode()]=$itemBlue;
        
        $basketServiceTest = new BasketServiceImpl($basketItems, $productCatalogue);

        $this->assertEquals(2, count($basketServiceTest->getBasketItems()));
        
        $basketServiceTest->addProductToBasket("G01", 3);
        
        $this->assertEquals(2, count($basketServiceTest->getBasketItems()));
        
        $newItemAdded = $basketServiceTest->getBasketItems()["G01"];
        
        $this->assertEquals(4, $newItemAdded->getQuantity());
        
    }
    
    
    public function testGetBasketTotalWithGreenBlueWidgets(){
        $productRed = new Product("Red Widget", "R01", 32.95, Offer::BUY_ONE_GET_OTHER_HALF);
        $productGreen = new Product("Green Widget", "G01", 24.95, "");
        $productBlue = new Product("Blue Widget", "B01", 7.95, "");

        $productCatalogue = array();
        $productCatalogue[$productRed->getCode()] = $productRed;
        $productCatalogue[$productGreen->getCode()] = $productGreen;
        $productCatalogue[$productBlue->getCode()] = $productBlue;

        $itemRed = new BasketItem($productRed, 1);
        $itemGreen =  new BasketItem($productGreen, 1);
        $itemBlue =  new BasketItem($productBlue, 1);
        
        $basketItems= array();
        $basketItems[$productGreen->getCode()]=$itemGreen;
        $basketItems[$productBlue->getCode()]=$itemBlue;
        
        $basketServiceTest = new BasketServiceImpl($basketItems, $productCatalogue);

        $this->assertEquals(2, count($basketServiceTest->getBasketItems()));
        //24.95+7.95+ 4.95
        $this->assertEquals(37.85, $basketServiceTest->getBasketTotal());

    }
    
    public function testGetBasketTotalWithRedWidget(){
        $productRed = new Product("Red Widget", "R01", 32.95, Offer::BUY_ONE_GET_OTHER_HALF);
        $productGreen = new Product("Green Widget", "G01", 24.95, "");
        $productBlue = new Product("Blue Widget", "B01", 7.95, "");

        $productCatalogue = array();
        $productCatalogue[$productRed->getCode()] = $productRed;
        $productCatalogue[$productGreen->getCode()] = $productGreen;
        $productCatalogue[$productBlue->getCode()] = $productBlue;

        $itemRed = new BasketItem($productRed, 2);
        
        $basketItems= array();
        $basketItems[$productRed->getCode()]=$itemRed;
        
        $basketServiceTest = new BasketServiceImpl($basketItems, $productCatalogue);

        $this->assertEquals(1, count($basketServiceTest->getBasketItems()));
        //24.95+7.95+ 4.95
        $this->assertEquals(54.38, $basketServiceTest->getBasketTotal());
    }
    
    public function testGetBasketTotalWithRedGreenWidgetWithDelivery(){
        $productRed = new Product("Red Widget", "R01", 32.95, Offer::BUY_ONE_GET_OTHER_HALF);
        $productGreen = new Product("Green Widget", "G01", 24.95, "");
        $productBlue = new Product("Blue Widget", "B01", 7.95, "");

        $productCatalogue = array();
        $productCatalogue[$productRed->getCode()] = $productRed;
        $productCatalogue[$productGreen->getCode()] = $productGreen;
        $productCatalogue[$productBlue->getCode()] = $productBlue;

        
        $itemRed = new BasketItem($productRed, 1);
        $itemGreen =  new BasketItem($productGreen, 1);
        
        $basketItems= array();
        $basketItems[$productRed->getCode()]=$itemRed;
        $basketItems[$productGreen->getCode()]=$itemGreen;
        
        $basketServiceTest = new BasketServiceImpl($basketItems, $productCatalogue);

        $this->assertEquals(2, count($basketServiceTest->getBasketItems()));
        //Delivery=2.95
        //32.95+24.95=57.9+2.95=60.85
        $this->assertEquals(60.85, $basketServiceTest->getBasketTotal());
    }
    
    public function testGetBasketTotalWith3Red2BlueWidget0Delivery(){
        $productRed = new Product("Red Widget", "R01", 32.95, Offer::BUY_ONE_GET_OTHER_HALF);
        $productGreen = new Product("Green Widget", "G01", 24.95, "");
        $productBlue = new Product("Blue Widget", "B01", 7.95, "");

        $productCatalogue = array();
        $productCatalogue[$productRed->getCode()] = $productRed;
        $productCatalogue[$productGreen->getCode()] = $productGreen;
        $productCatalogue[$productBlue->getCode()] = $productBlue;

        //$products = array($productRed, $productGreen, $productBlue);
        
        $itemRed = new BasketItem($productRed, 3);
        $itemBlue =  new BasketItem($productBlue, 2);
        
        $basketItems= array();
        $basketItems[$productRed->getCode()]=$itemRed;
        $basketItems[$productBlue->getCode()]=$itemBlue;
        
        $basketServiceTest = new BasketServiceImpl($basketItems, $productCatalogue);

        $this->assertEquals(2, count($basketServiceTest->getBasketItems()));
        
        $this->assertEquals(98.28, $basketServiceTest->getBasketTotal());
    }
    
    public function testGetBasketTotalWith4Red2BlueWidgetWith0Delivery(){
        $productRed = new Product("Red Widget", "R01", 32.95, Offer::BUY_ONE_GET_OTHER_HALF);
        $productGreen = new Product("Green Widget", "G01", 24.95, "");
        $productBlue = new Product("Blue Widget", "B01", 7.95, "");

        $productCatalogue = array();
        $productCatalogue[$productRed->getCode()] = $productRed;
        $productCatalogue[$productGreen->getCode()] = $productGreen;
        $productCatalogue[$productBlue->getCode()] = $productBlue;

        //$products = array($productRed, $productGreen, $productBlue);
        
        $itemRed = new BasketItem($productRed, 4);
        $itemBlue =  new BasketItem($productBlue, 2);
        
        $basketItems= array();
        $basketItems[$productRed->getCode()]=$itemRed;
        $basketItems[$productBlue->getCode()]=$itemBlue;
        
        $basketServiceTest = new BasketServiceImpl($basketItems, $productCatalogue);

        $this->assertEquals(2, count($basketServiceTest->getBasketItems()));
        //2*32.95 + 2(32.95/2)+ 2*7.95 = 114.75 (No Delivery charge)
        $this->assertEquals(114.75, $basketServiceTest->getBasketTotal());
    }

}
