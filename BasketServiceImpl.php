<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BasketServiceImpl
 *
 * @author maqsudmohammad
 */
class BasketServiceImpl implements BasketService{
    
    //itemsInBasket :: Array BasketItem
    private $itemsInBasket;
    
    //productCatalogue :: Array Product
    private $productCatalogue;
    
    
    //put your code here
    public function __construct($itemsInBasket, $productCatalogue) {
        $this->itemsInBasket=$itemsInBasket;
        $this->productCatalogue = $productCatalogue;
    }
   

    /**
     * I am called to return the Basket items.
     * 
     * @return type
     */
    public function getBasketItems() {
        return $this->itemsInBasket;
    }
    
    /**
     * I am called to add a product to the basket.
     * I take a productId and quantity.
     * 
     * @param type $productid
     * @param type $quantity
     * @return type
     */
    public function addProductToBasket($productid, $quantity) {
        
        if(array_key_exists($productid, $this->itemsInBasket)){
            $basketItem = $this->itemsInBasket[$productid];
            $basketItem->setQuantity($basketItem->getQuantity()+ $quantity);
        }else{
            $productToAdd = $this->productCatalogue[$productid];
            $newBasketItem = new BasketItem($productToAdd, $quantity);
            $this->itemsInBasket[$productid]= $newBasketItem;
        }
        return count($this->itemsInBasket);
    }

    /**
     * I am called to calculate the basket total.
     * 
     * @return $basketTotal
     */
    public function getBasketTotal() {
        //iterate items in basket
        $basketTotal=0;
        foreach ($this->getBasketItems() as $basketItem) {
            $itemTotal = $this->checkAndApplyOffersOnProduct($basketItem->getProduct(), 
                            $basketItem->getQuantity());
            $basketTotal = $basketTotal + $itemTotal;
        }
        $deliveryCharge = $this->applyDeliveryChargeOnBasket($basketTotal);
        return round($basketTotal+$deliveryCharge, 2);
    }
   
    
    
    /**
     * I am called to check and apply offers on a product.
     * Each product can have an offer associated with it.
     * If there is an offer attached, I apply and calculate the total line item
     * price.
     * 
     * @param Product $product
     * @param type $quantity
     * @return $productPrice
     */
    private function checkAndApplyOffersOnProduct(Product $product, $quantity){
        if (Offer::BUY_ONE_GET_OTHER_HALF === $product->getOffer()) {
            $productPrice = $this->applyBuyOneGetOneHalfPriceOffer($quantity, 
                    $product);
        }else{
            $productPrice = $product->getUnitPrice()*$quantity;
        }
        return $productPrice;
    }
    
    /**
     * I am called to apply the offer on the Basket item.
     * 
     * @param type $quantity
     * @param type $product
     * @return $productPrice
     */
    private function applyBuyOneGetOneHalfPriceOffer($quantity, $product){
        if($quantity>1 && $quantity%2 ==0){
            $productPrice = $product->getUnitPrice()*($quantity/2) + 
                    ($product->getUnitPrice()/2)*($quantity/2);
            
        }elseif($quantity>1 && $quantity%2 >0){
            $quantityForFullPrice = $quantity%2 + (int)($quantity/2);
            $quantityForHalfPrice = (int)($quantity/2);
            $productPrice = ($product->getUnitPrice()* $quantityForFullPrice)+
                    ( ($product->getUnitPrice()/2)* $quantityForHalfPrice);        
            
        }else{
            $productPrice = $product->getUnitPrice()*$quantity;  
           
        }
        return $productPrice;
    }
        
    /**
     * 
     * I am called to calculate the delivery charge on a basket.
     *
     * 
     * @param type $basketTotal
     * @return real|int
     */
    private function applyDeliveryChargeOnBasket($basketTotal){
        if($basketTotal >90){
            return 0;
        }elseif ($basketTotal >50 && $basketTotal < 90){
            return 2.95;
        }elseif($basketTotal <50){
            return 4.95;
        }
    }
}
