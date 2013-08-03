<?php
/**
 * @category    Ewall
 * @package     Ewall_FilterHelp
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://www.ewalldev.com/license  Proprietary License
 */
/**
 * This class observes certain (defined in etc/config.xml) events in the whole system and provides public methods -
 * handlers for these events.
 * @author Ewall Team
 *
 */
class Ewall_FilterHelp_Model_Observer {
	/**
	 * Raises flag is config value changed this module's replicated tables rely on (handles event "ewall_database_is_config_changed")
	 * @param Varien_Event_Observer $observer
	 */
	public function isConfigChanged($observer) {
		/* @var $result Varien_Object */ $result = $observer->getEvent()->getResult();
		/* @var $configData Mage_Core_Model_Config_Data */ $configData = $observer->getEvent()->getConfigData();

		Mage::helper('ewall_db')->checkIfPathsChanged($result, $configData, array(
			'ewall_filters/advanced/help_width',
        ));
	}

    /**
     * REPLACE THIS WITH DESCRIPTION (handles event "ewall_database_update_columns")
     * @param Varien_Event_Observer $observer
     */
    public function prepareUpdateColumns($observer) {
		/* @var $target Ewall_Db_Model_Replication_Target */ $target = $observer->getEvent()->getTarget();
		/* @var $options array */ $options = $observer->getEvent()->getOptions();

		switch ($target->getEntityName()) {
			case 'ewall_filters/filter2_store':
				$target->getSelect('main')->columns(array(
					'global.help AS help',
					'global.help_width AS help_width',
                ));
				break;
		}
    }
    /**
     * REPLACE THIS WITH DESCRIPTION (handles event "ewall_database_update_process")
     * @param Varien_Event_Observer $observer
     */
    public function processUpdate($observer) {
		/* @var $object Ewall_Db_Model_Object */ $object = $observer->getEvent()->getObject();
		/* @var $values array */ $values = $observer->getEvent()->getValues();
		/* @var $options array */ $options = $observer->getEvent()->getOptions();

		switch ($object->getEntityName()) {
			case 'ewall_filters/filter2':
				if (!Mage::helper('ewall_db')->hasOverriddenValue($object, $values, Ewall_Filters_Resource_Filter2::DM_HELP_WIDTH)) {
					$object->setHelpWidth(Mage::helper('ewall_db')->getLatestConfig('ewall_filters/advanced/help_width'));
				}
                break;
			case 'ewall_filters/filter2_store':
				if (!Mage::helper('ewall_db')->hasOverriddenValue($object, $values, Ewall_Filters_Resource_Filter2::DM_HELP)) {
					$object->setHelp($values['help']);
				}
                if (!Mage::helper('ewall_db')->hasOverriddenValue($object, $values, Ewall_Filters_Resource_Filter2::DM_HELP_WIDTH)) {
                    $object->setHelpWidth($values['help_width']);
                }
                break;
		}
    }
    /**
     * REPLACE THIS WITH DESCRIPTION (handles event "ewall_database_insert_columns")
     * @param Varien_Event_Observer $observer
     */
    public function prepareInsertColumns($observer) {
		/* @var $target Ewall_Db_Model_Replication_Target */ $target = $observer->getEvent()->getTarget();
		/* @var $options array */ $options = $observer->getEvent()->getOptions();

		switch ($target->getEntityName()) {
			case 'ewall_filters/filter2_store':
				$target->getSelect('main')->columns(array(
					'global.help AS help',
					'global.help_width AS help_width',
                ));
				break;
		}
    }
    /**
     * REPLACE THIS WITH DESCRIPTION (handles event "ewall_database_insert_process")
     * @param Varien_Event_Observer $observer
     */
    public function processInsert($observer) {
		/* @var $object Ewall_Db_Model_Object */ $object = $observer->getEvent()->getObject();
		/* @var $values array */ $values = $observer->getEvent()->getValues();
		/* @var $options array */ $options = $observer->getEvent()->getOptions();

		switch ($object->getEntityName()) {
			case 'ewall_filters/filter2':
    			$object->setHelpWidth(Mage::helper('ewall_db')->getLatestConfig('ewall_filters/advanced/help_width'));
                break;
			case 'ewall_filters/filter2_store':
    			$object->setHelp($values['help']);
                $object->setHelpWidth($values['help_width']);
                break;
		}
    }
    /**
     * REPLACE THIS WITH DESCRIPTION (handles event "ewall_database_add_edited_data")
     * @param Varien_Event_Observer $observer
     */
    public function addEditedData($observer) {
		/* @var $object Ewall_Db_Model_Object */ $object = $observer->getEvent()->getObject();
		/* @var $fields array */ $fields = $observer->getEvent()->getFields();
		/* @var $useDefault array */ $useDefault = $observer->getEvent()->getUseDefault();

		switch ($object->getEntityName()) {
			case 'ewall_filters/filter2':
			case 'ewall_filters/filter2_store':
				Mage::helper('ewall_db')->updateDefaultableField($object, 'help', Ewall_Filters_Resource_Filter2::DM_HELP, $fields, $useDefault);
				Mage::helper('ewall_db')->updateDefaultableField($object, 'help_width', Ewall_Filters_Resource_Filter2::DM_HELP_WIDTH, $fields, $useDefault);
                break;
		}
    }

    /**
     * REPLACE THIS WITH DESCRIPTION (handles event "m_crud_form")
     * @param Varien_Event_Observer $observer
     */
    public function addFields($observer) {
        /* @var $formBlock Ewall_Admin_Block_Crud_Card_Form */ /** @noinspection PhpUndefinedMethodInspection */
        $formBlock = $observer->getEvent()->getForm();
        $form = $formBlock->getForm();
        /* @var $layout Mage_Core_Model_Layout */
        $layout = Mage::getSingleton(strtolower('Core/Layout'));
        /* @var $fieldsetRenderer Ewall_Admin_Block_Crud_Card_Fieldset */ $fieldsetRenderer =
        $layout->getBlockSingleton(strtolower('Ewall_Admin/Crud_Card_Fieldset'));
        /* @var $fieldRenderer Ewall_Admin_Block_Crud_Card_Field */ $fieldRenderer =
        $layout->getBlockSingleton(strtolower('Ewall_Admin/Crud_Card_Field'));
        /* @var $admin Ewall_Admin_Helper_Data */ $admin = Mage::helper(strtolower('Ewall_Admin'));
        /* @var $t Ewall_FilterHelp_Helper_Data */ $t = Mage::helper(strtolower('Ewall_FilterHelp'));
        /* @var $model Ewall_Filters_Model_Filter2 */
        /** @noinspection PhpUndefinedMethodInspection */
        $model = $form->getModel();

        switch ($formBlock->getEntityName()) {
            case 'ewall_filters/filter2':
            case 'ewall_filters/filter2_store':
                if ($form->getId() == 'mf_advanced') {
                    // fieldset - collection of fields
                    $fieldset = $form->addFieldset('mfs_help', array(
                        'title' => $t->__('Help Tooltip'),
                        'legend' => $t->__('Help Tooltip'),
                    ));
                    $fieldset->setRenderer($fieldsetRenderer);

//                    $widgetFilters = array('is_email_compatible' => 1);
//                    $wysiwygConfig = Mage::getSingleton('cms/wysiwyg_config')->getConfig(array('widget_filters' => $widgetFilters));
                    $field = $fieldset->addField('help', 'textarea', array_merge(array(
                        'label' => $t->__('Text'),
                        'note' => $t->__('If empty no tooltip appears in frontend'),
                        'wysiwyg' => true,
//                        'state' => 'html',
//                        'config' => $wysiwygConfig,
                        'name' => 'help',
                        'required' => false,
                    ), $admin->isGlobal() ? array() : array(
                        'default_bit' => Ewall_Filters_Resource_Filter2::DM_HELP,
                        'default_label' => $t->__('Same For All Stores'),
                    )));
                    $field->setRenderer($fieldRenderer);

					$field = $fieldset->addField('help_width', 'text', array(
						'label' => $t->__('Popup Width'),
                        'note' => $t->__('in pixels'),
						'name' => 'help_width',
						'required' => true,
						'default_bit' => Ewall_Filters_Resource_Filter2::DM_HELP_WIDTH,
						'default_label' => Mage::helper('ewall_admin')->isGlobal()
							? $t->__('Use System Configuration')
							: $t->__('Same For All Stores'),
					));
					$field->setRenderer($fieldRenderer);
                }
                break;
        }
    }

    /**
     * REPLACE THIS WITH DESCRIPTION (handles event "m_advanced_filter_name_after")
     * @param Varien_Event_Observer $observer
     */
    public function render($observer) {
        /* @var $block Ewall_Filters_Block_View */ $block = $observer->getEvent()->getBlock();
        /* @var $filter Ewall_Filters_Block_Filter */ $filter = $observer->getEvent()->getFilter();
    	/* @var $layout Mage_Core_Model_Layout */ $layout = Mage::getSingleton('core/layout');
    	if ($helperBlock = $layout->getBlock('ewall_filter_help')) {
            echo $helperBlock->setFilter($filter)->toHtml();
        }
    }
}