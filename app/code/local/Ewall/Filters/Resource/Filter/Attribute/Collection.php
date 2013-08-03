<?php
/**
 * @category    Ewall
 * @package     Ewall_Filters
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Attribute definition collection for filters
 * @author Ewall Team
 *
 */
class Ewall_Filters_Resource_Filter_Attribute_Collection extends Ewall_Core_Resource_Attribute_Collection {
	public function __construct($resource=null) {
		$this->setEntityType(Ewall_Filters_Model_Filter::ENTITY);
		parent::__construct($resource);
	}
}