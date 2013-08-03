<?php
/**
 * @category    Ewall
 * @package     Ewall_FilterShowMore
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://www.ewalldev.com/license  Proprietary License
 */
/**
 * @author Ewall Team
 *
 */
class Ewall_FilterShowMore_Model_Source_Popup extends Ewall_Core_Model_Source_Abstract {
    protected function _getAllOptions() {
        return array(
            array('value' => 'click', 'label' => Mage::helper('ewall_filtershowmore')->__("Mouse Click")),
            array('value' => 'mouseover', 'label' => Mage::helper('ewall_filtershowmore')->__('Mouse Over')),
        );
    }
}