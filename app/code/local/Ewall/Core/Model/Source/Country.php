<?php
/** 
 * @category    Ewall
 * @package     Ewall_Core
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
/**
 * @author Ewall Team
 *
 */
class Ewall_Core_Model_Source_Country extends Ewall_Core_Model_Source_Abstract {
    protected function _getAllOptions() {
        return Mage::getResourceModel('directory/country_collection')->load()->toOptionArray();
    }
}