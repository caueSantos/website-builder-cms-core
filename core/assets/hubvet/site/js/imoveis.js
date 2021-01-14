$(function () {

  $(window).on('scroll', function (e) {
    var $sticky = $('#coluna-filtro-fora');
    var $stickyFilter = $sticky.find('.filtros-inner');
    if(!$sticky.length) return false;
    $stickyFilter.outerWidth($sticky.outerWidth());
    if ($(this).scrollTop() + 115 >= $sticky.offset().top) {

      if ((($(this).scrollTop() - 200) + $(this).height()) <= $('#paginacao-imoveis').offset().top) {
        $stickyFilter
          .removeClass('upper down')
          .addClass('fixed between')
      } else {
        $stickyFilter
          .removeClass('fixed upper between')
          .addClass('down');
      }

    } else {
      $stickyFilter.show(0);
      $stickyFilter
        .removeClass('fixed between down')
        .addClass('upper');
    }
  }).trigger('scroll');

  acionadorFiltro();

  var debounceFiltro = _.debounce(function (e) {
    $('#imoveis-filtros-form').trigger('submit');
    rolagem('contador-imoveis', 105);
  }, 500);

  $('#imoveis-filtros-form *')
    .on('field-change', function () {
      if ($(window).width() > 992) {
        debounceFiltro();
      }
    });

  $('input:not([type=radio]), input:not([type=checkbox])')
    .on('input', function () {
      $(this).trigger('field-change');
    });

  $('select, input[type=radio], input[type=checkbox]')
    .on('change', function () {
      $(this).trigger('field-change');
    });

  $('#imoveis-filtros-form').on('submit', function (event) {

    event.preventDefault();

    $("#retorno").html('');

    desabilita();

    var values = buscaFiltros($(this));

    buscaImoveisAjax(values);

  }).trigger('submit');

});

function buscaFiltros($form) {

  var values = clearObject(objectifyForm($form.serializeArray()));

  var rangePrice;
  if (values['filtro[Valor_min_txf]']) {
    rangePrice = values['filtro[Valor_min_txf]'];
  }

  if (values['filtro[Valor_max_txf]']) {
    rangePrice += '-' + values['filtro[Valor_max_txf]'];
  }

  if (typeof rangePrice !== 'undefined') {
    rangePrice = 'range:' + rangePrice;
    delete values['filtro[Valor_max_txf]'];
    delete values['filtro[Valor_min_txf]'];
  }

  values['filtro[Valor_txf]'] = rangePrice;

  return values;

}

function buscaImoveisAjax(values, current_page = 1) {

  $("#imoveis-lista-ajax").html('');
  $('#imoveis-placeholder').fadeIn(200);
  $('#imovel-nao-encontrado').addClass('d-none');

  $.ajax({
    url: window.appUrl + "post/buscar_imoveis?curr_page=" + current_page,
    type: "post",
    data: values,
    dataType: 'json',
    success: function (data) {
      setTimeout(function () {
        $('#imoveis-placeholder').fadeOut(200, function () {

          var listaImoveis = '';
          if (data.items) {
            console.log(data.items);
            data.items.forEach(function (imovel) {
              listaImoveis += mustacheTpl(imovel, 'imovel-item-content');
            });
          }
          $("#imoveis-lista-ajax").html(listaImoveis);

        });
      }, 500);

      if (parseInt(data.items_total) > 0) {
        $('#contador-imoveis')
          .html(`Foram encontrados <strong >${data.items_total} ${parseInt(data.items_total) > 1 ? 'imóveis' : 'imóvel'}</strong> para a sua busca!`);
      } else {
        $('#contador-imoveis').html('');
        $('#imovel-nao-encontrado').removeClass('d-none');
      }

      criarPaginacao($('#paginacao-imoveis'), data.curr_page, data.pages_total, appUrl + 'post/buscar_imoveis');
      habilita();
    },
    error: function () {
      $("#retorno").html('Erro ao enviar.');
      habilita();
    }
  });

}

function limparFiltroRadio(name) {
  var $parent = $('[name="' + name + '"]').parents('.btn-group');
  $(':radio', $parent).prop('checked', false).trigger('change');
  $parent.find('.active').removeClass('active');
}

function limparFiltrosImoveis() {

  var $form = $('#imoveis-filtros-form');

  $form[0].reset();

  $.each($(':radio', $form), function () {
    if ($(this).parents('.btn-group').length) {
      $(this).parents('.btn-group').find('.active').removeClass('active');
      $(this).prop('checked', false).trigger('change');
    }
  });

}

function criarPaginacao($container, pagina_atual, paginas, endpoint) {

  var $listaTpl = $('<ul class="pagination"/>'),
    item = '<li class="page-item"/>',
    link = '<a/>';

  var pgRange = paginacaoRange(3, parseInt(paginas), parseInt(pagina_atual));

  for (let i = pgRange.de; i <= pgRange.ate; i++) {

    var $item = $(item),
      $link = $(link);

    if (i == pagina_atual) {

      $item.addClass('active pe-none').text(i);

    } else {

      $link.attr({
        'href': `${endpoint}?curr_page=${i}`
      }).text(i);

      $link.on('click', function (e) {
        e.preventDefault();
        paginacaoIrParaPagina(i);
      });

      $item.append($link);

    }

    $listaTpl.append($item);

  }

  if (pgRange.anterior) {
    var $itemAnt = $(item),
      $linkAnt = $(link);
    $linkAnt.attr({
      'href': `${endpoint}?curr_page=${parseInt(pagina_atual) - 1}`
    }).text('Anterior');
    $itemAnt.append($linkAnt);
    $listaTpl.prepend($itemAnt);
  }

  if (pgRange.proximo) {
    var $itemProx = $(item),
      $linkProx = $(link);
    $linkProx.attr({
      'href': `${endpoint}?curr_page=${parseInt(pagina_atual) + 1}`
    }).text('Próximo');
    $itemProx.append($linkProx);
    $listaTpl.append($itemProx);
  }

  $container.html($listaTpl);

}

function paginacaoIrParaPagina(numeroPagina) {
  buscaImoveisAjax(buscaFiltros($('#imoveis-filtros-form')), numeroPagina)
}

function paginacaoRange(mostrarQtd, totalItens, itemAtual) {

  var divideQtd = Math.ceil(mostrarQtd / 2);
  var antes = itemAtual - divideQtd + 1;
  var depois = itemAtual + divideQtd;

  if (itemAtual === totalItens) {
    antes = totalItens - mostrarQtd + 1;
    depois = totalItens;
  }

  if (depois > totalItens) {
    antes = itemAtual - (mostrarQtd - (totalItens - itemAtual + 1));
    depois = totalItens;
  }

  if (antes <= 0) {
    antes = 1;
    depois = mostrarQtd;
  }

  if (mostrarQtd > totalItens) {
    antes = 1;
    depois = totalItens;
  }

  return {
    de: antes,
    ate: depois,
    proximo: depois < totalItens,
    anterior: antes > 1
  }

}

function acionadorFiltro() {
  $('#acionador-filtro, #botao-aplicar-filtros, #fechar-filtro').on('click', function () {
    $('#acionador-filtro').toggleClass('open');
    $('#imoveis .filtros').toggleClass('open');
  })
}
