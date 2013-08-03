<?php
/**
 * @category    Ewall
 * @package     Ewall_Ajax
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://www.ewalldev.com/license  Proprietary License
 */
/**
 * Generic helper functions for Ewall_Ajax module. This class is a must for any module even if empty.
 * @author Ewall Team
 */
class Ewall_Ajax_Helper_Data extends Mage_Core_Helper_Abstract {
    public function getAllowedActions($actionName) {
        $actionNodes = Mage::helper('ewall_core')->getSortedXmlChildren(
            Mage::getConfig()->getNode('ewall_ajax/allowed_actions'), $actionName);
        if (count($actionNodes)) {
            $result = array();
            foreach ($actionNodes as $actionNode) {
                $result[] = $actionNode->getName();
            }
            return $result;
        }
        else {
            return false;
        }
    }
    protected $_detected = false;
    protected $_enabled = false;
    public function isEnabled() {
        if (!$this->_detected) {
            switch (Mage::getStoreConfig('ewall/ajax/mode')) {
                case Ewall_Ajax_Model_Mode::OFF:
                    break;
                case Ewall_Ajax_Model_Mode::ON_FOR_ALL:
                    $this->_enabled = true;
                    break;
                case Ewall_Ajax_Model_Mode::ON_FOR_USERS:
                    $this->_enabled = true;
                    foreach (explode(';', Mage::getStoreConfig('ewall/ajax/bots')) as $agent) {
                        if (isset($_SERVER['HTTP_USER_AGENT']) && strpos($_SERVER['HTTP_USER_AGENT'], trim($agent)) !== false) {
                            $this->_enabled = false;
                            break;
                        }
                    }
                    break;
                default:
                    throw new Exception('Not implemented');
            }
            $this->_detected = true;
        }
        return $this->_enabled;
    }
}