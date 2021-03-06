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
class Ewall_Filters_Model_Filter2_Store extends Ewall_Filters_Model_Filter2 {
    protected $_eventPrefix = 'ewall_filter_store';
    /**
     * Invoked during model creation process, this method associates this model with resource and resource
     * collection classes
     */
	protected function _construct() {
		$this->_init(strtolower('Ewall_Filters/Filter2_Store'));
	}
    public function getSliderNumberFormat() {
        return $this->_getCurrentNumberFormat('slider_number_format');
    }
    public function getSliderNumberFormat2() {
        return $this->_getCurrentNumberFormat('slider_number_format2');
    }
    protected function _getCurrentNumberFormat($field) {
        $result = $this->getData($field);
        $store = Mage::app()->getStore();
        if ($result == '$0') {
            return str_replace('.00', '', str_replace(',00', '',
                $store->getCurrentCurrency()->formatPrecision(0, 0, array(), false, false)));
        }
        else {
            return $result;
        }
    }
}
