<?php
/** 
* Magento CZ Module
* 
* NOTICE OF LICENSE 
* 
* This source file is subject to the Open Software License (OSL 3.0) 
* that is bundled with this package in the file LICENSE.txt. 
* It is also available through the world-wide-web at this URL: 
* http://opensource.org/licenses/osl-3.0.php 
* If you did of the license and are unable to 
* obtain it through the world-wide-web, please send an email 
* to magentocz@gmail.com so we can send you a copy immediately. 
* 
* @copyright Copyright (c) 2014 GetReady s.r.o. (https://getready.cz)
* 
*/ 

/** 
* Sql instalation skript
* 
* @category Magentocz 
* @package Magentocz_Icodic
* 
*/

$installer = $this;
/* @var $installer Magentocz_Icodic_Model_Resource_Eav_Mysql4_Setup */

$installer->startSetup();
$installer->installEntities();
$installer->installCustomerForms();


$installer->run("
ALTER TABLE {$this->getTable('sales_flat_quote_address')}
    ADD COLUMN `magentocz_dic` varchar(255) NOT NULL AFTER `company`,
    ADD COLUMN `magentocz_ico` varchar(255) NOT NULL AFTER `company`; 

ALTER TABLE {$this->getTable('sales_flat_order_address')}
    ADD COLUMN `magentocz_dic` varchar(255) NOT NULL AFTER `company`,
    ADD COLUMN `magentocz_ico` varchar(255) NOT NULL AFTER `company`;
");


$installer->endSetup(); 
