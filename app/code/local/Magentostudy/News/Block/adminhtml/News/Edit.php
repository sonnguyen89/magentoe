<?php
/*
 * News list admin edit form containter
 * 
 * @author Magento
 */
class Magentostudy_News_Block_adminhtml_News_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
	/**
	 * Initialize edit form container
	 */
	
	public function __construct()
	{
		$this->_objectId = 'id';
		$this->_blockGroup='magentostudy_news';
		$this->_controller='adminhtml_news';
	}
}