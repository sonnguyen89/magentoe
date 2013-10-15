<?php
/**
 * Magento Enterprise Edition
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Magento Enterprise Edition License
 * that is bundled with this package in the file LICENSE_EE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.magentocommerce.com/license/enterprise-edition
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Enterprise
 * @package     Enterprise_Queue
 * @copyright   Copyright (c) 2013 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://www.magentocommerce.com/license/enterprise-edition
 */

/**
 * Null worker reporter
 *
 * @category    Enterprise
 * @package     Enterprise_Queue
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Enterprise_Queue_Model_Worker_Reporter_Null implements Enterprise_Queue_Model_Worker_Reporter_Interface
{
    /**
     * Report processing task
     *
     * @param $taskId
     * @return Enterprise_Queue_Model_Worker_Reporter_Null
     */
    public function reportTaskProcessing($taskId)
    {
        return $this;
    }

    /**
     * Report completed task
     *
     * @param $taskId
     * @return Enterprise_Queue_Model_Worker_Reporter_Null
     */
    public function reportTaskCompleted($taskId)
    {
        return $this;
    }

    /**
     * Report failed task
     *
     * @param $taskId
     * @return Enterprise_Queue_Model_Worker_Reporter_Null
     */
    public function reportTaskFailed($taskId)
    {
        return $this;
    }
}
