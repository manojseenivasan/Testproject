<?php
/**
 * @category    Ewall
 * @package     Ewall_Db
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://www.ewalldev.com/license  Proprietary License
 */

/**
 * Entry points for cron and index processes
 * @author Ewall Team
 *
 */
class Ewall_Db_Model_Indexer extends Mage_Index_Model_Indexer_Abstract {
	// INDEXING ITSELF
	
    protected function _construct()
    {
        $this->_init('ewall_db/replicate');
    }
    public function getName()
    {
        return Mage::helper('ewall_db')->__('Default Values');
    }
    public function getDescription()
    {
        return Mage::helper('ewall_db')->__('Propagate default values throughout the system');
    }
    protected function _registerEvent(Mage_Index_Model_Event $event)
    {
    }
    protected function _processEvent(Mage_Index_Model_Event $event)
    {
    }
	public function reindexAll() {
		Mage::helper('ewall_db')->replicate();
	}
    
    public function runCronjob()
    {
        $this->reindexAll();
    }
}