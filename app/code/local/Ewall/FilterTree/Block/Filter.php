<?php
/**
 * @category    Ewall
 * @package     Ewall_FilterTree
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://www.ewalldev.com/license  Proprietary License
 */
/**
 * @author Ewall Team
 *
 */
class Ewall_FilterTree_Block_Filter extends Ewall_Filters_Block_Filter {

    protected function _prepareFilterBlock() {
        $this->_createChildBlocksRecursively($this, $this->getItems());
        return $this;
    }

    /**
     * @param Mage_Core_Block_Template $parent
     * @param $items
     */
    protected function _createChildBlocksRecursively($parent, $items) {
        foreach ($items as $key => /* @var $item Ewall_Filters_Model_Item */ $item) {
            $block = $this->getLayout()->createBlock('ewall_filtertree/item', $parent->getNameInLayout().'_'.$key, array(
                'item' => $item,
                'filter' => $this,
                'template' => 'ewall/filtertree/item.phtml',
                'show_in_filter' => $this->getShowInFilter(),
            ));
            $parent->setChild($parent->getNameInLayout() . '_' . $key, $block);
            $this->_createChildBlocksRecursively($block, $item->getItems());
        }
    }
    public function getHtml() {
        $state = Mage::getSingleton('core/session')->getMTreeState();
        Mage::helper('ewall_core/js')->options('#m-tree', array_merge(array(
            'url' => $this->getUrl('ewall_filtertree/state/save'),
            'collapsedByDefault' => !Mage::getStoreConfigFlag('ewall_filters/tree/expand'),
        ), !$state ? array() : array(
            'state' => $state
        )));
        return parent::getHtml();
    }
}