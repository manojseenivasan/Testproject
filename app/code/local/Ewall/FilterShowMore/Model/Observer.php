<?php
/**
 * @category    Ewall
 * @package     Ewall_FilterShowMore
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://www.ewalldev.com/license  Proprietary License
 */
/* BASED ON SNIPPET: Models/Observer */
/**
 * This class observes certain (defined in etc/config.xml) events in the whole system and provides public methods - handlers for
 * these events.
 * @author Ewall Team
 *
 */
class Ewall_FilterShowMore_Model_Observer {
	/* BASED ON SNIPPET: Models/Event handler */
	/**
	 * In case filter item list is too long, truncates it and sets a flag on whole filter to enable additional 
	 * show more/show less actions on it. 
	 * @param Varien_Event_Observer $observer
	 */
	public function limitNumberOfVisibleItems($observer) {
		/* @var $filter Mage_Catalog_Model_Layer_Filter_Abstract */ $filter = $observer->getEvent()->getFilter();
		/* @var $items Varien_Object */ $items = $observer->getEvent()->getItems();
		
		/* @var $_helper Ewall_FilterShowMore_Helper_Data */ $_helper = Mage::helper(strtolower('Ewall_FilterShowMore'));
		if ($filter->getFilterOptions()->getShowMoreMethod() != 'popup') {
			$filter->setMIsShowMoreApplied(count($items->getItems()) > $filter->getFilterOptions()->getShowMoreItemCount());
		}
		elseif (!Mage::registry('m_showing_filter_popup')) {
			if (!$filter->getMIsShowMoreDisabled()) {
				/* @var $m Ewall_Core_Helper_Data */ $m = Mage::helper(strtolower('Ewall_Core'));
				$maxItemCount = $filter->getFilterOptions()->getShowMoreItemCount();
				if (count($items->getItems()) > $maxItemCount) {
				    $newItems = array();
				    foreach ($items->getItems() as $index => $item) {
				        /* @var $item Ewall_Filters_Model_Item */
				        if ($index < $maxItemCount || $item->getMSelected()) {
				            $newItems[] = $item;
				        }
				    }
					if (!$_helper->isShowAllRequested($filter)) {
						$items->setItems($newItems);
					}
					$filter->setMIsShowMoreApplied(true);
				}
			}
		}
	}
	
	/* BASED ON SNIPPET: Models/Event handler */
	/**
	 * Raises flag is config value changed this module's replicated tables rely on (handles event "ewall_database_is_config_changed")
	 * @param Varien_Event_Observer $observer
	 */
	public function isConfigChanged($observer) {
		/* @var $result Varien_Object */ $result = $observer->getEvent()->getResult();
		/* @var $configData Mage_Core_Model_Config_Data */ $configData = $observer->getEvent()->getConfigData();
		
		Mage::helper('ewall_db')->checkIfPathsChanged($result, $configData, array(
			'ewall_filters/display/show_more_item_count',
            'ewall_filters/display/show_more_method',
        ));
	}
	/* BASED ON SNIPPET: Models/Event handler */
	/**
	 * Adds columns to replication update select (handles event "ewall_database_update_columns")
	 * @param Varien_Event_Observer $observer
	 */
	public function prepareUpdateColumns($observer) {
		/* @var $target Ewall_Db_Model_Replication_Target */ $target = $observer->getEvent()->getTarget();
		/* @var $options array */ $options = $observer->getEvent()->getOptions();
		
		switch ($target->getEntityName()) {
			case 'ewall_filters/filter2_store':
				$target->getSelect('main')->columns(array(
					'global.show_more_item_count AS show_more_item_count',
                    'global.show_more_method AS show_more_method',
                ));
				break;
		}
	}
	/* BASED ON SNIPPET: Models/Event handler */
	/**
	 * Adds values to be updated (handles event "ewall_database_update_process")
	 * @param Varien_Event_Observer $observer
	 */
	public function processUpdate($observer) {
		/* @var $object Ewall_Db_Model_Object */ $object = $observer->getEvent()->getObject();
		/* @var $values array */ $values = $observer->getEvent()->getValues();
		/* @var $options array */ $options = $observer->getEvent()->getOptions();
		
		switch ($object->getEntityName()) {
			case 'ewall_filters/filter2':
				if (!Mage::helper('ewall_db')->hasOverriddenValue($object, $values, Ewall_Filters_Resource_Filter2::DM_SHOW_MORE_ITEM_COUNT)) {
					$object->setShowMoreItemCount(Mage::helper('ewall_db')->getLatestConfig('ewall_filters/display/show_more_item_count'));
				}
                if (!Mage::helper('ewall_db')->hasOverriddenValue($object, $values, Ewall_Filters_Resource_Filter2::DM_SHOW_MORE_METHOD)) {
                    $object->setShowMoreMethod(Mage::helper('ewall_db')->getLatestConfig('ewall_filters/display/show_more_method'));
                }
                break;
			case 'ewall_filters/filter2_store':
				if (!Mage::helper('ewall_db')->hasOverriddenValue($object, $values, Ewall_Filters_Resource_Filter2::DM_SHOW_MORE_ITEM_COUNT)) {
					$object->setShowMoreItemCount($values['show_more_item_count']);
				}
                if (!Mage::helper('ewall_db')->hasOverriddenValue($object, $values, Ewall_Filters_Resource_Filter2::DM_SHOW_MORE_METHOD)) {
                    $object->setShowMoreMethod($values['show_more_method']);
                }
                break;
		}
	}
	/* BASED ON SNIPPET: Models/Event handler */
	/**
	 * Adds columns to replication insert select (handles event "ewall_database_insert_columns")
	 * @param Varien_Event_Observer $observer
	 */
	public function prepareInsertColumns($observer) {
		/* @var $target Ewall_Db_Model_Replication_Target */ $target = $observer->getEvent()->getTarget();
		/* @var $options array */ $options = $observer->getEvent()->getOptions();
		
		switch ($target->getEntityName()) {
			case 'ewall_filters/filter2_store':
				$target->getSelect('main')->columns(array(
					'global.show_more_item_count AS show_more_item_count',
                    'global.show_more_method AS show_more_method',
                ));
				break;
		}
	}
	/* BASED ON SNIPPET: Models/Event handler */
	/**
	 * Adds values to be inserted (handles event "ewall_database_insert_process")
	 * @param Varien_Event_Observer $observer
	 */
	public function processInsert($observer) {
		/* @var $object Ewall_Db_Model_Object */ $object = $observer->getEvent()->getObject();
		/* @var $values array */ $values = $observer->getEvent()->getValues();
		/* @var $options array */ $options = $observer->getEvent()->getOptions();
		
		switch ($object->getEntityName()) {
			case 'ewall_filters/filter2':
				$object->setShowMoreItemCount(Mage::helper('ewall_db')->getLatestConfig('ewall_filters/display/show_more_item_count'));
                $object->setShowMoreMethod(Mage::helper('ewall_db')->getLatestConfig('ewall_filters/display/show_more_method'));
                break;
			case 'ewall_filters/filter2_store':
				$object->setShowMoreItemCount($values['show_more_item_count']);
                $object->setShowMoreMethod($values['show_more_method']);
                break;
		}
	}
	/* BASED ON SNIPPET: Models/Event handler */
	/**
	 * Adds fields into CRUD form (handles event "m_crud_form")
	 * @param Varien_Event_Observer $observer
	 */
	public function addFields($observer) {
		/* @var $formBlock Ewall_Admin_Block_Crud_Card_Form */ $formBlock = $observer->getEvent()->getForm();
		$form = $formBlock->getForm();
		
		switch ($formBlock->getEntityName()) {
			case 'ewall_filters/filter2':
			case 'ewall_filters/filter2_store':
				if ($form->getId() == 'mf_general') {
					$field = $form->getElement('mfs_display')->addField('show_more_item_count', 'text', array(
						'label' => Mage::helper('ewall_filtershowmore')->__('Item Limit'),
						'name' => 'show_more_item_count',
						'required' => true,
						'default_bit' => Ewall_Filters_Resource_Filter2::DM_SHOW_MORE_ITEM_COUNT,
						'default_label' => Mage::helper('ewall_admin')->isGlobal() 
							? Mage::helper('ewall_filtershowmore')->__('Use System Configuration') 
							: Mage::helper('ewall_filtershowmore')->__('Same For All Stores'),
					), 'position');
					$field->setRenderer(Mage::getSingleton('core/layout')->getBlockSingleton('ewall_admin/crud_card_field'));

                    $field = $form->getElement('mfs_display')->addField('show_more_method', 'select', array(
                        'label' => Mage::helper('ewall_filtershowmore')->__('Method of Showing All Items'),
                        'name' => 'show_more_method',
                        'required' => true,
                        'options' => Mage::getSingleton('ewall_filtershowmore/source_method')->getOptionArray(),
                        'default_bit' => Ewall_Filters_Resource_Filter2::DM_SHOW_MORE_METHOD,
                        'default_label' => Mage::helper('ewall_admin')->isGlobal()
                                ? Mage::helper('ewall_filtershowmore')->__('Use System Configuration')
                                : Mage::helper('ewall_filtershowmore')->__('Same For All Stores'),
                    ), 'show_more_item_count');
                    $field->setRenderer(Mage::getSingleton('core/layout')->getBlockSingleton('ewall_admin/crud_card_field'));
                }
				break;
		}
	}
	/* BASED ON SNIPPET: Models/Event handler */
	/**
	 * Adds edited data received via HTTP to specified model (handles event "ewall_database_add_edited_data")
	 * @param Varien_Event_Observer $observer
	 */
	public function addEditedData($observer) {
		/* @var $object Ewall_Db_Model_Object */ $object = $observer->getEvent()->getObject();
		/* @var $fields array */ $fields = $observer->getEvent()->getFields();
		/* @var $useDefault array */ $useDefault = $observer->getEvent()->getUseDefault();
		
		switch ($object->getEntityName()) {
			case 'ewall_filters/filter2':
			case 'ewall_filters/filter2_store':
				Mage::helper('ewall_db')->updateDefaultableField($object, 'show_more_item_count', Ewall_Filters_Resource_Filter2::DM_SHOW_MORE_ITEM_COUNT, $fields, $useDefault);
                Mage::helper('ewall_db')->updateDefaultableField($object, 'show_more_method', Ewall_Filters_Resource_Filter2::DM_SHOW_MORE_METHOD, $fields, $useDefault);
                break;
		}
	}
	/* BASED ON SNIPPET: Models/Event handler */
	/**
	 * Validates edited data (handles event "ewall_database_validate")
	 * @param Varien_Event_Observer $observer
	 */
	public function validate($observer) {
		/* @var $object Ewall_Db_Model_Object */ $object = $observer->getEvent()->getObject();
		/* @var $result Ewall_Db_Model_Validation */ $result = $observer->getEvent()->getResult();
		
        switch ($object->getEntityName()) {
            case 'ewall_filters/filter2':
            case 'ewall_filters/filter2_store':
                $t = Mage::helper('ewall_filtershowmore');
                if (trim($object->getShowMoreItemCount()) === '') {
                    $result->addError($t->__('Please fill in %s field', $t->__('Item Limit')));
                }
                break;
        }
	}

    /* BASED ON SNIPPET: Models/Event handler */
    /**
     * Calls minimized version of category action (handles event "controller_action_predispatch")
     * @param Varien_Event_Observer $observer
     */
    public function ajaxPopup($observer) {
        /* @var $action Mage_Catalog_CategoryController */
        $action = $observer->getEvent()->getControllerAction();
        $originalRoutePath = Mage::helper('ewall_core')->getRoutePath();
        if ($action->getRequest()->getParam('m-show-more-popup') && $originalRoutePath != 'ewall_filtershowmore/popup/view') {
            Mage::register('m_original_route_path', $originalRoutePath);
            $this->_forward($action->getRequest(), 'view', 'popup', 'ewall_filtershowmore');
        }
    }
    protected function _forward($request, $action, $controller = null, $module = null, array $params = null) {
        $request->initForward();

        if (!is_null($params)) {
            $request->setParams($params);
        }

        if (!is_null($controller)) {
            $request->setControllerName($controller);

            // Module should only be reset if controller has been specified
            if (!is_null($module)) {
                $request->setModuleName($module);
            }
        }

        $request->setActionName($action)
                ->setDispatched(false);
    }
}