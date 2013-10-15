<?php
/*
 * News Image Helper
 * 
 * 
 * @author magento
 */

class Magentostudy_News_Helper_Image extends Mage_Core_Helper_Abstract
{
	/*
	 * Media path to extension images
	 * 
	 * @var string
	 * 
	 */
	
	const MEDIA_PATH = 'news';
	
	/**
	 * maximum size for image in bytes
	 * Default value is 1M
	 * 
	 * @var int
	 */
	const MAX_FILE_SIZE = 1048576;
	
	/**
	 * Minimum image height in pixels
	 * 
	 * @var int
	 */
	const MIN_HEIGHT = 50;
	
	/**
	 * Maximum image height in pixel
	 * 
	 * @var int
	 */
	const MAX_HEIGHT = 800;
	
	/**
	 * Minimum image Width in pixel
	 *
	 * @var int
	 */
	const MIN_WIDTH = 50;
	
	/**
	 * Maximum image Width in pixel
	 *
	 * @var int
	 */
	const MAX_WIDTH = 800;
	
	
	
	/**
	 * Array of image size limitation
	 *
	 * @var array
	 */
	protected $_imagesize = array(
		'minheight' =>self::MIN_HEIGHT,
		'minwidth' =>self::MIN_WIDTH,
		'maxheight' =>self::MAX_HEIGHT,
		'maxwidth' =>self::MAX_WIDTH,
	);
	
	/**
	 * Array of allowed file extensions
	 *
	 * @var array
	 */
	protected $_allowedExtensions = array('jpg','gif','png');
	
	/*
	 * Return the base media directory for news Item images
	 * 
	 * @return string
	 */
	public function getBaseDir()
	{
		return Mage::getBaseDir('media').DS.self::MEDIA_PATH;
	}
	
	/**
	 * return the base URL for News Item images
	 * 
	 * @return string
	 */
	public function getBaseUrl()
	{
		return Mage::getBaseUrl('media').'/'.self::MEDIA_PATH;
	}
	
	/**
	 * remove news item image by image filename
	 * 
	 * @param string $imageFile
	 * @return bool
	 */
	public function removeImage($imageFile)
	{
		$io = new Varien_Io_File();
		$io->open(array('path'=>$this->getBaseDir()));
		
		if ($io->fileExists($imageFile)){
			
			return $io->rm($imageFile);
		}
		return false;
		
	}
}