{if $page_name == 'index'}
    {if (Configuration::get('PSI_ENAMAD_POSITION') == 'right' || Configuration::get('PSI_ENAMAD_POSITION') == 'left')}
        {$block = true}
    {else}
        {$block = false}
    {/if}
    <div id="pspnamad" {if $block}class="block" {else} style="width:{Configuration::get('PSI_ENAMAD_W')}px; height:{Configuration::get('PSI_ENAMAD_H')}px"{/if}>
            {if $block}<p class="title_block">{Configuration::get('PSI_ENAMAD_TEXT')}</p>{/if}
		<iframe src="/iframe.htm" frameborder="0" scrolling="no" allowtransparency="true" style="width: 150px; height:150px;"></iframe>
    </div>
{/if}
