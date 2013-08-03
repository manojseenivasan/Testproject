<?php
/**
 * @category    Ewall
 * @package     Ewall_Admin
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Enter description here ...
 * @author Ewall Team
 *
 */
class Ewall_Admin_Block_Helper_Wysiwyg extends Mage_Adminhtml_Block_Template {
    protected function _prepareLayout() {
        /* @var $js Ewall_Core_Helper_Js */ $js = Mage::helper(strtolower('Ewall_Core/Js'));
        /* @var $admin Ewall_Admin_Helper_Data */ $admin = Mage::helper(strtolower('Ewall_Admin'));
        $js->options('#ewall-wysiwyg-editor', array(
            'url' => $this->getUrl('*/catalog_product/wysiwyg'),
            'storeId' => $admin->getStore()->getId(),
        ));
        return parent::_prepareLayout();
    }


}