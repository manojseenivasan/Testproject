<?php
/**
 * @category    Ewall
 * @package     Ewall_Filters
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Source for options of filter being filterable
 * @author Ewall Team
 *
 */
class Ewall_Filters_Model_Source_Filterable extends Ewall_Core_Model_Source_Abstract {
	protected function _getAllOptions() {
		return array(
            array('value' => '0', 'label' => Mage::helper('catalog')->__('No')),
            array('value' => '1', 'label' => Mage::helper('catalog')->__('Filterable (with results)')),
            array('value' => '2', 'label' => Mage::helper('catalog')->__('Filterable (no results)')),
        );
	}
	public function getDbType() {
		return 'tinyint';
	}
	public function getDbDefaultValue() {
		return 0;
	}
}