<?php
/**
 * @category    Ewall
 * @package     Ewall_FilterExpandCollapse
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://www.ewalldev.com/license  Proprietary License
 */
/**
 * Generic helper functions for Ewall_FilterExpandCollapse module. This class is a must for any module even if empty.
 * @author Ewall Team
 */
class Ewall_FilterExpandCollapse_Helper_Data extends Mage_Core_Helper_Abstract {
    public function getCss($filterBlock) {
        if ($options = $filterBlock->getFilterOptions()) {
            /* @var $options Ewall_Filters_Model_Filter2_Store */
            switch ($options->getCollapseable()) {
                case 'expand':
                case 'collapse':
                    return ' m-collapseable';
                    break;
                default:
                    return '';
            }
        }
        else {
            return '';
        }
    }
    /**
     * @param Ewall_Filters_Block_View $block
     * @param Ewall_Filters_Model_Filter2_Store $filterOptions
     * @return string
     */
    public function isCollapseable($block, $filterOptions) {
        if ($block->getData("expanded_{$filterOptions->getCode()}")) {
            return 'expand';
        }
        elseif ($block->getData("collapsed_{$filterOptions->getCode()}")) {
            return 'collapse';
        }
        elseif ($block->getData("not_collapseable_{$filterOptions->getCode()}")) {
            return '';
        }
        else {
            return $filterOptions->getCollapseable();
        }
    }

}