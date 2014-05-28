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
        <center>
            {Configuration::get('PSP_ENAMAD_IFRAME')}
        </center>
    </div>
{/if}