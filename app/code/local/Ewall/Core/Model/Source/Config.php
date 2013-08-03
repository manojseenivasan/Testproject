<?php
/**
 * @category    Ewall
 * @package     Ewall_Core
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Base class for source classes used to populate SELECT drop downs with values
 * @author Ewall Team
 *
 */
class Ewall_Core_Model_Source_Config extends Ewall_Core_Model_Source_Abstract {
    protected $_rootNode;
    protected $_childNode;
    protected $_defaultTranslationModule;

    protected function _getAllOptions() {
        /* @var $core Ewall_Core_Helper_Data */
        $core = Mage::helper(strtolower('Ewall_Core'));
        $result = array();

        foreach ($core->getSortedXmlChildren(Mage::getConfig()->getNode($this->_rootNode), $this->_childNode) as $key => $options) {
            $module = isset($options['module']) ? ((string)$options['module']) : $this->_defaultTranslationModule;
            $result[] = array('label' => Mage::helper($module)->__((string)$options->title), 'value' => $key);
        }
        return $result;
    }
}