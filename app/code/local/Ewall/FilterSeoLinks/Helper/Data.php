<?php
/**
 * @category    Ewall
 * @package     Ewall_FilterSeoLinks
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://www.ewalldev.com/license  Proprietary License
 */
/* BASED ON SNIPPET: New Module/Helper/Data.php */
/**
 * Generic helper functions for Ewall_FilterSeoLinks module. This class is a must for any module even if empty.
 * @author Ewall Team
 */
class Ewall_FilterSeoLinks_Helper_Data extends Mage_Core_Helper_Abstract {
	protected $_urlVars;
	protected $_rewriteVars;
	public function getUrlVars() {
		if (!$this->_urlVars) {
			$this->_urlVars = array(
				'p' => 'p',
				'order' => 'order',
				'dir' => 'dir',
				'mode' => 'mode',
				'limit' => 'limit',
				//'___from_store' => 'from-store',
				//'___store' => 'store',
			);
		}
		return $this->_urlVars;
	}
	public function getRewriteVars() {
		if (!$this->_rewriteVars) {
			$this->_rewriteVars = array(
				'p' => 'p',
				'order' => 'order',
				'dir' => 'dir',
				'mode' => 'mode',
				'limit' => 'limit',
				//'from-store' => '___from_store',
				//'store' => '___store',
			);
		}
		return $this->_rewriteVars;
	}
	protected $_categoryName;
    public function getCategoryName() {
        if (!$this->_categoryName) {
            $categoryFilter = Mage::helper('ewall_core')->collectionFind(
                Mage::helper('ewall_filters')->getFilterOptionsCollection(true),
                'code', 'category');
            $this->_categoryName = Mage::getStoreConfigFlag('ewall_filters/seo/use_label')
                ? Mage::helper('ewall_core')->labelToUrl($categoryFilter->getLowerCaseName())
                : 'category';
        }
        return $this->_categoryName;
    }

    public function getCategoryUrlSuffix() {
        /* @var $helper Mage_Catalog_Helper_Category */
        $helper = Mage::helper('catalog/category');
        $result = $helper->getCategoryUrlSuffix();
        if ($result && strpos($result, '.') !== 0) {
            $result = '.'.$result;
        }
        return $result;
    }
}