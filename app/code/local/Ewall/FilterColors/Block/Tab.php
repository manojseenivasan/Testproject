<?php
/**
 * @category    Ewall
 * @package     Ewall_FilterColors
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://www.ewalldev.com/license  Proprietary License
 */

/**
 * Enter description here ...
 * @author Ewall Team
 *
 */
class Ewall_FilterColors_Block_Tab extends Mage_Adminhtml_Block_Text_List implements Mage_Adminhtml_Block_Widget_Tab_Interface {
	///////////////////////////////////////////////////////
	// TAB PROPERTIES
	///////////////////////////////////////////////////////
	
	/**
     * Return Tab label
     *
     * @return string
     */
    public function getTabLabel() {
    	return $this->__('Colors and Images');
    }

    /**
     * Return Tab title
     *
     * @return string
     */
    public function getTabTitle() {
    	return $this->__('Colors and Images');
    }

    /**
     * Can show tab in tabs
     *
     * @return boolean
     */
    public function canShowTab() {
    	return true;
    }

    /**
     * Tab is hidden
     *
     * @return boolean
     */
    public function isHidden() {
    	return !in_array(Mage::registry('m_crud_model')->getDisplay(), array('colors', 'colors_vertical', 'colors_label'));
    }
    
    public function getAjaxUrl() {
    	return Mage::helper('ewall_admin')->getStoreUrl('*/*/tabColors', 
			array('id' => Mage::app()->getRequest()->getParam('id')), 
			array('ajax' => 1)
		);
    }
}