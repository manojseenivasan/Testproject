<?php
/**
 * @category    Ewall
 * @package     Ewall_FilterShowMore
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://www.ewalldev.com/license  Proprietary License
 */
/* BASED ON SNIPPET: New Module/Helper/Data.php */
/**
 * Generic helper functions for Ewall_FilterShowMore module. This class is a must for any module even if empty.
 * @author Ewall Team
 */
class Ewall_FilterShowMore_Helper_Data extends Mage_Core_Helper_Abstract {
	public function getShowAllSuffix() {
        /* @var $_core Ewall_Core_Helper_Data */ $_core = Mage::helper(strtolower('Ewall_Core'));
		return $_core->getStoreConfig('ewall_filters/seo/show_all_suffix');
	}
	/**
	 * Returns true if all the items show be shown for that filter (as specified in URL) and false if item list
	 * should be truncated
	 * @param Ewall_Filters_Model_Filter_Attribute $filter
	 * @return boolean
	 */
	public function isShowAllRequested($filter) {
    	$value = Mage::app()->getRequest()->getParam($filter->getRequestVar().$this->getShowAllSuffix());
		return $value && $value == 1 ? true : false;    
	}
	/**
	 * Returns current URL modified to enable showing full item list 
	 * @param Ewall_Filters_Model_Filter_Attribute $filter
	 * @return string
	 */
	public function getShowMoreUrl($filter) {
    	/* @var $ext Ewall_Filters_Helper_Extended */ $ext = Mage::helper(strtolower('Ewall_Filters/Extended'));
        $params = array('_secure' => Mage::app()->getFrontController()->getRequest()->isSecure());
		$params['_current']     = true;
        $params['_use_rewrite'] = true;
        $params['_m_escape'] = '';
        $params['_query']       = array($filter->getRequestVar().$this->getShowAllSuffix() => 1);
        return Mage::helper('ewall_filters')->markLayeredNavigationUrl(Mage::getUrl('*/*/*', $params), '*/*/*', $params);
	}
	/**
	 * Returns current URL modified to enable showing truncated item list 
	 * @param Ewall_Filters_Model_Filter_Attribute $filter
	 * @return string
	 */
	public function getShowLessUrl($filter) {
    	/* @var $ext Ewall_Filters_Helper_Extended */ $ext = Mage::helper(strtolower('Ewall_Filters/Extended'));
        $params = array('_secure' => Mage::app()->getFrontController()->getRequest()->isSecure());
		$params['_current']     = true;
        $params['_use_rewrite'] = true;
        $params['_m_escape'] = '';
        $params['_query']       = array($filter->getRequestVar().$this->getShowAllSuffix() => null);
        return Mage::helper('ewall_filters')->markLayeredNavigationUrl(Mage::getUrl('*/*/*', $params), '*/*/*', $params);
	}
    public function getPopupUrl($filter) {
        $params = array('_secure' => Mage::app()->getFrontController()->getRequest()->isSecure());
        $params['_current'] = true;
        $params['_use_rewrite'] = true;
        $params['_m_escape'] = '';
        /* @var $core Ewall_Core_Helper_Data */
        $core = Mage::helper(strtolower('Ewall_Core'));
        $params['_query'] = array(
            'm-show-more-popup' => $filter->getFilterOptions()->getId(),
            'm-seo-enabled' => $core->getRoutePath() != 'catalogsearch/result/index' ? 1 : 0,
        );
        if ($core->getRoutePath() != 'catalogsearch/result/index') {
            $params['_query']['m-show-more-cat'] = Mage::getSingleton('catalog/layer')->getCurrentCategory()->getId();
        }
        return Mage::helper('ewall_filters')->markLayeredNavigationUrl(Mage::getUrl('*/*/*', $params), '*/*/*', $params);
    }
    public function getPopupTargetUrl($filter) {
        $params = array('_secure' => Mage::app()->getFrontController()->getRequest()->isSecure());
        $params['_current'] = true;
        $params['_use_rewrite'] = true;
        $params['_m_escape'] = '';
        $params['_query'] = array($filter->getRequestVar() => '__0__');
        return Mage::helper('ewall_filters')->markLayeredNavigationUrl(Mage::getUrl('*/*/*', $params), '*/*/*', $params);
    }
    public function getPopupDimensions($items, $maxRowCount, $maxColumnCount) {
        $count = count($items);
        $columnCount = ceil($count / $maxRowCount);
        if ($columnCount > $maxColumnCount) {
            $columnCount = $maxColumnCount;
        }
        $rowCount = ceil($count / $columnCount);
        return array($rowCount, $columnCount);
    }
    public function getMaxRowCount() {
        return Mage::getStoreConfig('ewall_filters/show_more_popup/max_rows');
    }
    public function getMaxColumnCount() {
        return Mage::getStoreConfig('ewall_filters/show_more_popup/max_columns');
    }
    public function getMethod($block, $filter) {
        $method = $filter->getFilterOptions()->getShowMoreMethod();
        /*if ($showInFilter = $block->getShowInFilter()) {
            if ($node = Mage::getSingleton('ewall_filterpositioning/source_position')->getNode($showInFilter)) {
                $field = $method ? "show_more_{$method}_as" : "show_more_as";
                if (isset($node->$field)) {
                    $method = (string)$node->$field;
                }
            }
        }*/
        return $method;
    }
    public function isMethodDisabled($block, $filter) {
        $method = $this->getMethod($block, $filter);
        if ($showInFilter = $block->getShowInFilter()) {
            if ($node = Mage::getSingleton('ewall_filterpositioning/source_position')->getCurrentNode($showInFilter)) {
                $field = $method ? "show_more_{$method}_disabled" : "show_more_disabled";
                if (!empty($node->$field)) {
                    return true;
                }
            }
        }
        return false;
    }
}