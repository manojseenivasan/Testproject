<?php
/**
 * @category    Ewall
 * @package     Ewall_Filters
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
/* BASED ON SNIPPET: Resources/Install/upgrade script */
/* @var $installer Ewall_Filters_Resource_Setup */
$installer = $this;

$installer->startSetup();

$installer->installEntities();

$installer->createEntityTables($this->getTable('ewall_filters/filter'));
/* BASED ON SNIPPET: Resources/Table creation/alteration script */
$table = 'ewall_filters/filter';
$installer->run("
	ALTER TABLE `{$this->getTable($table)}` DROP FOREIGN KEY `FK_{$this->getTable($table)}_store`;
	ALTER TABLE `{$this->getTable($table)}` DROP COLUMN `store_id`;
	ALTER TABLE `{$this->getTable($table)}` DROP COLUMN `increment_id`;
	
	ALTER TABLE `{$this->getTable($table)}` ADD COLUMN ( 
		`code` varchar(255) NOT NULL default ''
	);
	ALTER TABLE `{$this->getTable($table)}` ADD KEY `code` (`code`);
");

$installer->updateDefaultMaskFields(Ewall_Filters_Model_Filter::ENTITY);

$installer->endSetup();