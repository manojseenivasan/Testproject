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
abstract class Ewall_Admin_Controller_Crud extends Mage_Adminhtml_Controller_Action {
	protected abstract function _getEntityName();
	
	protected function _registerModel() {
		if (Mage::helper('ewall_admin')->isGlobal()) {
			$model = Mage::getModel($this->_getEntityName())->load($this->getRequest()->getParam('id'));
		}
		else {
			$model = Mage::getModel($this->_getEntityName().'_store')->loadByGlobalId(
				$this->getRequest()->getParam('id'), 
				Mage::helper('ewall_admin')->getStore()->getId()
			);
		}
		Mage::register('m_crud_model', $model);
		return $model;
	}
}