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
class Ewall_Admin_Block_Crud_Detail_Grid extends Ewall_Admin_Block_Crud_Grid {
    public function getRowUrl($row) {
	    return '';
    }
    public function getRowClass($row) {
    	return 'r-'.$row->getId();
    }
}