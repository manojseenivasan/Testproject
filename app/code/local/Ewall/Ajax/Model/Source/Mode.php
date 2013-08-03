<?php
/**
 * @category    Ewall
 * @package     Ewall_Ajax
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://www.ewalldev.com/license  Proprietary License
 */

class Ewall_Ajax_Model_Source_Mode extends Ewall_Core_Model_Source_Abstract {
	protected function _getAllOptions() {
		return array(
            array('value' => Ewall_Ajax_Model_Mode::OFF, 'label' => Mage::helper('ewall_ajax')->__('No')),
            array('value' => Ewall_Ajax_Model_Mode::ON_FOR_ALL, 'label' => Mage::helper('ewall_ajax')->__('Yes')),
            array('value' => Ewall_Ajax_Model_Mode::ON_FOR_USERS, 'label' => Mage::helper('ewall_ajax')->__('Yes for Users, No for Search Bots (Listed Below)')),
        );
	}
}