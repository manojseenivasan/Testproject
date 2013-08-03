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
class Ewall_Admin_Block_Column_Checkbox_Massaction extends Ewall_Admin_Block_Column_Checkbox {
    public function renderCss() {
        return parent::renderCss().' ct-massaction';
    }
}