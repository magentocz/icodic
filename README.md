Magento modul IČO a DIČ
====================

Magento modul řeší IČ a DIČ zákazníka.

Pro správnou fakturaci, která je nezbytnou součástí internetového obchodování, je třeba do adresy zákazníka zanést IČ a DIČ. Základní instalace Magento má k dispozici pouze 'Tax/VAT number' atribut (ve verzi Magento CE 1.9)

## Seznam funkcí

### Backend > Customers > Manage Customer

 - lze editovat IČO a DIČ na úrovni adresy
 - lze přidat novou adresu s IČO a DIČ

### Backend > Sales > Orders

 - lze vytvořit novou objednávku a ve fakturační adrese lze vyplnit IČO a DIČ
 - v zobrazení existující objednávky je zobrazeno IČO a DIČ pokud byla zadana

### Backend > Tisk PDF faktury

 - IČO a DIČ jsou přítomny ve faktuře

### Frontend > Pokladna > Fakturační adresa

 - IČO a DIČ jsou zobrazeny ve fakturační adrese a lze je editovat
 - IČO a DIČ jsou uloženy či aktualizovány při přechodu na další krok checkoutu
 - IČO a DIČ jsou zobrazeny v progress baru (pravý sloupec)

### Frontend > Objednavkový email 

 - IČO a DIČ je zobrazeno ve fakturační adrese emailu potvrzující objednávku

### Můj Účet > Zobrazení výchozí fakturační a dodací adresy

 - IČO a DIČ je zobrazeno v adrese, pokud je vyplněno

### Můj Účet > Přidání adresy, Editace adresy

 - IČO a DIČ lze nastavit pro každou zákazníkovu adresu


## Nastavení a použití modulu

### Upravit frontend šablony

#### Checkout > Billing Information

V základní instalaci Magenta bude potřeba upravit jednu z šablon:
 - app/desing/frontend/rwd/default/template/persistent/checkout/onepage/billing.phtml
 - app/desing/frontend/rwd/default/template/checkout/onepage/billing.phtml
 - app/desing/frontend/base/default/template/persistent/checkout/onepage/billing.phtml
 - app/desing/frontend/base/default/template/checkout/onepage/billing.phtml

Do šablony je potřeba přidat nová políčka:

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


#### My Account > Address > Change Address

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

### Vypis adres

System > Configuration > Customer Configuration > Address Templates

#### Text sekce

Retezec 

  {{depend vat_id}}VAT: {{var vat_id}}{{/depend}}

nahradit

  {{depend magentocz_ico}}<br />IČO: {{var magentocz_ico}}{{/depend}}
  {{if magentocz_dic}}DIČ: {{var magentocz_dic}}{{else}}{{depend vat_id}}VAT: {{var vat_id}}{{/depend}}{{/if}}

#### Text One Line

Pokud chcete vypsat ICO a nebo DIC pak lze retezec obohatit o casti

  {{depend magentocz_ico}}, IČO: {{var magentocz_ico}}{{/depend}}{{depend magentocz_dic}}, DIČ: {{var magentocz_ico}}{{/depend}}


#### HTML sekce

Retezec
  
  {{depend vat_id}}<br/>VAT: {{var vat_id}}{{/depend}}

nahradit

  {{depend magentocz_ico}}<br />IČO: {{var magentocz_ico}}{{/depend}}
  {{if magentocz_dic}}<br />DIČ: {{var magentocz_dic}}{{else}}{{depend vat_id}}<br/>VAT: {{var vat_id}}{{/depend}}{{/if}}

#### PDF sekce

Retezec
  
  {{depend vat_id}}<br/>VAT: {{var vat_id}}{{/depend}}|

nahradit

  {{depend magentocz_ico}}<br />IČO: {{var magentocz_ico}}{{/depend}}|
  {{if magentocz_dic}}<br />DIČ: {{var magentocz_dic}}{{else}}{{depend vat_id}}<br/>VAT: {{var vat_id}}{{/depend}}{{/if}}|

#### JavaScript Template

Retezec

  <br/>VAT: #{vat_id}

nahradit

  <br />IČO: #{var magentocz_ico}, <br />DIČ: #{var magentocz_dic}

# LICENCE

    Open Software License (OSL 3.0)
