<?php
/**
 * @category    Ewall
 * @package     Ewall_FilterSeoLinks
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://www.ewalldev.com/license  Proprietary License
 */

/**
 * Rewrite of Mage_Core_Model_Store which makes store links SEO firendly
 * @author Ewall Team
 *
 */
class Ewall_FilterSeoLinks_Model_Store extends Mage_Core_Model_Store {
	public function getCurrentUrl($fromStore = true) {
		return Mage::getSingleton('core/url')->setEscape(true)->encodeUrl('*/*/*', parent::getCurrentUrl($fromStore));
	}
}