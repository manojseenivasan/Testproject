<?php
/**
 * @category    Ewall
 * @package     Ewall_Db
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Enter description here ...
 * @author Ewall Team
 *
 * ARRAY METHODS
 * 
 * @method array getColumns()
 * @method string getColumn()
 * @method Ewall_Db_Model_Virtual_Result unsColumns()
 * @method Ewall_Db_Model_Virtual_Result unsColumn()
 * @method Ewall_Db_Model_Virtual_Result addColumn()
 * @method Ewall_Db_Model_Virtual_Result setColumns()
 * 
 */
class Ewall_Db_Model_Virtual_Result extends Ewall_Core_Model_Object {
	protected $_arrays = array(
		'columns' => array(),
	);
}