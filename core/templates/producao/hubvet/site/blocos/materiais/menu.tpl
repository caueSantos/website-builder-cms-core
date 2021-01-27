<aside class="menu-lateral">

  <div class="pb-15">
    <div class="fz-14 text-body-secondary mb-5 pl-md-15">
      {trans('materiais_para')}
    </div>
    <select class="d-block custom-select cursor-pointer text-center">
      <option value="todos">
        {trans('todos')}
      </option>
      {foreach from=$labels item=label}
      <option value="{$label->Nome_url}">
        {$label->Nome_tit}
      </option>
      {/foreach}
    </select>
  </div>

  <hr/>

  <ul class="menu lh-2 pt-10">

    <li class="mb-10 pl-md-15">
      <a
        href="{gera_link('materiais', true)}"
        class="text-body-primary text-primary-hover menu-item"
      >
        {trans('todos')}
      </a>
    </li>

    {foreach from=$materiais_categorias item=cat}
    <li class="mb-10 pl-md-15">
      <a
        data-id="{$cat->Nome_url}"
        href="{gera_link('materiais/#/'|cat:{$cat->Nome_url}, true)}"
        class="text-body-primary text-primary-hover menu-item"
      >
        {$cat->Nome_tit}
      </a>
    </li>
    {/foreach}

  </ul>

</aside>
