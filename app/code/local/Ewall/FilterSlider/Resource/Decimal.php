<?php
/**
 * @category    Ewall
 * @package     Ewall_FilterSlider
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://www.ewalldev.com/license  Proprietary License
 */

/**
 * Changes interpretation of applied price filter value
 * @author Ewall Team
 *
 */
class Ewall_FilterSlider_Resource_Decimal extends Ewall_Filters_Resource_Filter_Decimal {
    public function getRange($index, $range) {
    	return array('from' => $index, 'to' => $range);
    }
    protected function _isUpperBoundInclusive() {
        return true;
    }
}