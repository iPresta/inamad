{*  *}
{if $page_name == 'index'}
    {if (Configuration::get('PSP_ENAMAD_POSITION') == 'right' || Configuration::get('PSP_ENAMAD_POSITION') == 'left')}
        {$block = true}
    {else}
        {$block = false}
    {/if}
    <div id="pspnamad" {if $block}class="block"{/if} style="width:{Configuration::get('PSP_ENAMAD_W')}px; height:{Configuration::get('PSP_ENAMAD_H')}px">
            {if $block}<p class="title_block">{Configuration::get('PSP_ENAMAD_TEXT')}</p>{/if}
			{Configuration::get('PSP_ENAMAD_IFRAME')}
    </div>
{/if}