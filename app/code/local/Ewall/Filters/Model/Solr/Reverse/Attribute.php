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
class Ewall_Filters_Model_Solr_Reverse_Attribute extends Ewall_Filters_Model_Solr_Attribute
{
    /**
     * @param Enterprise_Search_Model_Resource_Collection $collection
     */
    public function applyToCollection($collection)
    {
        $engine = Mage::getResourceSingleton('enterprise_search/engine');
        $collection->addFqFilter(array($this->getFilterField() => array('reverse' => $this->getMSelectedValues())));
    }

}