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
* @copyright Copyright (c) 2014 Magento CZ (http://www.magento.cz)
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

$installer->startSetup();
$installer->installEntities();
$installer->installCustomerForms();

// $installer->run("
// -- Pridani nezbytnych eav_atributu pro funkcnost ico a dic.
// INSERT INTO {$this->getTable('eav_attribute')} (`entity_type_id`, `attribute_code`, `attribute_model`, `backend_model`, `backend_type`, `backend_table`, `frontend_model`, `frontend_input`, `frontend_label`, `frontend_class`, `source_model`,`is_required`,`is_user_defined`, `default_value`,`is_unique`,`note` ) VALUES
// ( 12, 'ico', NULL, '', 'varchar', '', '', '', '', '', '', 0, 0, '', 0, ''),  
// ( 12, 'dic', NULL, '', 'varchar', '', '', '', '', '', '', 0, 0, '', 0, ''),
// ( 6, 'ico', NULL, '', 'varchar', '', '', '', '', '', '', 0, 0, '', 0, ''),
// ( 6, 'dic', NULL, '', 'varchar', '', '', '', '', '', '', 0, 0, '', 0, '');

// -- Zmeny pro funkcnost ico a dic
// ALTER TABLE {$this->getTable('sales_flat_quote_address')}
//     ADD COLUMN `dic` varchar(255) NOT NULL AFTER `company`,
//     ADD COLUMN `ico` varchar(255) NOT NULL AFTER `company`; 
    
// -- Zmeny pro funkcnost ico a dic
// ALTER TABLE {$this->getTable('sales_flat_order_address')}
//     ADD COLUMN `dic` varchar(255) NOT NULL AFTER `company`,
//     ADD COLUMN `ico` varchar(255) NOT NULL AFTER `company`; 
//     ");

$installer->endSetup(); 
