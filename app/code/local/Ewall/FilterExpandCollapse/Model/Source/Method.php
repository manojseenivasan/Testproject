<?php
/**
 * @category    Ewall
 * @package     Ewall_FilterExpandCollapse
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://www.ewalldev.com/license  Proprietary License
 */
/**
 * @author Ewall Team
 *
 */
class Ewall_FilterExpandCollapse_Model_Source_Method extends Ewall_Core_Model_Source_Abstract {
	protected function _getAllOptions() {
		return array(
            array('value' => '', 'label' => Mage::helper('ewall_filterexpandcollapse')->__("Expanded, not collapseable")),
            array('value' => 'collapse', 'label' => Mage::helper('ewall_filterexpandcollapse')->__("Collapseable, initially collapsed")),
            array('value' => 'expand', 'label' => Mage::helper('ewall_filterexpandcollapse')->__("Collapseable, initially expanded")),
        );
	}
}