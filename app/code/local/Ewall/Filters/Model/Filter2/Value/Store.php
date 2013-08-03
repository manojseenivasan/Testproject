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
class Ewall_Filters_Model_Filter2_Value_Store extends Ewall_Filters_Model_Filter2_Value {
    protected $_eventPrefix = 'ewall_filter_value_store';
    /**
     * Invoked during model creation process, this method associates this model with resource and resource
     * collection classes
     */
	protected function _construct() {
		$this->_init(strtolower('Ewall_Filters/Filter2_Value_Store'));
	}
}
