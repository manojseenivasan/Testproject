<?php
/**
 * @category    Ewall
 * @package     Ewall_Ajax
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://www.ewalldev.com/license  Proprietary License
 */

class Ewall_Ajax_Model_Source_Method extends Ewall_Core_Model_Source_Abstract {
	protected function _getAllOptions() {
		return array(
            array('value' => Ewall_Ajax_Model_Method::MARK_WITH_CSS_CLASS, 'label' => Mage::helper('ewall_ajax')->__('Mark with CSS class')),
            array('value' => Ewall_Ajax_Model_Method::WRAP_INTO_CONTAINER, 'label' => Mage::helper('ewall_ajax')->__('Wrap into HTML element')),
        );
	}
}