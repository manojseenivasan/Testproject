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
$installer->updateDefaultMaskFields(Ewall_Filters_Model_Filter::ENTITY);

$installer->endSetup();