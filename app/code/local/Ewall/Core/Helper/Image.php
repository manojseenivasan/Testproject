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
class Ewall_Core_Helper_Image extends Mage_Catalog_Helper_Image {
    protected function setImageFile($file) {
        $this->_getModel()->setBaseFile($file);
        return parent::setImageFile($file);
    }
}