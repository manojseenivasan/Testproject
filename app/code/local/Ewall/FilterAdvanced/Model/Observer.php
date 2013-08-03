<?php
/**
 * @category    Ewall
 * @package     Ewall_FilterAdvanced
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://www.ewalldev.com/license  Proprietary License
 */
/**
 * This class observes certain (defined in etc/config.xml) events in the whole system and provides public methods -
 * handlers for these events.
 * @author Ewall Team
 *
 */
class Ewall_FilterAdvanced_Model_Observer {
    /**
     * REPLACE THIS WITH DESCRIPTION (handles event "m_advanced_filter_name_before")
     * @param Varien_Event_Observer $observer
     */
    public function renderActions($observer) {
        /* @var $block Ewall_Filters_Block_View */ $block = $observer->getEvent()->getBlock();
        /* @var $filter Ewall_Filters_Block_Filter */ $filter = $observer->getEvent()->getFilter();
    	/* @var $layout Mage_Core_Model_Layout */ $layout = Mage::getSingleton('core/layout');
    	if ($helperBlock = $layout->getBlock('ewall_filter_actions')) {
            echo $helperBlock->setFilter($filter)->toHtml();
        }
    }
    /**
     * REPLACE THIS WITH DESCRIPTION (handles event "m_advanced_filter_group_before")
     * @param Varien_Event_Observer $observer
     */
    public function renderGroupActions($observer) {
        /* @var $block Ewall_Filters_Block_View */ $block = $observer->getEvent()->getBlock();
        /* @var $group Varien_Object */ $group = $observer->getEvent()->getGroup();
    	/* @var $layout Mage_Core_Model_Layout */ $layout = Mage::getSingleton('core/layout');
    	if ($helperBlock = $layout->getBlock('ewall_filter_actions')) {
            echo $helperBlock->setGroup($group)->setFilter(null)->toHtml();
        }
    }
}