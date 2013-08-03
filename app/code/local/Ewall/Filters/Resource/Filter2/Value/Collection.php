<?php
/**
 * @category    Ewall
 * @package     Ewall_Filters
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
/* BASED ON SNIPPET: Resources/DB operations with model collections */
/**
 * This resource model handles DB operations with a collection of models of type Ewall_Filters_Model_Filter2_Value. All 
 * database specific code for operating collection of Ewall_Filters_Model_Filter2_Value should go here.
 * @author Ewall Team
 */
class Ewall_Filters_Resource_Filter2_Value_Collection extends Ewall_Db_Resource_Object_Collection
{
    /**
     * Invoked during resource collection model creation process, this method associates this 
     * resource collection model with model class and with resource model class
     */
    protected function _construct()
    {
        $this->_init(strtolower('Ewall_Filters/Filter2_Value'));
    }

}
