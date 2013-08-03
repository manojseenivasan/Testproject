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
class Ewall_FilterColors_Ewall_FiltersController extends Ewall_Admin_Controller_Crud {
	protected function _getEntityName() {
		return 'ewall_filters/filter2';
	}
	public function tabColorsAction() {
		$model = $this->_registerModel();
		
		// layout
        $this->addActionLayoutHandles();
        $this->loadLayoutUpdates();
        $this->generateLayoutXml()->generateLayoutBlocks();
		$this->_isLayoutLoaded = true;

		// render AJAX result
		$this->renderLayout(); 
	}
	public function tabColorsGridAction() {
		$model = $this->_registerModel();
		if ($edit = $this->getRequest()->getParam('m-edit')) {
		    $edit = json_decode(base64_decode($edit), true);
		    Mage::helper('ewall_admin')->processPendingEdits('ewall_filters/filter2_value', $edit);
		}
		else {
		    $edit = null;
		}
		
		// layout
        $this->addActionLayoutHandles();
        $this->loadLayoutUpdates();
        $this->generateLayoutXml()->generateLayoutBlocks();
		$this->_isLayoutLoaded = true;
		$this->getLayout()->getBlock('colors_grid')->setEdit($edit);
		// render AJAX result
		$this->renderLayout(); 
	}
}