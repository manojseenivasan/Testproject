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
class Ewall_FilterColors_Block_State extends Mage_Core_Block_Template {
    public function __construct() {
        parent::__construct();
        $this->setTemplate('ewall/filtercolors/state.phtml');
    }
    public function getFilterValueClass($item) {
        /* @var $colors Ewall_FilterColors_Helper_Data */ $colors = Mage::helper(strtolower('Ewall_FilterColors'));
        return $colors->getFilterValueClass($this->getFilterOptions(), $item->getValue());
    }

}