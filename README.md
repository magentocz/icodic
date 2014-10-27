Magento modul IcoDic
====================

Magento modul řešící IČO and DIČ.

Pro správnou fakturaci, která je nezbytnou součástí internetového obchodování, je třeba do adresy zákazníka zanést IČ a DIČ. Základní instalace Magento s těmito údaji nepočítá.

Modul IČ a DIČ:

 - přidává možnost vyplnění IČ a DIČ v adrese zákazníka umožňuje korektní fakturace
 - řeší zanesení IČ a DIČ pro OnePage Checkout
 - řeší zanesení IČ a DIČ pro OneStep Checkout

## Nastavení a použití modulu

Po instalaci se v v backeend modul projeví tak, že profil zákazníka v _Zákazníci → Správa zákazníků → → Adresy → Přidat novou adresu/Upravit zákaznické adresy_ obsahuje navíc položku Ič a Dič.

Pro nastavení ve frontendu je nutná změna šablon. Položky Ič a Dič se potom objeví v profilu zákazníka a tektéž budou zobrazeny při zadávání adresy při procesu dokončení objednávky - jsou tedy dostupné i v příapadě povolení nákupu pro nepřihlášené zákazníky.

## Nastavení pouze pro Magento 1.4.2 a vyšší

Pro správné zobrazování IČ a DIČ ve frontendu je dále potřeba upravit šablony v _System -> Configuration -> Customer Configuration -> Address Templates_. 

Pro jednotlivé šablony je třeba přidat následující řetězce:

*Text*

    {{depend ico}}___ICO___: {{var ico}}{{/depend}}
    {{depend dic}}___DIC___: {{var dic}}{{/depend}}

*Text One Line*

    {{depend ico}}{{var ico}} {{/depend}},
    {{depend dic}}{{var dic}} {{/depend}}

*HTML*

    {{depend ico}}<br />___ICO___: {{var ico}}{{/depend}}
    {{depend dic}}<br />___DIC___: {{var dic}}{{/depend}}

*PDF*

    {{depend ico}}___ICO___: {{var ico}}|{{/depend}}
    {{depend dic}}___DIC___: {{var dic}}|{{/depend}}

*JavaScript Template*
  
    #{ico}<br/>#{dic}<br/>

## LICENSE

    Open Software License (OSL 3.0) 
