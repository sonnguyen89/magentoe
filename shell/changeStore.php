<?php


set_time_limit(0);

//Path to Mage File
$magentoFilename = '../app/Mage.php';
require_once $magentoFilename;

Mage::init();


$productNames=array('Nokia 2610 Phone','BlackBerry 8100 Pearl','HTC Touch Diamond ','AT&T 8525 PDA');




$model = Mage::getModel('catalog/product');
//$storeId = 4;
//$products = Mage::getModel('catalog/product')->getCollection()->addStoreFilter($storeId);
	
		/*foreach( $products as $product) {
			
		   	$prod=$model->load($product->getId());
		   	
		   	$pname = $prod->getName();
		   	$prodID = $prod->getId();
		    try {
		        //$product->save();
		       $message .=' Product Name: '.$pname.'-- product id: '.$prodID.'<br/>';
		      
		    	
		    } catch(Exception $e) {
		        echo $e->getMessage();
		    }
		}*/
            $productIds = array();
            foreach($productNames as $prodName)
            {
                $prod=$model->loadByAttribute('name', $prodName);
                $pname = $prod->getName();
                $prodID = $prod->getId();
                $message .=' Product Name: '.$pname.'-- product id: '.$prodID.'<br/>';
                $productIds[] = $prodID;

            }
            //print_r($productIds);
            $website_id=2;
            $websiteRemoveData = array($website_id);


            //remove product from website
            /* @var $actionModel Mage_Catalog_Model_Product_Action */
            $actionModel = Mage::getSingleton('catalog/product_action');

            $actionModel->updateWebsites($productIds, $websiteRemoveData, 'remove');

//echo $message;


 //Mage::log($message,'products.log');



