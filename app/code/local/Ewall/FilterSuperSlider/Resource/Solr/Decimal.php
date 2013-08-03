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
class Ewall_FilterSuperSlider_Resource_Solr_Decimal extends Ewall_Filters_Resource_Filter_Decimal {
    public function getRange($index, $range) {
    	return array('from' => $index, 'to' => $range);
    }
    public function isUpperBoundInclusive() {
        return true;
    }
    public function getExistingValues($filter) {
        $select     = $this->_getSelect($filter);
        $adapter    = $this->_getReadAdapter();

        $rangeExpr  = new Zend_Db_Expr("decimal_index.value");
        $select->columns(array('value' => 'decimal_index.value'));
        $select->group('value');
        $select->order('value');

        // MANA BEGIN: make sure price filter is not applied
        $select->reset(Zend_Db_Select::WHERE);
        // MANA END

        return $adapter->fetchCol($select);
    }
}