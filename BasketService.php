<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * Your job is to implement the basket which needs to have the following interface –
    • It is initialised with the 
        * product catalogue, 
        * delivery charge rules, and 
        * offers (the format of how these are passed it up to you)
    • It has an add method that takes the product code as a parameter.
    • It has a total method that returns the total cost of the basket, taking into account
      the delivery and offer rules.
 * 
 */

/**
 *
 * @author maqsudmohammad
 */
interface BasketService {
    
    /**
     * I am called to return the Basket items.
     * 
     * @return type
     */
    public function getBasketItems();
    
    /**
     * I am called to add a product to the basket.
     * I take a productId and quantity.
     * 
     * @param type $productid
     * @param type $quantity
     * @return type
     */
    public function addProductToBasket($productid, $quantity);
    
    /**
     * I am called to calculate the basket total.
     * 
     * @return type
     */
    public function getBasketTotal();
}
