<?php
/**
 * @category    Ewall
 * @package     Ewall_FilterShowMore
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://www.ewalldev.com/license  Proprietary License
 */
/**
 * @author Ewall Team
 *
 */
class Ewall_FilterShowMore_PopupController extends Mage_Core_Controller_Front_Action {
    public function viewAction() {
        $request = $this->getRequest();
        $layout = $this->getLayout();
        $id = $request->getParam('m-show-more-popup');
        $filterOptions = Mage::getModel('ewall_filters/filter2_store');
        $filterOptions->load($id);
        $displayOptions = $filterOptions->getDisplayOptions();

        $core = Mage::helper(strtolower('Ewall_Core'));
        $filterHelper = Mage::helper(strtolower('Ewall_Filters'));

        switch (Mage::registry('m_original_route_path')) {
            case 'catalogsearch/result/index':
                $viewBlock = $layout->addBlock('ewall_filters/search', 'layer');
                $viewBlock->setMode('search');
                $filterHelper->setMode('search');
                break;
            case 'catalog/category/view':
            case 'cms/index/index':
            case 'cms/page/view':
                $category = Mage::getModel('catalog/category')->load($request->getParam('m-show-more-cat'));
                if ($category->getId()) {
                        Mage::helper('ewall_filters')->getLayer()->setCurrentCategory($category);
                }
                $viewBlock = $layout->addBlock('ewall_filters/view', 'layer');
                $viewBlock->setMode('category');
                $filterHelper->setMode('category');
            break;
            default:
                throw new Exception('Not implemented');
        }

        Mage::dispatchEvent(
            'controller_action_layout_generate_blocks_after',
            array('action' => $this, 'layout' => $this->getLayout())
        );

        $block = $viewBlock->getChild($filterOptions->getCode() . '_filter');
        $template = $block->getTemplate();
        $block->setTemplate(str_replace('.phtml', '_popup.phtml', $template));
        Mage::register('m_showing_filter_popup', true);

        $this->getResponse()->setBody($block->toHtml());
    }
}
