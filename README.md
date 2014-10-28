Magento modul ICO
====================

Magento modul řeší IČ zákazníka.

Pro správnou fakturaci, která je nezbytnou součástí internetového obchodování, je třeba do adresy zákazníka zanést IČ a DIČ. 

Základní instalace Magento má k dispozici pouze 'Tax/VAT number' atribut. Tento modul dodáva překlad na 'DIČ'.

Modul IČ a DIČ:

 - přidává možnost vyplnění IČ a DIČ v adrese zákazníka umožňuje korektní fakturace
 - řeší zanesení IČ a DIČ pro OnePage Checkout

## Nastavení a použití modulu

Po instalaci se v v backeend modul projeví tak, že profil zákazníka v _Zákazníci → Správa zákazníků → → Adresy → Přidat novou adresu/Upravit zákaznické adresy_ obsahuje navíc položku Ič a Dič.

Pro nastavení ve frontendu je nutná změna šablon. Položky IČ a DIČ se objeví v profilu zákazníka a taktéž budou zobrazeny při zadávání adresy při procesu dokončení objednávky - jsou tedy dostupné i v případě povolení nákupu pro nepřihlášené zákazníky.

## Nastavení pouze pro Magento 1.4.2 a vyšší

Pro správné zobrazování IČ a DIČ ve frontendu je dále potřeba upravit šablony v _System -> Configuration -> Customer Configuration -> Address Templates_. 

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

## LICENSE

    Open Software License (OSL 3.0) 
