<?php
/**
 * @category    Ewall
 * @package     Ewall_FilterPositioning
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://www.ewalldev.com/license  Proprietary License
 */
/**
 * @author Ewall Team
 *
 */
class Ewall_FilterPositioning_Model_Source_Show_In extends Ewall_Core_Model_Source_Abstract {
    protected function _getAllOptions() {
        return array(
            array('value' => 'left', 'label' => Mage::helper('ewall_filterpositioning')->__('In Left Column')),
            array('value' => 'right', 'label' => Mage::helper('ewall_filterpositioning')->__('In Right Column')),
            array('value' => 'above_products', 'label' => Mage::helper('ewall_filterpositioning')->__('Above Product List')),
        );
    }
    public function toOptionArray() {
        return $this->_getAllOptions();
    }
}