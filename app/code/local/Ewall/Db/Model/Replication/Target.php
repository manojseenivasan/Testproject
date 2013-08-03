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
 * PROPERTY METHODS
 * 
 * @method string getEntityName()
 * @method bool hasEntityName(()
 * @method Ewall_Db_Model_Replication_Target unsEntityName(()
 * @method Ewall_Db_Model_Replication_Target setEntityName(()
 * 
 * @method bool getIsKeyFilterApplied()
 * @method bool hasIsKeyFilterApplied(()
 * @method Ewall_Db_Model_Replication_Target unsIsKeyFilterApplied(()
 * @method Ewall_Db_Model_Replication_Target setIsKeyFilterApplied(()
 * 
 * @method bool getReplicable()
 * @method bool hasReplicable()
 * @method Ewall_Db_Replication_Target unsReplicable()
 * @method Ewall_Db_Replication_Target setReplicable()
 * 
 * COLLECTION METHODS
 * 
 * @method array getSourceEntityNames()
 * @method string getSourceEntityName()
 * @method bool hasSourceEntityName()
 * @method Ewall_Db_Model_Replication_Target setSourceEntityName()
 * @method Ewall_Db_Model_Replication_Target setSourceEntityNames()
 * @method Ewall_Db_Model_Replication_Target unsSourceEntityName()
 * 
 * @method array getSavedKeys()
 * @method string getSavedKey()
 * @method bool hasSavedKey()
 * @method Ewall_Db_Model_Replication_Target setSavedKey()
 * @method Ewall_Db_Model_Replication_Target setSavedKeys()
 * @method Ewall_Db_Model_Replication_Target unsSavedKey()
 * 
 * @method array getDeletedKeys()
 * @method string getDeletedKey()
 * @method bool hasDeletedKey()
 * @method Ewall_Db_Model_Replication_Target setDeletedKey()
 * @method Ewall_Db_Model_Replication_Target setDeletedKeys()
 * @method Ewall_Db_Model_Replication_Target unsDeletedKey()
 * 
 * @method array getSelects()
 * @method Varien_Db_Select getSelect()
 * @method bool hasSelect()
 * @method Ewall_Db_Model_Replication_Target setSelect()
 * @method Ewall_Db_Model_Replication_Target setSelects()
 * @method Ewall_Db_Model_Replication_Target unsSelect()
 * 
 * 
 */
class Ewall_Db_Model_Replication_Target extends Ewall_Core_Model_Object {
	protected $_collections = array(
		'source_entity_names' => array(),
		'saved_keys' => array(),
		'deleted_keys' => array(),
		'selects' => array(),
	);
}