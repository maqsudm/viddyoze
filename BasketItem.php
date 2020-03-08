<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BasketItems
 *
 * @author maqsudmohammad
 */
class BasketItem {  
    //put your code here
    
    private $product;
    
    private $quantity;
    
    public function __construct( $product, $quantity) {
        $this->product=$product;
        $this->quantity=$quantity;
    }
    
    public function getProduct(){
        return $this->product;
    }
    
    public function setQuantity($quantity){
        $this->quantity = $quantity;
    }
    
    public function getQuantity(){
        return $this->quantity;
    }
    
    public function __toString() {
    return $this->getProduct()->getName();
}
}
