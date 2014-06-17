{if $page_name == 'index'}
    {if (Configuration::get('PSI_ENAMAD_POSITION') == 'right' || Configuration::get('PSI_ENAMAD_POSITION') == 'left')}
        {$block = true}
    {else}
        {$block = false}
    {/if}
    <div id="pspnamad" {if $block}class="block" {else} style="width:{Configuration::get('PSI_ENAMAD_W')}px; height:{Configuration::get('PSI_ENAMAD_H')}px"{/if}>
        {if $block}<p class="title_block">{Configuration::get('PSI_ENAMAD_TEXT')}</p>{/if}
	<iframe width="125" scrolling="no" height="140" frameborder="0" style="margin: 0;
        	padding: 0; border: 1px" temp_src="http://enamad.ir/trustseal/symbol.aspx" src="http://enamad.ir/trustseal/symbol.aspx">
    	</iframe>	
    </div>
{/if}
