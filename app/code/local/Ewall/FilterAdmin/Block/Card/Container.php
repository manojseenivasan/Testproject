<?php
/**
 * @category    Ewall
 * @package     Ewall_FilterAdmin
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://www.ewalldev.com/license  Proprietary License
 */

/**
 * Enter description here ...
 * @author Ewall Team
 *
 */
class Ewall_FilterAdmin_Block_Card_Container extends Ewall_Admin_Block_Crud_Card_Container {
    public function __construct() {
        parent::__construct();
        $model = Mage::registry('m_crud_model');
        $this->_headerText = $this->__('%s - Layered Navigation Filter', $model->getName());
    }
	protected function _prepareLayout() {
		$this->_addCloseButton()->_addApplyButton()->_addSaveButton();
	}
}