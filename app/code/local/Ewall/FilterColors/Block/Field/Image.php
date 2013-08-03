<?php
/**
 * @category    Ewall
 * @package     Ewall_FilterColors
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://www.ewalldev.com/license  Proprietary License
 */

/**
 * Renders one fieldset field including label, field itself and 'use default checkbox'
 * @author Ewall Team
 *
 */
class Ewall_FilterColors_Block_Field_Image extends Ewall_Admin_Block_Field_Image {
    protected function _construct()
    {
        $this->setTemplate('ewall/admin/field/image.phtml');
    }
    protected function _getStyle() {
        /* @var $files Ewall_Core_Helper_Files */ $files = Mage::helper(strtolower('Ewall_Core/Files'));
        if ($image = $this->getElement()->getValue()) {
            $image = 'background: url('.$files->getUrl($image, array('temp/image', 'image')).'); ';
        }
        $width = $this->getElement()->getImageWidth();
        $height = $this->getElement()->getImageHeight();
        $radius = $this->getElement()->getImageBorderRadius();
        return
            "{$image}width: {$width}px; height: {$height}px; ".
            "-webkit-border-radius: {$radius}px; -moz-border-radius: {$radius}px; border-radius: {$radius}px;";
    }
}