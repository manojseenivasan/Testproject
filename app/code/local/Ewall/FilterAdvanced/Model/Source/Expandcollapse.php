<?php
/**
 * @category    Ewall
 * @package     Ewall_FilterAdvanced
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://www.ewalldev.com/license  Proprietary License
 */
/**
 * @author Ewall Team
 *
 */
class Ewall_FilterAdvanced_Model_Source_Expandcollapse extends Ewall_Core_Model_Source_Abstract {
	protected function _getAllOptions() {
	    /* @var $t Ewall_FilterAdvanced_Helper_Data */ $t = Mage::helper(strtolower('Ewall_FilterAdvanced'));
		return array(
            array('value' => '', 'label' => $t->__("Expanded, not collapseable")),
            array('value' => 'collapse', 'label' => $t->__("Collapseable, initially collapsed")),
            array('value' => 'expand', 'label' => $t->__("Collapseable, initially expanded")),
        );
	}
}