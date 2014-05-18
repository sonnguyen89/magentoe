<?php


set_time_limit(0);

//Path to Mage File
$magentoFilename = '../app/Mage.php';
require_once $magentoFilename;

Mage::init();

$storeId = 4;

$products = Mage::getModel('catalog/product')->getCollection()->addStoreFilter($storeId);
$model = Mage::getModel('catalog/product');
	
		foreach( $products as $product) {
			
		   	$prod=$model->load($product->getId());
		   	
		   	$pname = $prod->getName();
		   	$pstore = $prod->getStoreIds();
		    try {
		        //$product->save();
		       $message .=' Product Name: '.$pname.' '.$pstore.'<br/>';
		      
		    	
		    } catch(Exception $e) {
		        echo $e->getMessage();
		    }
		}
		echo $message;
		
		
		 //Mage::log($message,'products.log');
		 


