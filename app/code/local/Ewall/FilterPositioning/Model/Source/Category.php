<?php
/**
 * @category    Ewall
 * @package     Ewall_FilterPositioning
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://www.ewalldev.com/license  Proprietary License
 */

/**
 * Enter description here ...
 * @author Ewall Team
 *
 */
class Ewall_FilterPositioning_Model_Source_Category extends Ewall_Core_Model_Source_Abstract {
	protected function _getAllOptions() {
	    /* @var $t Ewall_FilterPositioning_Helper_Data */ $t = Mage::helper(strtolower('Ewall_FilterPositioning'));
		return array(
            array('value' => 'none', 'label' => $t->__('Hide')),
			array('value' => 'left', 'label' => $t->__('In Left Column')),
            array('value' => 'right', 'label' => $t->__('In Right Column')),
        );
	}
}