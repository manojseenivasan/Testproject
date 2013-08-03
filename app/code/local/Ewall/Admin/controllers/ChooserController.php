<?php
/**
 * @category    Ewall
 * @package     Ewall_Admin
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
/**
 * @author Ewall Team
 *
 */
class Ewall_Admin_ChooserController extends Mage_Adminhtml_Controller_Action {
    public function productAction() {
        $this->getResponse()->setBody(Mage::helper('ewall_admin')->getProductChooserHtml());
    }
    public function cmsBlockAction() {
        $this->getResponse()->setBody(Mage::helper('ewall_admin')->getCmsBlockChooserHtml());
    }
}