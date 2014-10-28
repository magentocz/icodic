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
 * Moduls setup
 * 
 * @category Magentocz 
 * @package Magentocz_Icodic
 * 
 */

class Magentocz_Icodic_Model_Resource_Eav_Mysql4_Setup extends Mage_Eav_Model_Entity_Setup {
	 
	/**
     * Prepare customer attribute values to save in additional table
     *
     * @param array $attr
     * @return array
     */
    protected function _prepareValues($attr)
    {
        $data = parent::_prepareValues($attr);
        $data = array_merge($data, array(
            'is_visible'                => $this->_getValue($attr, 'visible', 1),
            'is_system'                 => $this->_getValue($attr, 'system', 1),
            'input_filter'              => $this->_getValue($attr, 'input_filter', null),
            'multiline_count'           => $this->_getValue($attr, 'multiline_count', 0),
            'validate_rules'            => $this->_getValue($attr, 'validate_rules', null),
            'data_model'                => $this->_getValue($attr, 'data', null),
            'sort_order'                => $this->_getValue($attr, 'position', 0)
        ));

        return $data;
    }

    /**
     * Add customer attributes to customer forms
     *
     * @return void
     */
    public function installCustomerForms()
    {
        $customer           = (int)$this->getEntityTypeId('customer');
        $customerAddress    = (int)$this->getEntityTypeId('customer_address');

        $attributeIds       = array();
        $select = $this->getConnection()->select()
            ->from(
                array('ea' => $this->getTable('eav/attribute')),
                array('entity_type_id', 'attribute_code', 'attribute_id'))
            ->where('ea.entity_type_id IN(?)', array($customer, $customerAddress));
        foreach ($this->getConnection()->fetchAll($select) as $row) {
            $attributeIds[$row['entity_type_id']][$row['attribute_code']] = $row['attribute_id'];
        }

        $data       = array();
        $entities   = $this->getDefaultEntities();
        
        $attributes = $entities['customer_address']['attributes'];
        foreach ($attributes as $attributeCode => $attribute) {
            $attributeId = $attributeIds[$customerAddress][$attributeCode];
            $attribute['system'] = isset($attribute['system']) ? $attribute['system'] : true;
            $attribute['visible'] = isset($attribute['visible']) ? $attribute['visible'] : true;
            if (false === ($attribute['system'] == true && $attribute['visible'] == false)) {
                $usedInForms = array(
                    'adminhtml_customer_address',
                    'customer_address_edit',
                    'customer_register_address'
                );
                foreach ($usedInForms as $formCode) {
                    $data[] = array(
                        'form_code'     => $formCode,
                        'attribute_id'  => $attributeId
                    );
                }
            }
        }

        if ($data) {
            $this->getConnection()->insertMultiple($this->getTable('customer/form_attribute'), $data);
        }
    }

    /**
     * Retreive default entities: customer, customer_address
     *
     * @return array
     */
    public function getDefaultEntities()
    {
        $entities = array(

            'customer_address'               => array(
                'entity_model'                   => 'customer/address',
                'attribute_model'                => 'customer/attribute',
                'table'                          => 'customer/address_entity',
                'additional_attribute_table'     => 'customer/eav_attribute',
                'entity_attribute_collection'    => 'customer/address_attribute_collection',
                'attributes'                     => array(
                    'magentocz_ico'             => array(
                        'type'               => 'varchar',
                        'label'              => 'IČO',
                        'input'              => 'text',
                        'required'           => false,
                        'sort_order'         => 100,
                        'visible'            => true,
                        'system'             => false,
                        'validate_rules'     => 'a:1:{s:15:"max_text_length";i:255;}',
                        'position'           => 100,
                        'admin_checkout'     => 1,
                    ),
                    'magentocz_dic'             => array(
                        'type'               => 'varchar',
                        'label'              => 'DIČ',
                        'input'              => 'text',
                        'required'           => false,
                        'sort_order'         => 100,
                        'visible'            => true,
                        'system'             => false,
                        'validate_rules'     => 'a:1:{s:15:"max_text_length";i:255;}',
                        'position'           => 100,
                        'admin_checkout'     => 1,
                    ),
                )
            )
        );
        return $entities;
    }
}
