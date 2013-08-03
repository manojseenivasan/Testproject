<?php
/** 
 * @category    Ewall
 * @package     Ewall_FilterColors
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://www.ewalldev.com/license  Proprietary License
 */
/**
 * @author Ewall Team
 *
 */
class Ewall_FilterColors_Block_Filter extends Ewall_Filters_Block_Filter {
    public function getFilterClass() {
        /* @var $colors Ewall_FilterColors_Helper_Data */ $colors = Mage::helper(strtolower('Ewall_FilterColors'));
        return $colors->getFilterClass($this->getFilterOptions());
    }
    public function getFilterValueClass($item) {
        /* @var $colors Ewall_FilterColors_Helper_Data */ $colors = Mage::helper(strtolower('Ewall_FilterColors'));
        return $colors->getFilterValueClass($this->getFilterOptions(), $item->getValue());
    }

    protected function _prepareLayout() {
        /* @var $files Ewall_Core_Helper_Files */ $files = Mage::helper(strtolower('Ewall_Core/Files'));
        /* @var $colors Ewall_FilterColors_Helper_Data */ $colors = Mage::helper(strtolower('Ewall_FilterColors'));
        if (/* @var $head Mage_Page_Block_Html_Head */ $head = $this->getLayout()->getBlock('head')) {
            $css = $head->hasMCss() ? $head->getMCss() : array();
            $url = $colors->getCssRelativeUrl($this->getFilterOptions());
            if (!in_array($url, $css)) {
                $css[] = $url;
            }
            $head->setMCss($css);
        }
        return parent::_prepareLayout();
    }

}