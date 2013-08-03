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
class Ewall_FilterTree_StateController extends Mage_Core_Controller_Front_Action {
    public function saveAction() {
        if ($state = $this->getRequest()->getParam('state')) {
            Mage::getSingleton('core/session')->setMTreeState($state);
        }
    }
}