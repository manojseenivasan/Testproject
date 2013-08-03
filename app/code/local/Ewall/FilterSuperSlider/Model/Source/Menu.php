<?php
/**
 * @category    Ewall
 * @package     Ewall_FilterSuperSlider
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://www.ewalldev.com/license  Proprietary License
 */
/**
 * @author Ewall Team
 *
 */
class Ewall_FilterSuperSlider_Model_Source_Menu extends Ewall_Core_Model_Source_Abstract {
    protected function _getAllOptions() {
        /* @var $t Ewall_FilterSuperSlider_Helper_Data */ $t = Mage::helper(strtolower('Ewall_FilterSuperSlider'));
        return array(
            array('value' => '', 'label' => $t->__('In Drop Down')),
            array('value' => 'inline', 'label' => $t->__('In Menu Line, Near Filter Name')),
        );
    }
}