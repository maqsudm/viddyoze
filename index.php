<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Test PHP</title>
    </head>
    <body>
        <?php
        include "./Basket.php";
        include "./Offer.php";
        include "./BasketItem.php";
        include "./Product.php";
        include "./UserInterface.php";
        include "./UserImpl.php";
        include "./BasketService.php";
        include "./BasketServiceImpl.php";
        
        // put your code here
        echo "Hello World, my first PHP project<br>";
        
   
        $productRed = new Product("Red Widget", "R01", 32.95, Offer::BUY_ONE_GET_OTHER_HALF);
        $productGreen = new Product("Green Widget", "G01", 24.95, "");
        $productBlue = new Product("Blue Widget", "B01", 7.95, "");
        
        $productCatalogue = array();
        $productCatalogue[$productRed->getCode()] = $productRed;
        $productCatalogue[$productGreen->getCode()] = $productGreen;
        $productCatalogue[$productBlue->getCode()] = $productBlue;
        
        $products = array($productRed, $productGreen, $productBlue);
        
        
        foreach ($productCatalogue as $key=> $value) {
            echo "<br> Key is ". $key ." and value is ". $value->getName();
        }
        
        $itemRed = new BasketItem($productRed, 3);
        //$itemGreen =  new BasketItem($productGreen, 1);
        $itemBlue =  new BasketItem($productBlue, 2);
        
        $basketItems= array();
        $basketItems[$productRed->getCode()]=$itemRed;
//        $basketItems[$productGreen->getCode()]=$itemGreen;
        $basketItems[$productBlue->getCode()]=$itemBlue;

        $basketService = new BasketServiceImpl($basketItems, $productCatalogue);
        
//        $added = $basketService->addProductToBasket("R01", 3);
  //      echo "<br> Added is:  $added";
        
        echo "<br> Basket Total is". $basketService->getBasketTotal();
        ?>
    </body>
</html>
     