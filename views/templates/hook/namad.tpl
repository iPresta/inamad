{if $page_name == 'index'}
    {if (Configuration::get('PSI_ENAMAD_POSITION') == 'right' || Configuration::get('PSI_ENAMAD_POSITION') == 'left')}
        {$block = true}
    {else}
        {$block = false}
    {/if}
    <div id="inamad" {if $block}class="block" {else} style="width:{Configuration::get('PSI_ENAMAD_W')}px; height:{Configuration::get('PSI_ENAMAD_H')}px"{/if}>
        {if $block}<p class="title_block">{Configuration::get('PSI_ENAMAD_TEXT')}</p>{/if}
	<iframe width="{Configuration::get('PSI_ENAMAD_W')}" scrolling="no" height="{Configuration::get('PSI_ENAMAD_H')}" frameborder="0" style="margin: 0;
        	padding: 0; border: 1px" src="{$base_uri}eNamadLogo.htm">
    	</iframe>	
    </div>
{/if}
