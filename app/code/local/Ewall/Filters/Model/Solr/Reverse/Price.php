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
class Ewall_Filters_Model_Solr_Reverse_Price extends Ewall_Filters_Model_Solr_Price
{
    /**
     * Applies filter values provided in URL to a given product collection
     *
     * @param Enterprise_Search_Model_Resource_Collection $collection
     * @return void
     */
    public function applyToCollection($collection)
    {
        $field             = $this->_getFilterField();
        $fq = array();
        foreach ($this->getMSelectedValues() as $selection) {
            if (strpos($selection, ',') !== false) {
                list($index, $range) = explode(',', $selection);
                $to = $range * $index;
                if ($to < $this->getMaxPriceInt() && !$this->isUpperBoundInclusive()) {
                    $to -= 0.001;
                }

                $fq[] = array(
                    'from' => ($range * ($index - 1)),
                    'to'   => $to,
                );
            }
        }

        $collection->addFqFilter(array($field => array('reverse' => $fq)));
    }
}