<?php
/**
 * @category    Ewall
 * @package     Ewall_FilterAdmin
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://www.ewalldev.com/license  Proprietary License
 */

/**
 * Enter description here ...
 * @author Ewall Team
 *
 */
class Ewall_FilterAdmin_Block_List_Grid extends Ewall_Admin_Block_Crud_List_Grid {
	public function __construct() {
        parent::__construct();
        $this->setId('filterGrid');
        $this->setDefaultSort('position');
        $this->setDefaultDir('asc');
    }
	protected function _prepareCollection() {
		if (Mage::helper('ewall_admin')->isGlobal()) {
			/* @var $collection Ewall_Filters_Resource_Filter2_Collection */ 
			$collection = Mage::getResourceModel('ewall_filters/filter2_collection');
		}
		else {
			$collection = Mage::getResourceModel('ewall_filters/filter2_store_collection');
			$collection->addStoreFilter(Mage::helper('ewall_admin')->getStore());
			$collection->addColumnToSelect('global_id');
		}
		$collection->addColumnToSelect(array('position', 'code', 'name', 'is_enabled', 'is_enabled_in_search', 'display'));

        $this->setCollection($collection);
        parent::_prepareCollection();
        return $this;
	}
	protected function _prepareColumns() {
		$this->addColumn('position', array(
			'header' => $this->__('Position'),
			'index' => 'position',
            'filter_index' => 'main_table.position',
            'width' => '50px',
			'align' => 'center', 
		));
		$this->addColumn('code', array(
			'header' => $this->__('Code'),
			'index' => 'code',
			'width' => '100px',
		));
		$this->addColumn('name', array(
			'header' => $this->__('Name'),
			'index' => 'name',
			'filter_index' => 'main_table.name',
		));
		$this->addColumn('is_enabled', array(
			'header' => $this->__('In Category'),
			'index' => 'is_enabled',
            'filter_index' => 'main_table.is_enabled',
            'width' => '100px',
			'align' => 'center',
			'type' => 'options',
			'options' => Mage::getSingleton('ewall_filters/source_filterable')->getOptionArray(), 
		));
		$this->addColumn('is_enabled_in_search', array(
			'header' => $this->__('In Search'),
			'index' => 'is_enabled_in_search',
            'filter_index' => 'main_table.is_enabled_in_search',
            'width' => '100px',
			'align' => 'center',
			'type' => 'options',
			'options' => Mage::getSingleton('ewall_filters/source_filterable')->getOptionArray(), 
		));
		$this->addColumn('display', array(
			'header' => $this->__('Display As'),
			'index' => 'display',
            'filter_index' => 'main_table.display',
            'width' => '150px',
			'align' => 'center',
			'type' => 'options',
			'options' => Mage::getSingleton('ewall_filters/source_display_all')->getOptionArray(), 
		));
		parent::_prepareColumns();
		return $this;
	}
}