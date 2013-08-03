<?php
/**
 * @category    Ewall
 * @package     Ewall_FilterGroup
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://www.ewalldev.com/license  Proprietary License
 */
/**
 * This class observes certain (defined in etc/config.xml) events in the whole system and provides public methods -
 * handlers for these events.
 * @author Ewall Team
 *
 */
class Ewall_FilterGroup_Model_Observer {
    /**
     * REPLACE THIS WITH DESCRIPTION (handles event "m_advanced_filter_groups")
     * @param Varien_Event_Observer $observer
     */
    public function getGroups($observer) {
        /* @var $block Ewall_Filters_Block_View */ $block = $observer->getEvent()->getBlock();
        /* @var $result Varien_Object */ $result = $observer->getEvent()->getResult();

        /* @var $groupHelper Ewall_FilterGroup_Helper_Data */ $groupHelper = Mage::helper(strtolower('Ewall_FilterGroup'));
        if (Mage::getStoreConfig('ewall_filters/advanced/group_by') == 'attribute_group') {
            $result->setResult($groupHelper->getAttributeGroups($block->getFilters()));
        }
    }
    /**
     * REPLACE THIS WITH DESCRIPTION (handles event "m_advanced_filter_group_css")
     * @param Varien_Event_Observer $observer
     */
    public function renderCss($observer) {
        /* @var $block Ewall_Filters_Block_View */ $block = $observer->getEvent()->getBlock();
        /* @var $group Varien_Object */ $group = $observer->getEvent()->getGroup();

        switch (Mage::getStoreConfig('ewall_filters/advanced/collapseable_groups')) {
            case 'expand':
            case 'collapse':
                echo ' m-collapseable-group';
                break;
        }
    }
    /**
     * REPLACE THIS WITH DESCRIPTION (handles event "m_advanced_filter_group_attributes")
     * @param Varien_Event_Observer $observer
     */
    public function renderAttributes($observer) {
        /* @var $block Ewall_Filters_Block_View */ $block = $observer->getEvent()->getBlock();
        /* @var $group Varien_Object */ $group = $observer->getEvent()->getGroup();

        switch (Mage::getStoreConfig('ewall_filters/advanced/collapseable_groups')) {
            case 'collapse':
                $collapsed = true;
                foreach ($group->getFilters() as $filter) {
                    if (Mage::app()->getFrontController()->getRequest()->getParam($filter->getFilter()->getRequestVar()) != $filter->getFilter()->getResetValue()) {
                        $collapsed = false;
                        break;
                    }
                }
                if ($collapsed) {
                    echo ' data-collapsed="collapsed"';
                }
                break;
        }
    }
    /**
     * REPLACE THIS WITH DESCRIPTION (handles event "m_advanced_filter_group_action")
     * @param Varien_Event_Observer $observer
     */
    public function renderAction($observer) {
        /* @var $block Ewall_Filters_Block_View */ $block = $observer->getEvent()->getBlock();
        /* @var $group Varien_Object */ $group = $observer->getEvent()->getGroup();
    	/* @var $layout Mage_Core_Model_Layout */ $layout = Mage::getSingleton('core/layout');
    	/* @var $result Varien_Object */ $result = $observer->getEvent()->getResult();
    	if ($helperBlock = $layout->getBlock('ewall_filter_group_expandcollapse')) {
            if ($html = trim($helperBlock->toHtml())) {
                $actions = $result->getResult();
                $actions[] = array('html' => $html, 'position' => 200);
                $result->setResult($actions);
            }
        }
    }

}