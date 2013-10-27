<?php
/**
 * news controller
 * 
 * @author magento
 */
class Magentostudy_News_adminhtml_NewsController extends
Mage_Adminhtml_Controller_Action
{
	/**
	 * Init actions
	 */
	protected function _initAction()
	{
		//load layout, set active menu and breadcrumbs
		$this->loadLayout()
		->_setActiveMenu('news/manage')
		->_addBreadcrumb(
			Mage::helper('magentostudy_news')->__('News'),
			Mage::helper('magentostudy_news')->__('News')
		)->_addBreadcrumb(
				Mage::helper('magentostudy_news')->__('Manage news'),
				Mage::helper('magentostudy_news')->__('Manage news')
			);
		return $this;
	}
	/**
	 * Index action 
	 */
	public function indexAction()
	{
		$this->_title($this->__('News'))
			->_title($this->__('Manage News'));
		
		$this->_initAction();
	}
	/**
	 * create new News item
	 */
	
	public function newAction()
	{
		//the same form is used to create and edit
		$this->_forward('edit');
	}
	/**
	 * Edit News item
	 * 
	 */
	public function editAction()
	{
		$this->_title($this->__('News'))
			->_title($this->__('Manage News'));
		
		//1. instance news model
		/*
		 * @var $model Magentostudy_News_Model_Item
		 */
		$model = Mage::getModel('magentostudy_news/news');
		
		
		//2 . if ID exist, check it and load data
		$newId = $this->getRequest()->getParam('id');
		
		if($newId){
			$model->load($newsId);
			
			if(!$model->getId())
			{
				$this->_getSession()->addError(
				Mage::helper('magentostudy_news')->__('News Item does not exist')		
				);
				return $this->_redirect('*/*/');
			}
			//prepare title
			$this->_title($model->getTitle());
			$breadCrumb = Mage::helper($name)->__('Edit Item');
		}else{
			$this->_title(Mage::helper('magentostudy_news')->__('New Item'));
			$breadCrumb= Mage::helper('magentostudy_news')->__('New Item');
		}
		
		//init breadcrumbs
		$this->_initAction()->_addBreadcrumb($breadCrumb,$breadCrumb);
		
		//2. set Entered data if there was an error during save
		$data = Mage::getScriptSystemUrl('adminhtml/session')->getFormData(true);
		if(!empty($data)){
			$model->addData($data);
		}
		
		//4. register model to user later in blocks
		Mage::register('news_item',$model);
		
		//5. render layout
		$this->renderLayout();
	}
	
	
	/**
	 * save action
	 */
	public function saveAction(){
		
	}
}