<?php
/**
 * @category    Ewall
 * @package     Ewall_Filters
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://www.ewalldev.com/license  Proprietary License
 */
/**
 * @author Ewall Team
 *
 */
class Ewall_Filters_Model_Operation extends Ewall_Core_Model_Source_Abstract {
    protected function _getAllOptions() {
        return array(
            array('value' => '', 'label' => Mage::helper('ewall_filters')->__('Logical OR')),
            array('value' => 'and', 'label' => Mage::helper('ewall_filters')->__('Logical AND')),
        );
    }
}