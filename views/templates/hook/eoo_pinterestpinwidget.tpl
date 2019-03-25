{*
/**
* NOTICE OF LICENSE
*
* This file is licenced under the Software License Agreement.
* With the purchase or the installation of the software in your application
* you accept the licence agreement.
*
* You must not modify, adapt or create derivative works of this source code
*
*  @author    André Matthies
*  @copyright 2018-present André Matthies
*  @license   LICENSE
*/
*}

{if $EOO_PINTEREST_PIN_WIDGET}
    <div id='eoo-pinterest-pin-widget'>
        <a data-pin-do='embedPin'
           {if $EOO_PINTEREST_PIN_WIDGET_HIDE_DESC|escape:'htmlall':'utf-8'}data-pin-terse='true'{/if}
           data-pin-lang='{$EOO_PINTEREST_PIN_WIDGET_LANGUAGE|escape:'htmlall':'utf-8'}'
           data-pin-width='{$EOO_PINTEREST_PIN_WIDGET_SIZE|escape:'htmlall':'utf-8'}'
           href='{$EOO_PINTEREST_PIN_WIDGET_URL|escape:'htmlall':'utf-8'}'
        ></a>
    </div>
{/if}