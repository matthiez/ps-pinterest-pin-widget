{*
 * NOTICE OF LICENSE
 *
 * This file is licenced under the Software License Agreement.
 * With the purchase or the installation of the software in your application
 * you accept the licence agreement.
 *
 * You must not modify, adapt or create derivative works of this source code
 *
 *  @author    Shopmods
 *  @copyright 2016 Shopmods
 *  @license   license.txt
*}
{if $shmoPntrstPnWdgt.SHMO_PINTEREST_PIN_WIDGET}
<div id="pinterest-pin-widget">
	<a
	data-pin-do="embedPin"
	data-pin-lang="{$shmoPntrstPnWdgt.SHMO_PINTEREST_PIN_WIDGET_LANGUAGE|data:'html':'UTF-8'}"
	data-pin-width="{$shmoPntrstPnWdgt.SHMO_PINTEREST_PIN_WIDGET_SIZE|data:'html':'UTF-8'}"
	{if $shmoPntrstPnWdgt.SHMO_PINTEREST_PIN_WIDGET_HIDE_DESC}data-pin-terse="true"{/if}
	href="{$shmoPntrstPnWdgt.SHMO_PINTEREST_PIN_WIDGET_URL|data:'html':'UTF-8'}"
	>
	</a>
</div>
{/if}