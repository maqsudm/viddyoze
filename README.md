# viddyoze
Test for ViddyOze

I have completed the test and added the following.

BasketService.php which is an interface which defines the methods.

BasketServiceImpl.php which is the main class which performs the operations on 
the basket. It takes BasketItems and Product Catalogue as arguments.

BasketItem.php which represents an Item in the basket which takes a Product and 
the quantity as a parameter.

Product.php is what represents a Product from the catalogue and it has the 
parameters defined in the test doc.

Assumptions I made based on my experience in the retail industry is, a product can 
only have one offer attached to it and I have implemented it accordingly.

The Offer.php can have multiple offers and they can be attached to the Product 
during initialisation.

I have added the test (BasketServiceImplTest) file to test all the scenarios 
mentioned in the test doc and they all work as expected.


