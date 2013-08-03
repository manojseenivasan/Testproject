<?php
/**
 * @category    Ewall
 * @package     Ewall_Admin
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Enter description here ...
 * @author Ewall Team
 *
 */
class Ewall_Admin_Block_Crud_Card_Container extends Mage_Adminhtml_Block_Widget_Container {
    /**
     * Set template
     */
    public function __construct() {
        parent::__construct();
        $this->setTemplate('ewall/admin/container.phtml');
    }
	protected function _addCloseButton() {
		$this->_addButton('close', array('label' => $this->__('Close'), 'class' => 'back m-close-action'));
		Mage::helper('ewall_core/js')->options('button.m-close-action', array(
			'redirect_to' => Mage::helper('ewall_admin')->getStoreUrl('*/*/index'),
		));
		return $this;
	}
	protected function _addApplyButton() {
		$this->_addButton('apply', array('label' => $this->__('Apply'), 'class' => 'save m-save-action'));
		Mage::helper('ewall_core/js')->options('button.m-save-action', array(
			'action' => Mage::helper('ewall_admin')->getStoreUrl('*/*/save', 
				array('id' => Mage::app()->getRequest()->getParam('id')), 
				array('ajax' => 1)
			),
		));
		return $this;
	}
	protected function _addSaveButton() {
		$this->_addButton('save', array('label' => $this->__('Save'), 'class' => 'save m-save-and-close-action'));
		Mage::helper('ewall_core/js')->options('button.m-save-and-close-action', array(
			'redirect_to' => Mage::helper('ewall_admin')->getStoreUrl('*/*/index'),
			'action' => Mage::helper('ewall_admin')->getStoreUrl('*/*/save', 
				array('id' => Mage::app()->getRequest()->getParam('id')), 
				array('ajax' => 1)
			),
		));
		return $this;
	}
}