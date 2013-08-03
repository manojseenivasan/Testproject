<?php
/**
 * @category    Ewall
 * @package     Ewall_FilterAjax
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://www.ewalldev.com/license  Proprietary License
 */

/* BASED ON SNIPPET: Models/Observer */
/**
 * This class observes certain (defined in etc/config.xml) events in the whole system and provides public methods - handlers for
 * these events.
 * @author Ewall Team
 *
 */
class Ewall_FilterAjax_Model_Observer {
	/**
	 * REPLACE THIS WITH DESCRIPTION (handles event "m_ajax_options")
	 * @param Varien_Event_Observer $observer
	 */
	public function renderOptions($observer) {
	    $actionName = str_replace('/', '_', Mage::helper('ewall_core')->getRoutePath());
        if ($config = Mage::getConfig()->getNode('ewall_ajax/urls/'.$actionName)) {
            $class = (string)$config->class;
            $method = (string)$config->method;
            $obj = new $class;
            $options = $obj->$method();

            $generalUrlExceptions = array();
            foreach (Mage::app()->getStores() as $store) {
                /* @var $store Mage_Core_Model_Store */
                if ($store->getId() != Mage::app()->getStore()->getId()) {
                    $generalUrlExceptions[$store->getCurrentUrl()] = $store->getCurrentUrl();
                }
            }

            $options = array_merge(array(
                'scroll' => Mage::getStoreConfigFlag('ewall/ajax/scroll_to_top_filter'),
            ), $options);
            $options['urlExceptions'] = isset($options['urlExceptions'])
                ? array_merge($generalUrlExceptions, $options['urlExceptions'])
                : $generalUrlExceptions;
            Mage::helper('ewall_core/js')->options('#m-filter-ajax', $options);
        }
	}

	public function getCategoryOptions() {
	    $exactUrls = array();
	    $partialUrls = array();
	    $urlExceptions = array();

        /* @var $category Mage_Catalog_Model_Category */
        $category = Mage::registry('current_category');
        /* @var $core Ewall_Core_Helper_Data */
        $core = Mage::helper(strtolower('Ewall_Core'));

        Ewall_Core_Profiler::start('mln' . '::' . __CLASS__ . '::' . __METHOD__ . '::' . '$category->getUrl()');
        $url = Mage::helper('ewall_filters')->getClearUrl(false, true); //$category->getUrl();
        if (($pos = mb_strrpos($url, '?')) !== false) {
            $url = mb_substr($url, 0, $pos);
        }
        Ewall_Core_Profiler::stop('mln' . '::' . __CLASS__ . '::' . __METHOD__ . '::' . '$category->getUrl()');
        //if ($core->endsWith($url, '/')) {
        //	$url = substr($url, 0, strlen($url) - 1);
        //}

        $exactUrls[$url] = $url;
        $partialUrls[$url . '?'] = $url . '?';
        if ($categorySuffix = Mage::helper('catalog/category')->getCategoryUrlSuffix()) {
            if (($pos = mb_strrpos($url, $categorySuffix)) !== false) {
                if ($pos + mb_strlen($categorySuffix) < mb_strlen($url)) {
                    $url = mb_substr($url, 0, $pos) . mb_substr($url, $pos + mb_strlen($categorySuffix));
                } else {
                    $url = mb_substr($url, 0, $pos);
                }
            }
            if ($conditionalWord = $core->getStoreConfig('ewall_filters/seo/conditional_word')) {
                $partialUrls[$url . '/' . $conditionalWord] = $url . '/' . $conditionalWord;
            }
        } else {
            if ($conditionalWord = $core->getStoreConfig('ewall_filters/seo/conditional_word')) {
                $partialUrls[$url . '/' . $conditionalWord] = $url . '/' . $conditionalWord;
            }
        }

        Ewall_Core_Profiler::start('mln' . '::' . __CLASS__ . '::' . __METHOD__ . '::' . '$category->getChildrenCategories()');
        $childCategories = $category->getChildrenCategories();
        Ewall_Core_Profiler::stop('mln' . '::' . __CLASS__ . '::' . __METHOD__ . '::' . '$category->getChildrenCategories()');
        foreach ($childCategories as $childCategory) {
            $url = $childCategory->getUrl();
            if (Mage::app()->getFrontController()->getRequest()->isSecure()) {
                $url = str_replace('http://', 'https://', $url);
            }
            if ($core->endsWith($url, '/')) {
                $url = substr($url, 0, strlen($url) - 1);
            }
            if ($categorySuffix = Mage::helper('catalog/category')->getCategoryUrlSuffix()) {
                $url = str_replace($categorySuffix, '', $url);
            }
            $urlExceptions[$url] = $url;
        }

        return compact('exactUrls', 'partialUrls', 'urlExceptions');
    }

    public function getSearchOptions() {
        $exactUrls = array();
        $partialUrls = array();
        $urlExceptions = array();

        /* @var $category Mage_Catalog_Model_Category */
        $category = Mage::registry('current_category');
        /* @var $core Ewall_Core_Helper_Data */
        $core = Mage::helper(strtolower('Ewall_Core'));
        $request = Mage::app()->getRequest();

        $url = Mage::getSingleton('core/url')->sessionUrlVar(Mage::helper('core')->escapeUrl(Mage::getUrl()));
        if ($core->endsWith($url, '/')) {
            $url = substr($url, 0, strlen($url) - 1);
        }
        $url .= $request->getOriginalPathInfo();
        $partialUrls[$url] = $url;

        return compact('exactUrls', 'partialUrls', 'urlExceptions');
    }

    public function getPageOptions() {
        $exactUrls = array();
        $partialUrls = array();
        $urlExceptions = array();

        /* @var $core Ewall_Core_Helper_Data */
        $core = Mage::helper(strtolower('Ewall_Core'));
        $request = Mage::app()->getRequest();

        $url = Mage::helper('cms/page')->getPageUrl($request->getParam('page_id'));
        $exactUrls[$url] = $url;
        $partialUrls[$url . '?'] = $url . '?';
        if ($conditionalWord = $core->getStoreConfig('ewall_filters/seo/conditional_word')) {
            $partialUrls[$url . '/' . $conditionalWord] = $url . '/' . $conditionalWord;
        }

        return compact('exactUrls', 'partialUrls', 'urlExceptions');
    }

    public function getHomeOptions() {

        $exactUrls = array();
        $partialUrls = array();
        $urlExceptions = array();

        /* @var $core Ewall_Core_Helper_Data */
        $core = Mage::helper(strtolower('Ewall_Core'));

        $url = Mage::getUrl();
        $exactUrls[$url] = $url;
        if ($core->endsWith($url, '___SID=U')) {
            $url = substr($url, 0, strlen($url) - strlen('___SID=U'));
        }
        if ($core->endsWith($url, '?')) {
            $url = substr($url, 0, strlen($url) - 1);
        }
        if ($core->endsWith($url, '/')) {
            $url = substr($url, 0, strlen($url) - 1);
        }
        $partialUrls[$url . '?'] = $url . '?';
        if ($conditionalWord = $core->getStoreConfig('ewall_filters/seo/conditional_word')) {
            $partialUrls[$url . '/' . $conditionalWord] = $url . '/' . $conditionalWord;
        }

        return compact('exactUrls', 'partialUrls', 'urlExceptions');
    }

    /* obsolete handlers. Kept here for easier upgrade */
    public function registerUrl($observer) { }
    public function ajaxCategoryView($observer) {}
    public function ajaxSearchResult($observer) {}
    public function markUpdatableHtml($observer) {}
    public function ajaxCmsIndex($observer) {}
    public function ajaxCmsPage($observer) {}
}