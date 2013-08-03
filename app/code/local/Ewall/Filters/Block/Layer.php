<?php
/** 
 * @category    Ewall
 * @package     Ewall_Filters
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
/**
 * @author Ewall Team
 *
 */
class Ewall_Filters_Block_Layer extends Mage_Core_Block_Template {
    public function setCategoryId($id)
    {
        $category = Mage::getModel('catalog/category')->load($id);
        if ($category->getId()) {
            Mage::getSingleton('catalog/layer')->setCurrentCategory($category);
        }
    }
}