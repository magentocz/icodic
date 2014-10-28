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
 * Sales order arddress model
 * 
 * @category Magentocz 
 * @package Magentocz_Icodic
 * 
 */
class Magentocz_Icodic_Model_Sales_Order_Address extends Mage_Sales_Model_Order_Address
{
	/**
	 * Tranaslates ico and dic title.
	 * @param unknown_type $type
	 */
    public function format($type)
    {
        if(!($formatType = $this->getConfig()->getFormatByCode($type))
            || !$formatType->getRenderer()) {
            return null;
        }
    	
        //Magentocz modification
        $result = $formatType->getRenderer()->render($this);
        
        $storeId = null;
        if(Mage::registry('current_order') != null)
       		$storeId = Mage::registry('current_order')->getStoreId();
        if($storeId == null)
        	$storeId = Mage::app()->getStore()->getId(); 
        
        if($storeId != null)
        {
        	
        	$pattern = "___ICO___";
        	if(strpos($result,$pattern) !== false)
        	{
        		$translation = $this->getAttributeTranslationsByStore('ico','customer_address',$storeId);
        		if($translation == '')
        			$translation = Mage::helper('magentocz_icodic')->__('IČ');
        		$result = str_replace($pattern,$translation,$result);
        		//$result = preg_replace($pattern,$translation,$result);
        	}
        	$pattern = "___DIC___";
        	if(strpos($result,$pattern) !== false)
        	{
        		$translation = $this->getAttributeTranslationsByStore('dic','customer_address',$storeId);
        		if($translation == '')
        			$translation = Mage::helper('magentocz_icodic')->__('DIČ');
        		$result = str_replace($pattern,$translation,$result);
        	}   
        }            
       	return $result;
       	//Magentocz modification - end            
    } 
    
	private function getAttributeTranslationsByStore($attributeCode,$type,$storeId)
    {
    	$attribute = $attribute = Mage::getModel('eav/entity_attribute')
            ->loadByCode(Mage::getModel('eav/entity')->setType($type)->getTypeId(), $attributeCode);
    	$translations = Mage::getModel('core/translate_string')
           //->load(Mage_Catalog_Model_Entity_Attribute::MODULE_NAME.Mage_Core_Model_Translate::SCOPE_SEPARATOR.$frontendLabel)
           ->load($attribute->getFrontend()->getLabel())
           ->getStoreTranslations();
        if(!isset($translations))
           return '';
		return isset($translations[$storeId]) ? $translations[$storeId] : '';
    }
}