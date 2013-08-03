<?php
/**
 * @category    Ewall
 * @package     Ewall_Filters
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/* BASED ON SNIPPET: Models/Observer */
/**
 * This class observes certain (defined in etc/config.xml) events in the whole system and provides public methods - handlers for
 * these events.
 * @author Ewall Team
 *
 */
class Ewall_Filters_Model_Observer {
	/* BASED ON SNIPPET: Models/Event handler */
	/**
	 * Raises flag is config value changed this module's replicated tables rely on (handles event "ewall_database_is_config_changed")
	 * @param Varien_Event_Observer $observer
	 */
	public function isConfigChanged($observer) {
		/* @var $result Varien_Object */ $result = $observer->getEvent()->getResult();
		/* @var $configData Mage_Core_Model_Config_Data */ $configData = $observer->getEvent()->getConfigData();
		
		Mage::helper('ewall_db')->checkIfPathsChanged($result, $configData, array(
			'ewall_filters/display/attribute',
			'ewall_filters/display/price',
			'ewall_filters/display/category',
			'ewall_filters/display/decimal',
            'ewall_filters/display/sort_method',
		));
	}
	/**
	 * REPLACE THIS WITH DESCRIPTION (handles event "catalog_entity_attribute_save_commit_after")
	 * @param Varien_Event_Observer $observer
	 */
	public function afterCatalogAttributeSave($observer) {
        $dataObject = $observer->getEvent()->getDataObject();

        if (!$dataObject->getdata('_m_prevent_replication') && $dataObject->getIsFilterable() == 0) {
            $filter = Mage::getModel('ewall_filters/filter2')->load($dataObject->getAttributeCode(), 'code');
            if ($filter->getId()) {
                $filter->delete();
            }
        }
	}
	/**
	 * REPLACE THIS WITH DESCRIPTION (handles event "prepare_catalog_product_index_select")
	 * @param Varien_Event_Observer $observer
	 */
	public function fixAttributeIndexerSelectForConfigurableProductDefaultValues($observer) {
        if (Mage::helper('ewall_core')->isMageVersionEqualOrGreater('1.7')) {
            return;
        }

        /* @var $select Varien_Db_Select */ $select = $observer->getEvent()->getSelect();
		/* @var $entityField Zend_Db_Expr */ $entityField = $observer->getEvent()->getEntityField();

        /* @var $res Mage_Core_Model_Resource */ $res = Mage::getSingleton('core/resource');

        if (in_array((string)$entityField, array('pvd.entity_id', 'pid.entity_id', '`pvd`.`entity_id`', '`pid`.`entity_id`'))) {
            $select
                ->joinInner(
                    array('m_configurable_product' => $res->getTableName('catalog/product')),
                    'm_configurable_product.entity_id = '.$entityField, null)
                ->joinInner(
                    array('m_configurable_attribute' => $res->getTableName('catalog/eav_attribute')),
                    'm_configurable_attribute.attribute_id = ' . str_replace('entity_id', 'attribute_id', (string)$entityField), null)
                ->joinInner(
                    array('m_set_relation' => $res->getTableName('eav/entity_attribute')),
                    'm_set_relation.attribute_set_id = m_configurable_product.attribute_set_id AND m_set_relation.attribute_id = m_configurable_attribute.attribute_id', null)
                ->where("NOT((m_configurable_product.type_id = 'configurable') AND (m_configurable_attribute.is_configurable = 1))");
        }
    }
}