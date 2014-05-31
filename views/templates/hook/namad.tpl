{*  *}
{if $page_name == 'index'}
    {if (Configuration::get('PSP_ENAMAD_POSITION') == 'right' || Configuration::get('PSP_ENAMAD_POSITION') == 'left')}
        {$block = true}
    {else}
        {$block = false}
    {/if}
    <script type="text/javascript">
        var pspnamadwidth = '{Configuration::get('PSP_ENAMAD_W')}';
        var pspnamadheight = '{Configuration::get('PSP_ENAMAD_H')}';
    </script>
    <div id="pspnamad" {if $block}class="block"{/if}>
            {if $block}<p class="title_block">{Configuration::get('PSP_ENAMAD_TEXT')}</p>{/if}
			{Configuration::get('PSP_ENAMAD_IFRAME')}
    </div>
{/if}