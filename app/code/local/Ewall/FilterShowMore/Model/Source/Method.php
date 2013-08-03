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
class Ewall_FilterShowMore_Model_Source_Method extends Ewall_Core_Model_Source_Abstract {
    protected function _getAllOptions() {
        return array(
            array('value' => '', 'label' => Mage::helper('ewall_filtershowmore')->__("'Show More' and 'Show Less' actions")),
            array('value' => 'scrollbar', 'label' => Mage::helper('ewall_filtershowmore')->__('Scroll bar')),
            array('value' => 'popup', 'label' => Mage::helper('ewall_filtershowmore')->__("'Show More' popup")),
        );
    }
}