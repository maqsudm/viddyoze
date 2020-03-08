<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Product
 *
 * @author maqsudmohammad
 */
class Product {
    
    private $name;
    
    private $code;
    
    private $unitPrice;
    
    //$offer :: Object Offer
    private $offer;
    
    public function __construct($name, $code, $unitPrice, $offer) {
        $this->name = $name;
        $this->code = $code;
        $this->unitPrice=$unitPrice;
        $this->offer=$offer;
    }
    
    public function getName(){
        return $this->name;
    }
    
    public function getCode(){
        return $this->code;
    }
    
    public function getUnitPrice(){
        return $this->unitPrice;
    }
    
    public function getOffer(){
        return $this->offer;
    }
    
    public function __toString() {
        return $this->name;
    }
}
