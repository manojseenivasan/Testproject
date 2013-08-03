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
class Ewall_Filters_Resource_Solr_Reverse_Attribute extends Ewall_Filters_Resource_Solr_Attribute
{
    /**
     * @param Enterprise_Search_Model_Resource_Collection $collection
     * @param Ewall_Filters_Model_Filter_Attribute $model
     * @param array $value
     * @return Ewall_Filters_Resource_Solr_Attribute
     */
    public function applyToCollection($collection, $model, $value)
    {
        $collection->addFqFilter(array($model->getFilterField() => array('reverse' => $value)));
    }
}