<?php


set_time_limit(0);

//Path to Mage File
$magentoFilename = '../../app/Mage.php';
require_once $magentoFilename;

Mage::init();
$productList = array(
				array("sku" => 'SOY1401'),
				array("sku" => 'SOY1402'),
				array("sku" => 'SOY1403'),
				array("sku" => 'SOY1404'),
				array("sku" => 'SOY1405')
			);
			
$productIds = array();$productNotFound[] = array();
foreach ($productList as $productInfo)
{
  extract($productInfo);
  echo $sku . "<br>";
  $product =  Mage::getModel('catalog/product')->loadByAttribute('sku',$sku);
  echo "PID:" . $product->getId();
   if ($product->getId()){
		
		echo "<br>" . $pname = $product->getName();
								
		$productIds[] = $product->getId();
   } 
}
echo '<br/>'.count($productIds).' items found';
         	
            

$websiteData = array(1);
try {

	//remove product from website
	/* @var $actionModel Mage_Catalog_Model_Product_Action */
	 $actionModel = Mage::getSingleton('catalog/product_action');
	
	$actionModel->updateWebsites($productIds, $websiteData, 'remove');
	
	//$actionModel->updateWebsites($productIds, $websiteData, 'add');
	
	echo "Product Removed From AUS";
 
 } catch(Exception $e) {
	echo $e->getMessage();
}


	


 



