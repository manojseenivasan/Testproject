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
class Ewall_FilterSuperSlider_Model_Decimal extends Ewall_Filters_Model_Filter_Decimal {
    protected function _renderItemLabel($range, $value) {
        $range = $this->_getResource()->getRange($value, $range);
        /* @var $helper Ewall_FilterSuperSlider_Helper_Data */ $helper = Mage::helper(strtolower('Ewall_FilterSuperSlider'));
        $fromPrice  = $helper->formatNumber($range['from'], $this->getFilterOptions());
        $toPrice    = $helper->formatNumber($range['to'], $this->getFilterOptions());
        return Mage::helper('catalog')->__('%s - %s', $fromPrice, $toPrice);
    }
    public function getExistingValues() {
        $result = array();
        foreach ($this->_getResource()->getExistingValues($this) as $value) {
            $result[] = $value;
        }
        return array_values(array_unique($result));
    }

    public function isFilterAppliedWhenCounting($modelToBeApplied) {
        if ($this->_getIsFilterable() != 2) {
            return $modelToBeApplied != $this && $modelToBeApplied->getFilterOptions()->getDisplay() != 'slider';
        }
        else {
            return false;
        }
    }
}