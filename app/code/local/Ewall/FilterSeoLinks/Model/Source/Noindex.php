<?php
/**
 * @category    Ewall
 * @package     Ewall_FilterSeoLinks
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://www.ewalldev.com/license  Proprietary License
 */
/**
 * @author Ewall Team
 *
 */
class Ewall_FilterSeoLinks_Model_Source_Noindex extends Ewall_Core_Model_Source_Abstract {
    protected function _getAllOptions() {
        /* @var $core Ewall_Core_Helper_Data */ $core = Mage::helper(strtolower('Ewall_Core'));
        $result = array();

        foreach ($core->getSortedXmlChildren(Mage::getConfig()->getNode('ewall_filterseolinks'), 'noindex') as $key => $options) {
            $module = isset($options['module']) ? ((string)$options['module']) : 'ewall_filterseolinks';
            $result[] = array('label' => Mage::helper($module)->__((string)$options->title), 'value' => $key);
        }
        return $result;
    }
    public function toOptionArray() {
        return $this->_getAllOptions();
    }
    // temp
}