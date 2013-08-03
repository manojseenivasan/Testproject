<?php
/**
 * @category    Ewall
 * @package     Ewall_FilterAdmin
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://www.ewalldev.com/license  Proprietary License
 */

/**
 * Enter description here ...
 * @author Ewall Team
 *
 */
class Ewall_FilterAdmin_Block_List_Container extends Ewall_Admin_Block_Crud_List_Container {
    public function __construct() {
        parent::__construct();
        $this->_headerText = $this->__('Layered Navigation Filters');
    }
}