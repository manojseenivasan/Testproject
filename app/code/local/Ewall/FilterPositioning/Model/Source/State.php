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
class Ewall_FilterPositioning_Model_Source_State extends Ewall_Core_Model_Source_Abstract {
    protected function _getAllOptions() {
        return array(
            array('value' => '', 'label' => Mage::helper('ewall_filterpositioning')->__('No')),
            array('value' => 'all', 'label' => Mage::helper('ewall_filterpositioning')->__('Yes, Show All Filters Applied On Whole Page')),
            array('value' => 'this', 'label' => Mage::helper('ewall_filterpositioning')->__('Yes, But Only Filters Applied In This Block')),
        );
    }
    public function toOptionArray() {
        return $this->_getAllOptions();
    }
}