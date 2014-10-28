# Test Checklist

## 1. Oveřit přítomnost atributu
 
 - magentocz_ico
 - magentocz_dic

## 2. Oveřit zařazení atributů do formulářů

 - adminhtml_customer_address
 -- Customer > Manage Customers > Add new customer > Addresses > Add new address
 --- políčko IČO je přítomné
 --- políčko DIČ je přítomné
 - customer_address_edit
 -- Customer > Manage Customers > Edit customer > Addresses > Edit adresy
 --- políčko IČO je přítomné
 --- políčko DIČ je přítomné
 -- Customer > Manage Customers > Edit customer > Addresses > Add new address
 --- políčko IČO je přítomné
 --- políčko DIČ je přítomné
 - customer_register_address

## 3. Upravit frontend šablony

### frontend/rwd/default/template/persistent/checkout/onepage/billing.phtml

### rwd/default/template/customer/address/edit.phtml

## 4. Vypis adres

System > Configuration > Customer Configuration > Address Templates

### Text sekce

Retezec 

  {{depend vat_id}}VAT: {{var vat_id}}{{/depend}}

nahradit

  {{depend magentocz_ico}}<br />IČO: {{var magentocz_ico}}{{/depend}}
  {{if magentocz_dic}}DIČ: {{var magentocz_dic}}{{else}}{{depend vat_id}}VAT: {{var vat_id}}{{/depend}}{{/if}}

### Text One Line

Pokud chcete vypsat ICO a nebo DIC pak lze retezec obohatit o casti

  {{depend magentocz_ico}}IČO: {{var magentocz_ico}}{{/depend}}, {{depend magentocz_dic}}DIČ: {{var magentocz_ico}}{{/depend}}


### HTML sekce

Retezec
  
  {{depend vat_id}}<br/>VAT: {{var vat_id}}{{/depend}}

nahradit

  {{depend magentocz_ico}}<br />IČO: {{var magentocz_ico}}{{/depend}}
  {{if magentocz_dic}}<br />DIČ: {{var magentocz_dic}}{{else}}{{depend vat_id}}<br/>VAT: {{var vat_id}}{{/depend}}{{/if}}

### PDF sekce

Retezec
  
  {{depend vat_id}}<br/>VAT: {{var vat_id}}{{/depend}}|

nahradit

  {{depend magentocz_ico}}<br />IČO: {{var magentocz_ico}}{{/depend}}|
  {{if magentocz_dic}}<br />DIČ: {{var magentocz_dic}}{{else}}{{depend vat_id}}<br/>VAT: {{var vat_id}}{{/depend}}{{/if}}|

### JavaScript Template

Retezec

  <br/>VAT: #{vat_id}

nahradit

  {{depend magentocz_ico}}<br />IČO: {{var magentocz_ico}}{{/depend}}
  {{if magentocz_dic}}<br />DIČ: {{var magentocz_dic}}{{else}}{{depend vat_id}}<br/>VAT: {{var vat_id}}{{/depend}}{{/if}}
