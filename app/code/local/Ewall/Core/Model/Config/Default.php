<?php
/**
 * @category    Ewall
 * @package     Ewall_Core
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Default value provider which gets value from global configuration
 * @author Ewall Team
 *
 */
class Ewall_Core_Model_Config_Default {
	public function getDefaultValue($model, $attributeCode, $path) {
		return Mage::getStoreConfig($path);
	}
	public function getUseDefaultLabel() {
		return Mage::helper('ewall_core')->__('Use System Configuration');
	}
}