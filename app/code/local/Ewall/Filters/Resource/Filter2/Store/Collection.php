<?php
/**
 * @category    Ewall
 * @package     Ewall_Filters
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/* BASED ON SNIPPET: Resources/DB operations with model collections */
/**
 * This resource model handles DB operations with a collection of models of type Ewall_Filters_Model_Filter2_Store. All 
 * database specific code for operating collection of Ewall_Filters_Model_Filter2_Store should go here.
 * @author Ewall Team
 */
class Ewall_Filters_Resource_Filter2_Store_Collection extends Ewall_Filters_Resource_Filter2_Collection {
    /**
     * Invoked during resource collection model creation process, this method associates this 
     * resource collection model with model class and with resource model class
     */
    protected function _construct()
    {
        $this->_init(strtolower('Ewall_Filters/Filter2_Store'));
    }
	/**
	 * Enter description here ...
	 * @param Ewall_Db_Model_Virtual_Result $result
	 * @param Varien_Db_Select $select
	 * @param array $columns
	 */
	protected function _addVirtualColumns($result, $select, $columns = null) {
		$globalEntityName = Mage::helper('ewall_db')->getGlobalEntityName($this->getEntityName());
		if (!$columns || in_array('code', $columns)) {
			Mage::helper('ewall_db')->joinLeft($select, 
				'global', Mage::getSingleton('core/resource')->getTableName($globalEntityName),
				'main_table.global_id = global.id');
			$select->columns("global.code AS code");
			$result->addColumn('code');
		}
		if (!$columns || in_array('type', $columns)) {
			Mage::helper('ewall_db')->joinLeft($select, 
				'global', Mage::getSingleton('core/resource')->getTableName($globalEntityName),
				'main_table.global_id = global.id');
			$select->columns("global.type AS type");
			$result->addColumn('type');
		}
	}
	public function addGlobalFields($fields) {
	    $select = $this->_select;
        $globalEntityName = Mage::helper('ewall_db')->getGlobalEntityName($this->getEntityName());
        Mage::helper('ewall_db')->joinLeft($select,
            'global', Mage::getSingleton('core/resource')->getTableName($globalEntityName),
            'main_table.global_id = global.id');
        $fields = array_merge(array('default_mask0'), $fields);
        foreach ($fields as $field) {
            $select->columns("global.$field AS global_$field");
        }
        return $this;
    }
}
