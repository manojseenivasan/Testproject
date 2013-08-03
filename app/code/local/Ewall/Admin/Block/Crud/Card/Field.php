<?php
/**
 * @category    Ewall
 * @package     Ewall_Admin
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Renders one fieldset field including label, field itself and 'use default checkbox'
 * @author Ewall Team
 *
 */
class Ewall_Admin_Block_Crud_Card_Field extends Mage_Adminhtml_Block_Widget_Form_Renderer_Fieldset_Element {
    protected function _construct()
    {
        $this->setTemplate('ewall/admin/field.phtml');
    }
	
    public function getDefaultLabel() {
    	return $this->getElement()->getDefaultLabel();
	}
	public function getUsedDefault() {
    	return !Mage::helper('ewall_db')->hasOverriddenValue(
    		$this->getElement()->getForm()->getModel(),
    		null,  
    		$this->getElement()->getDefaultBit());
	}
    public function checkFieldDisable()
    {
        if ($this->getDisplayUseDefault() && $this->getUsedDefault()) {
            $this->getElement()->setDisabled(true);
        }
        return $this;
    }
    public function getDisplayUseDefault()
    {
    	return $this->getElement()->hasDefaultBit();
    }
    public function getUseDefaultEnabled()
    {
    	return !$this->getElement()->getIsDefaultDisabled();
    }
}