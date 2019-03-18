{if $PINTEREST_PIN_WIDGET}
    <div id='pinterest-pin-widget'>
        <a data-pin-do='embedPin'
           {if $PINTEREST_PIN_WIDGET_HIDE_DESC}data-pin-terse='true'{/if}
           data-pin-lang='{$PINTEREST_PIN_WIDGET_LANGUAGE}'
           data-pin-width='{$PINTEREST_PIN_WIDGET_SIZE}'
           href='{$PINTEREST_PIN_WIDGET_URL}'
        ></a>
    </div>
{/if}