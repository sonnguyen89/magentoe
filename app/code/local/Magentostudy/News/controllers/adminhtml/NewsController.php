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
		$redirectPath='*/*';
		$redirectParams = array();
		
		//check if data sent
		$data = $this->getRequest()->getPost();
		if($data){
			$data = $this->_filterPostData($data);
			
			//init model and set data
			/*
			 * @var $model Magentostudy_news_model_item
			 */
			$model= Mage::getModel('magentostudy_news/news');
			
			//if news item exists, try to load it
			$newsId = $this->getRequest()->getParam('news_id');
			if($newsId){
				$model->load($newsId);
			}
			//save image data and remove from data array
			if (isset($data['image']))
			{
				$imageData = $data['image'];
				unset($data['image']);
			}else{
				$imageData= array();
			}
			$model->addData($data);
			try {
				$hasError= false;
				/* @var $imageHelper Magentostudy_News_Helper_Image */
				$imageHelper = Mage::helper('magentostudy_news/image');
				//remove image
				
				if (isset($imageData['delete']) && $model->getImage()){
					$imageHelper->removeImage($model->getImage());
					$model->setImage(null);
				}
				
				//upload new image
				$imageFile = $imageHelper->uploadImage('image');
				if ($imageFile){
					if ($model->getImage()){
						$imageHelper->removeImage($model->getImage());
					}
					$model->setImage($imageFile);
				}
				//save the data
				$model->save();
				
				//display success message
				$this->_getSession()->addSuccess(Mage::helper('magentostudy_news')->__('the news item has been saved'));

				//check if 'Save and Continue'
				if ($this->getRequest()->getParam('back')){
					$redirectPath = '*/*/edit';
					$redirectParams = array('id' => $model->getId());
				}
			}catch(Mage_Core_Exception $e){
				$hasError = true;
				$this->_getSession()->addError($e->getMessage());
			}catch (Exception $e){
				$hasError = true;
				$this->_getSession()->addException($e, Mage::helper('magentostudy_news')->__('An error occurred while saving the news item. '));
			}
			
			if ($hasError){
				$this->_getSession()->setFormData($data);
				$redirectPath = '*/*/edit';
				$redirectParams = array('id' => $this->getRequest()->getParam('id'));
			}
		}
		$this->_redirect($redirectPath,$redirectParams);
	}
}