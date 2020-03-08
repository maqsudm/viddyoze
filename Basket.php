<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Basket
 *
 * @author maqsudmohammad
 */
class Basket {
    //put your code here
    private $productsInBasket;
    
    private $basketTotal;
    
    private $deliveryCost;
    
            
    function Basket(){
        $this->itemName = "Apple Laptop";   
        if($quantity>1 && $quantity%2 ==0){
                $productPrice = $product->getUnitPrice()*($quantity/2);    
            }elseif($quantity>1 && $quantity%2 >0){
                $quantity = $quantity%2 + ($quantity/2);
                $productPrice = $product->getUnitPrice()* (int)$quantity;        
            }else{
                $productPrice = $product->getUnitPrice()*$quantity;
            }
    }
}
