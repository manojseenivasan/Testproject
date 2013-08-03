<?php
/**
 * @category    Ewall
 * @package     Ewall_Filters
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
/**
 * Block type for showing filters in category view pages.
 * @author Ewall Team
 * Injected into layout instead of standard catalog/layer_view in layout XML file.
 * @method string getShowInFilter() returns position of layered navigation if positioning module is installed and null otherwise
 */
class Ewall_Filters_Block_View extends Mage_Catalog_Block_Layer_View {
    protected function _construct()
    {
        parent::_construct();
        Mage::register('current_layer', $this->getLayer(), true);
    }

    /**
     * This method is called during page rendering to generate additional child blocks for this block.
     * @return Ewall_Filters_Block_View
     * This method is overridden by copying (method body was pasted from parent class and modified as needed). All
     * changes are marked with comments.
     * @see app/code/core/Mage/Catalog/Block/Layer/Mage_Catalog_Block_Layer_View::_prepareLayout()
     */
    protected function _prepareLayout()
    {
        /* @var $layoutHelper Ewall_Core_Helper_Layout */
        $layoutHelper = Mage::helper('ewall_core/layout');
        $layoutHelper->delayPrepareLayout($this, 200);

        return $this;
    }

    public function delayedPrepareLayout() {
        /* @var $helper Ewall_Filters_Helper_Data */
        $helper = Mage::helper(strtolower('Ewall_Filters'));

        /* @var $layout Mage_Core_Model_Layout */
        $layout = $this->getLayout();

        /* @var $layer Mage_Catalog_Model_Layer */
        $layer = $this->getLayer();

        /* @var $query Ewall_Filters_Model_Query */
        $query = Mage::getSingleton('ewall_filters/query');
        $query
            ->setLayer($layer)
            ->init();

        $showState = 'all';
        if ($showInFilter = $this->getShowInFilter()) {
            if (($template = Mage::getStoreConfig('ewall_filters/positioning/' . $showInFilter)) && !$this->getTakeTemplateFromXml()) {
                $this->setTemplate($template);
            }
            $showState = Mage::getStoreConfig('ewall_filters/positioning/show_state_' . $showInFilter);
        }
        if ($showState) {
            /* @var $state Ewall_Filters_Block_State */
            $stateBlock = $layout->createBlock('ewall_filters/state', '', array(
                'layer' => $layer,
                'mode' => $showState,
            ));
            $this->setChild('layer_state', $stateBlock);
        }

        foreach ($helper->getFilterOptionsCollection() as $filterOptions) {
            /* @var $filterOptions Ewall_Filters_Model_Filter2_Store */

            if ($helper->canShowFilterInBlock($this, $filterOptions)) {
                $displayOptions = $filterOptions->getDisplayOptions();

                $blockName = $helper->getFilterLayoutName($this, $filterOptions);
                /* @var $block Ewall_Filters_Block_Filter */
                $block = $layout->createBlock((string)$displayOptions->block, $blockName, array(
                    'filter_options' => $filterOptions,
                    'display_options' => $displayOptions,
                    'show_in_filter' => $this->getShowInFilter(),
                    'query' => $query,
                    'layer' => $layer,
                    'attribute_model' => $filterOptions->getAttribute(),
                    'mode' => $this->getMode(),
                ));
                $block->init();
                $this->setChild($filterOptions->getCode() . '_filter', $block);
            }
        }

        $query->apply();
        $layer->apply();

        return $this;
    }

    public function getMode() {
        /* @var $helper Ewall_Filters_Helper_Data */
        $helper = Mage::helper(strtolower('Ewall_Filters'));

        if ($mode = $this->_getData('mode')) {
            return $mode;
        }
        else {
            return $helper->getMode();
        }
    }
    public function getFilters() {
        /* @var $helper Ewall_Filters_Helper_Data */
        $helper = Mage::helper(strtolower('Ewall_Filters'));

        $filters = array();
    	foreach ($helper->getFilterOptionsCollection() as $filterOptions) {
            /* @var $filterOptions Ewall_Filters_Model_Filter2_Store */


            if ($helper->isFilterEnabled($filterOptions)) {
                if ($helper->canShowFilterInBlock($this, $filterOptions)) {
                    $filters[] = $this->getChild($filterOptions->getCode() . '_filter');
                }
    		}
        }
        return $filters;
    }
    public function getClearUrl() {
        /* @var $helper Ewall_Filters_Helper_Data */
        $helper = Mage::helper(strtolower('Ewall_Filters'));

        return $helper->getClearUrl();
    }

    /**
     * @return Mage_Catalog_Model_Layer
     */
    public function getLayer() {
        /* @var $helper Ewall_Filters_Helper_Data */
        $helper = Mage::helper(strtolower('Ewall_Filters'));

        return $helper->getLayer($this->getMode());
    }

    public function canShowBlock() {
        /* @var $helper Ewall_Filters_Helper_Data */
        $helper = Mage::helper(strtolower('Ewall_Filters'));

        switch ($this->getMode()) {
            case 'category':
                return $this->_canShowBlockInCategory();
            case 'search':
                return $this->_canShowBlockInSearch();
            default:
                throw new Exception('Not implemented');
        }
    }
    public function _canShowBlockInCategory() {
        if ($this->canShowOptions()) {
            return true;
        } elseif ($state = $this->getChild('layer_state')) {
            $appliedFilters = $this->getChild('layer_state')->getActiveFilters();
            return !empty($appliedFilters);
        }
        else {
            return false;
        }
    }
    public function _canShowBlockInSearch() {
        $engine = Mage::helper('catalogsearch')->getEngine();
        $_isLNAllowedByEngine = $engine->isLeyeredNavigationAllowed();
        if (!$_isLNAllowedByEngine && method_exists($engine, 'isLayeredNavigationAllowed')) {
            $_isLNAllowedByEngine = $engine->isLayeredNavigationAllowed();
        }
        if (!$_isLNAllowedByEngine) {
            return false;
        }
        $availableResCount = (int) Mage::app()->getStore()
            ->getConfig(Mage_CatalogSearch_Model_Layer::XML_PATH_DISPLAY_LAYER_COUNT);

        if ($availableResCount && $availableResCount<$this->getLayer()->getProductCollection()->getSize()) {
            return false;
        }
        return $this->_canShowBlockInCategory();
    }
}