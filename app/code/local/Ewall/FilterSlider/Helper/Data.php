<?php
/**
 * @category    Ewall
 * @package     Ewall_FilterSlider
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://www.ewalldev.com/license  Proprietary License
 */
/* BASED ON SNIPPET: New Module/Helper/Data.php */
/**
 * Generic helper functions for Ewall_FilterSlider module. This class is a must for any module even if empty.
 * @author Ewall Team
 */
class Ewall_FilterSlider_Helper_Data extends Mage_Core_Helper_Abstract {
	public function getUrl($name) {
		$query = array(
            $name=>'__0__,__1__',
            Mage::getBlockSingleton('page/html_pager')->getPageVarName() => null // exclude current page from urls
        );
        $params = array('_current' => true, '_m_escape' => '', '_use_rewrite' => true, '_query' => $query);
        return Mage::helper('ewall_filters')->markLayeredNavigationUrl(Mage::getUrl('*/*/*', $params), '*/*/*', $params);
	}
	public function getClearUrl($name) {
		$query = array(
            $name=>null,
            Mage::getBlockSingleton('page/html_pager')->getPageVarName() => null // exclude current page from urls
        );
        $params = array('_current' => true, '_m_escape' => '', '_use_rewrite' => true, '_query' => $query);
        return Mage::helper('ewall_filters')->markLayeredNavigationUrl(Mage::getUrl('*/*/*', $params), '*/*/*', $params);
	}
}