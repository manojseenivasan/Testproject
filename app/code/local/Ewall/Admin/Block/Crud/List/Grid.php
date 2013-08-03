<?php
/**
 * @category    Ewall
 * @package     Ewall_Admin
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Enter description here ...
 * @author Ewall Team
 *
 */
class Ewall_Admin_Block_Crud_List_Grid extends Ewall_Admin_Block_Crud_Grid {
    public function __construct() {
        parent::__construct();
        $this->setSaveParametersInSession(true);
    }
    public function getGridUrl() {
        return Mage::helper('ewall_admin')->getStoreUrl('*/*/grid');
    }

    public function getRowUrl($row) {
	    return Mage::helper('ewall_admin')->getStoreUrl('*/*/edit', array(
	    	'id' => Mage::helper('ewall_admin')->isGlobal() ? $row->getId() : $row->getGlobalId(),
	    ));
    }
}