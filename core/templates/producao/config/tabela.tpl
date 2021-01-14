
{foreach from=$crud->css_files item=file}
      <link type="text/css" rel="stylesheet" href="{$file}" />
{/foreach}

{foreach from=$crud->js_files item=file}
      {if (!strpos($file, "jquery.ckeditor.config.js"))}

            <script src="{$file}"></script>
      {/if}
{/foreach} 

<style>#content{
            color:#222222;
      }
      table.dataTable tr.odd {
            background-color: #EFEFEF;
      }
      table.dataTable tr.odd td.sorting_1 {
            background-color: #CDCDCD;
      }



      table.dataTable tr.even td.sorting_1 {
            background-color: #EFEFEF;
      }
</style>



<div class="pagina">
      <h2>{$tabela|capitalize}</h2>
{$crud->output}

</div>






