<?php


set_time_limit(0);

//Path to Mage File
$magentoFilename = '../../app/Mage.php';
require_once $magentoFilename;

Mage::init();






$model = Mage::getModel('catalog/product');
$products = $model->getCollection()->addAttributeToSelect('*')->addAttributeToFilter(
    'status',
    array('eq' => Mage_Catalog_Model_Product_Status::STATUS_ENABLED)
);
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
		//echo $message;
		
			$productNames=array();
			//load product name from csv file
			$file = fopen("products.csv", "r");
			$productNames = fgetcsv($file);
			//print_r($productNames);
			
			fclose($file);
			echo '<br/> '.count($productNames).'<br/>';
            $productIds = array();$productNotFound[] = array();
            foreach($products as $product){
	            foreach($productNames as $prodName)
		            {
		               if (strcasecmp($prodName,$product->getName()) == 0){
			               	
		               		$pname = $product->getName();
			                $prodID = $product->getId();
			                $message .=' Product Name: '.$pname.'-- product id: '.$prodID.'-- website id '.implode(",",$product->getWebsiteIds()) .'<br/>';
			                //get associated product from configured/bundle product
			                if($product->getTypeId() == "configurable"):
			              		 $childProducts = Mage::getModel('catalog/product_type_configurable')->setProduct($product)->getUsedProductCollection();
								foreach($childProducts as $child) {
									$child=$model->load($child->getId());
								    $message .= '---- Child Products: '. $child->getName().'-- product id: '.$child->getId().'--visibility: '.$child->getVisibility().'-- website id '.implode(",",$product->getWebsiteIds()).'<br/>'; // To show that we have it
								    
								   	if($child->getVisibility() == 1):
								    //$productIds[] = $child->getId();
								    endif;
								} 
							endif;
							
							  //get associated product from bundle product
							   if($product->getTypeId() == "bundle"):
			              		 $childProductids = $product->getTypeInstance(true)->getChildrenIds($product->getId(), false);
								foreach($childProductids as $childid) {
									$prod=$model->load($childid);
								    $message .= '---- Child Products: '. $prod->getName().'-- product id: '.$prod->getId().'--visibility: '.$prod->getVisibility().'-- website id '.implode(",",$product->getWebsiteIds()) .'<br/>'; // To show that we have it
								    
								    
								    if($prod->getVisibility() == 1):
								    //$productIds[] = $prod->getId();
								    endif;
								} 
							endif;
							
							
			                $productIds[] = $prodID;
		               } 
		            }
            }

       
            
            //print_r($productIds);
             
            echo $message;
           echo '<br/>'.count($productIds).' items found';
         	
            
//             $website_id=10;
//             $websiteData = array($website_id);
//            try {
			
//             //remove product from website
//             /* @var $actionModel Mage_Catalog_Model_Product_Action */
//          	 $actionModel = Mage::getSingleton('catalog/product_action');
            
//          	$actionModel->updateWebsites($productIds, $websiteData, 'remove');
            
//             //$actionModel->updateWebsites($productIds, $websiteData, 'add');
          
             
//          	 } catch(Exception $e) {
// 		        echo $e->getMessage();
// 		    }

//            echo '<p>items were removed from US Website</p>';
	


 



