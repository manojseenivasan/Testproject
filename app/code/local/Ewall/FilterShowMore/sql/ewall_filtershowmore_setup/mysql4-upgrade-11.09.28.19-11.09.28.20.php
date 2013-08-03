<?php
/**
 * @category    Ewall
 * @package     Ewall_FilterShowMore
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://www.ewalldev.com/license  Proprietary License
 */
/* BASED ON SNIPPET: Resources/Install/upgrade script */
/* @var $installer Ewall_FilterShowMore_Resource_Setup */
$installer = $this;

$installer->startSetup();

/* BASED ON SNIPPET: Resources/Table creation/alteration script */
$table = 'ewall_filters/filter2';
$installer->run("
	ALTER TABLE `{$this->getTable($table)}` ADD COLUMN ( 
		`show_more_item_count` int NOT NULL default '0'
	);
");

/* BASED ON SNIPPET: Resources/Table creation/alteration script */
$table = 'ewall_filters/filter2_store';
$installer->run("
	ALTER TABLE `{$this->getTable($table)}` ADD COLUMN ( 
		`show_more_item_count` int NOT NULL default '0'
	);
");

$installer->endSetup();

if (!Mage::registry('m_run_db_replication')) {
	Mage::register('m_run_db_replication', true);
}
