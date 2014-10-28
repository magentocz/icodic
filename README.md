Magento modul IČO a DIČ
====================

Podpora IČ a DIČ zákazníka pro Magento.

Pro správnou fakturaci, která je nezbytnou součástí internetového obchodování, je třeba do adresy zákazníka zanést IČ a DIČ. Základní instalace Magento má k dispozici pouze 'Tax/VAT number' atribut (ve verzi Magento CE 1.9).

## Seznam funkcí

### Backend > Zákazníci > Správa zákazníků

 - lze editovat IČO a DIČ na úrovni adresy
 - lze přidat novou adresu s IČO a DIČ

### Backend > Prodeje > Objednávky

 - lze vytvořit novou objednávku a ve fakturační adrese lze vyplnit IČO a DIČ
 - v zobrazení existující objednávky je zobrazeno IČO a DIČ pokud byla čísla zadána

### Backend > Tisk PDF faktury

 - IČO a DIČ jsou přítomny ve faktuře

### Frontend > Pokladna > Fakturační adresa

 - IČO a DIČ jsou zobrazeny ve fakturační adrese a lze je editovat
 - IČO a DIČ jsou uloženy či aktualizovány při přechodu na další krok pokladny
 - IČO a DIČ jsou zobrazeny v progress baru (pravý sloupec)

### Frontend > Objednávkový email 

 - IČO a DIČ je zobrazeno ve fakturační adrese emailu potvrzující objednávku

### Frontend > Můj Účet > Zobrazení výchozí fakturační a dodací adresy

 - IČO a DIČ je zobrazeno v adrese, pokud je vyplněno

### Frontend > Můj Účet > Přidání adresy, Editace adresy

 - IČO a DIČ lze nastavit pro každou zákazníkovu adresu


## Nastavení a použití modulu

### Upravit frontend šablony

#### Frontend > Pokladna > Fakturačí adresa

V základní instalaci Magenta bude potřeba upravit jednu z šablon:

 - app/desing/frontend/rwd/default/template/persistent/checkout/onepage/billing.phtml
 - app/desing/frontend/rwd/default/template/checkout/onepage/billing.phtml
 - app/desing/frontend/base/default/template/persistent/checkout/onepage/billing.phtml
 - app/desing/frontend/base/default/template/checkout/onepage/billing.phtml

Do šablony je potřeba přidat nová textová pole:

    <?php // Magento CZ uprava ?>
    <li class="fields">
       <div class="field">
          <label for="billing:magentocz_ico"><?php echo $this->__('IČO') ?></label>
          <div class="input-box">
             <input type="text" id="billing:magentocz_ico" name="billing[magentocz_ico]" value="<?php echo $this->htmlEscape($this->getAddress()->getMagentoczIco()) ?>" title="<?php echo $this->__('IČO') ?>" class="input-text" />
          </div>
       </div>
       <div class="field">
          <label for="billing:magentocz_dic"><?php echo $this->__('DIČ') ?></label>
          <div class="input-box">
          <input type="text" id="billing:magentocz_dic" name="billing[magentocz_dic]" value="<?php echo $this->htmlEscape($this->getAddress()->getMagentoczDic()) ?>" title="<?php echo $this->__('DIČ') ?>" class="input-text" />
          </div>
       </div>
    </li>
    <?php //end - Magento CZ uprava ?>


#### Frontend > Můj Účet > Adresy > Změna adresy, Nová adresa

V základní instalaci Magenta bude potřeba upravit jednu z šablon:

 - app/desing/frontend/rwd/default/template/customer/address/edit.phtml
 - app/desing/frontend/base/default/customer/address/edit.phtml

Do šablony je potřeba přidat nová políčka:

    <?php //Magento CZ uprava ?>
    <li class="fields">
       <div class="field">
           <label for="ico"><?php echo $this->__('IČO') ?></label>
       <div class="input-box">
              <input type="text" name="magentocz_ico" id="ico" title="<?php echo $this->__('IČO') ?>" value="<?php echo $this->htmlEscape($this->getAddress()->getData('magentocz_ico')) ?>" class="input-text" />
       </div>
    </div>
    <div class="field">
           <label for="dic"><?php echo $this->__('DIČ') ?></label>
       <div class="input-box">
              <input type="text" name="magentocz_dic" id="dic" title="<?php echo $this->__('DIČ') ?>" value="<?php echo $this->htmlEscape($this->getAddress()->getData('magentocz_dic')) ?>" class="input-text" />
          </div>
    </div>
    </li>
    <?php //end - Magento CZ uprava ?>

### Nastavení v backendu Magenta

V konfiguraci v sekci _System > Configuration > Customer Configuration > Address Templates_ (_Systém > Nastavení > Nastavení zákazníka > Šablony adres_)

#### Text sekce

Řetězec 

    {{depend vat_id}}VAT: {{var vat_id}}{{/depend}}

nahradit

    {{depend magentocz_ico}}<br />IČO: {{var magentocz_ico}}{{/depend}}
    {{if magentocz_dic}}DIČ: {{var magentocz_dic}}{{else}}{{depend vat_id}}VAT: {{var vat_id}}{{/depend}}{{/if}}

#### Text One Line

Pokud chcete vypsat IČO a nebo DIČ pak lze retezec obohatit o části

    {{depend magentocz_ico}}, IČO: {{var magentocz_ico}}{{/depend}}{{depend magentocz_dic}}, DIČ: {{var magentocz_ico}}{{/depend}}


#### HTML sekce

Řetězec
  
    {{depend vat_id}}<br/>VAT: {{var vat_id}}{{/depend}}

nahradit

    {{depend magentocz_ico}}<br />IČO: {{var magentocz_ico}}{{/depend}}
    {{if magentocz_dic}}<br />DIČ: {{var magentocz_dic}}{{else}}{{depend vat_id}}<br/>VAT: {{var vat_id}}{{/depend}}{{/if}}

#### PDF sekce

Řetězec
  
    {{depend vat_id}}<br/>VAT: {{var vat_id}}{{/depend}}|

nahradit

    {{depend magentocz_ico}}<br />IČO: {{var magentocz_ico}}{{/depend}}|
    {{if magentocz_dic}}<br />DIČ: {{var magentocz_dic}}{{else}}{{depend vat_id}}<br/>VAT: {{var vat_id}}{{/depend}}{{/if}}|

#### JavaScript Template

Řetězec

    <br/>VAT: #{vat_id}

nahradit

    <br />IČO: #{var magentocz_ico}, <br />DIČ: #{var magentocz_dic}

## Testováno na

 - Magento CE 1.9.0.1

Na verzích nižších než 1.9.0.1 nebylo zatím testováno, na 99% bude fungovat ve verzích 1.8, 1.7. bez problémů.

## Podpora

Veškeré dotazy a hlášení chyb směřujte na https://github.com/magentocz/icodic/issues


# LICENCE

    Open Software License (OSL 3.0)

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
