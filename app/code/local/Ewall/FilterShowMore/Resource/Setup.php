<?php
/**
 * @category    Ewall
 * @package     Ewall_FilterShowMore
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://www.ewalldev.com/license  Proprietary License
 */

/**
 * Adds columns to filter options
 * @author Ewall Team
 *
 */
class Ewall_FilterShowMore_Resource_Setup extends Ewall_Core_Resource_Eav_Setup {
	public function getEntityExtensions() {
		return array('ewall_filter' => array(
			'attributes' => array(
				'show_more_item_count' => array(
					// storage
                    'type'              => 'int',
                    'default'           => '',
					'is_global'			=> Ewall_Core_Model_Attribute_Scope::_STORE, 
					
					// editing
					'label'             => 'Item Limit',
					'note'				=> "In case filter has more than specified number of items, only first items are displayed, as well as 'Show More' and 'Show Less' actions.",
					'input'				=> 'text', 
					'required'          => true,
		
					// default chain
					'has_default'		=> true,
					'default_model'		=> 'ewall_core/config_default',
					'default_source'	=> 'ewall_filters/display/show_more_item_count',
					'default_mask'		=> 0x0000000000000008,
				),
			), 
		));
	}
}