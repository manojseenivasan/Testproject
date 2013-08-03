<?php
/**
 * @category    Ewall
 * @package     Ewall_Filters
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/* BASED ON SNIPPET: Models/DB-backed model */
/**
 * INSERT HERE: what is this model for 
 * @author Ewall Team
 */
class Ewall_Filters_Model_Filter2 extends Ewall_Db_Model_Object {
    protected $_eventPrefix = 'ewall_filter';

    /**
     * Invoked during model creation process, this method associates this model with resource and resource
     * collection classes
     */
	protected function _construct() {
		$this->_init(strtolower('Ewall_Filters/Filter2'));
	}
	public function getDisplayOptions() {
		return Mage::getConfig()->getNode('ewall_filters/display/'.$this->getType().'/'.$this->getDisplay());	
	}
	public function getAttribute() {
		if ($this->getCode() == 'category') {
			return null;
		}
		if (!$this->hasData('attribute')) {
			/* @var $core Ewall_Core_Helper_Data */ $core = Mage::helper(strtolower('Ewall_Core'));
			$collection = Mage::getSingleton('ewall_filters/filter_default')->getFilterableAttributes($this->getStoreId());
			$attribute = $core->collectionFind($collection, 'attribute_code', $this->getCode());
			$this->setAttribute($attribute);
		}
		return $this->getData('attribute'); 
	}

	protected function _validate($result) {
		$t = Mage::helper('ewall_filters');
		if (trim($this->getIsEnabled()) === '') {
			$result->addError($t->__('Please fill in %s field', $t->__('In Category')));
		}
		if (trim($this->getDisplay()) === '') {
			$result->addError($t->__('Please fill in %s field', $t->__('Display As')));
		}
		if (trim($this->getName()) === '') {
			$result->addError($t->__('Please fill in %s field', $t->__('Name')));
		}
		if (trim($this->getIsEnabledInSearch()) === '') {
			$result->addError($t->__('Please fill in %s field', $t->__('In Search')));
		}
		if (trim($this->getPosition()) === '') {
			$result->addError($t->__('Please fill in %s field', $t->__('Position')));
		}
	}
    public function getCode() {
        return isset($this->_data['code']) ? $this->_data['code'] : null;
    }
}
