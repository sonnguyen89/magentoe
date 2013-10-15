<?php
/**
 * News installation script
 * 
 * @author magento
 */

/**
 * @var $installer Mage_Core_Model_Resource_Setup
 * 
 */
 $installer = $this;
 
 /**
  * Creating table magentostudy_news
  */
 $table = $installer->getConnection()
 	->newTable($installer->getTable('magentostudy_news/news'))
 	-> addColumn('news_id', Varien_Db_Ddl_Table::TYPE_INTEGER,NULL,array(
 			'unsigned' => true,
 			'identity' => true,
 			'nullable' => false,
 			'primary' => true,
 	), 'Entity id')
 	->addColumn('title', Varien_Db_Ddl_Table::TYPE_TEXT,255,array(
 			'nullable'=>true),'Title')
 	->addColumn('author',Varien_Db_Ddl_Table::TYPE_TEXT,63,array(
 			                                                    'nullable'=>true,
 			                                                     'default'=>null),'Author')
 	->addColumn('content',Varien_Db_Ddl_Table::TYPE_TEXT,'2M',array(
 			                                                    'nullable'=>true,
 			                                                     'default'=>null),'Content')
 	->addColumn('image',Varien_Db_Ddl_Table::TYPE_TEXT,null,array(
 			                                                    'nullable'=>true,
 			                                                     'default'=>null),'New Image Media Path')
 	->addColumn('published_at',Varien_Db_Ddl_Table::TYPE_DATE,null,array(
 			                                                    'nullable'=>true,
 			                                                     'default'=>null),'world published at')
    ->addColumn('created_at',Varien_Db_Ddl_Table::TYPE_TIMESTAMP,null,array(
 			                                                     		'nullable'=>true,
 			                                                     		'default'=>null),'Creation Time')
    ->addIndex($installer->getIdxName($installer->getTable('magentostudy_news/news'),
                                                              array('published_at'),Varien_Db_Adapter_Interface::INDEX_TYPE_INDEX),
                                                           array('published_at'),array('type' =>Varien_Db_Adapter_Interface::INDEX_TYPE_INDEX)
                                       )->setCommment('News item');
 			                                                     