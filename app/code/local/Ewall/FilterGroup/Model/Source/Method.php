<?php
/**
 * @category    Ewall
 * @package     Ewall_FilterGroup
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://www.ewalldev.com/license  Proprietary License
 */
/**
 * @author Ewall Team
 *
 */
class Ewall_FilterGroup_Model_Source_Method extends Ewall_Core_Model_Source_Abstract {
	protected function _getAllOptions() {
		return array(
            array('value' => '', 'label' => Mage::helper('ewall_filtergroup')->__("Don't group filters")),
            array('value' => 'attribute_group', 'label' => Mage::helper('ewall_filtergroup')->__('Attribute groups')),
        );
	}
}