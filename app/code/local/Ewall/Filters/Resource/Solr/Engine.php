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
class Ewall_Filters_Resource_Solr_Engine extends Enterprise_Search_Model_Resource_Engine {
    /**
     * Retrieve results for search request
     *
     * @param  string $query
     * @param  array  $params
     * @param  string $entityType 'product'|'cms'
     * @return array
     */
    public function getResultForRequest($query, $params = array(), $entityType = 'product') {
        return $this->_adapter->search($query, $params);
    }
}