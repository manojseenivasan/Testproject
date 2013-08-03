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
 * @method array getErrors()
 * @method string getError()
 * @method Ewall_Db_Model_Validation unsErrors()
 * @method Ewall_Db_Model_Validation unsError()
 * @method Ewall_Db_Model_Validation addError()
 * @method Ewall_Db_Model_Validation setErrors()
 * 
 */
class Ewall_Db_Model_Validation extends Ewall_Core_Model_Object {
	protected $_arrays = array(
		'errors' => array(),
	);
} 