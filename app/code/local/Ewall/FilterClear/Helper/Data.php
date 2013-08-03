<?php
/**
 * @category    Ewall
 * @package     Ewall_FilterClear
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://www.ewalldev.com/license  Proprietary License
 */
/**
 * Generic helper functions for Ewall_FilterClear module. This class is a must for any module even if empty.
 * @author Ewall Team
 */
class Ewall_FilterClear_Helper_Data extends Mage_Core_Helper_Abstract {
    public function getClearUrl($filterBlock) {
        if (!Mage::getStoreConfigFlag('ewall_filters/advanced/clear')) {
            return false;
        }
        if (!($model = $filterBlock->getFilter())) {
            return false;
        }
        if (Mage::app()->getRequest()->getParam($model->getRequestVar()) == $model->getResetValue()) {
            return false;
        }
        return $model->getRemoveUrl();
    }
}