$(function () {

  doT.templateSettings = {
    evaluate: /\<\%([\s\S]+?)\%\>/g,
    interpolate: /\<\%=([\s\S]+?)\%\>/g,
    encode: /\<\%!([\s\S]+?)\%\>/g,
    use: /\<\%#([\s\S]+?)\%\>/g,
    define: /\<\%##\s*([\w\.$]+)\s*(\:|=)([\s\S]+?)#\%\>/g,
    conditional: /\<\%\?(\?)?\s*([\s\S]*?)\s*\%\>/g,
    iterate: /\<\%~\s*(?:\%\>|([\s\S]+?)\s*\:\s*([\w$]+)\s*(?:\:\s*([\w$]+))?\s*\%\>)/g,
    varname: 'it',
    strip: true,
    append: true,
    selfcontained: false
  };

  fixarTopo($('#topo'), 50);

  $('.carousel-sobre-inicio').on('translate.owl.carousel', function (e) {
    var currentIndex = e.relatedTarget.relative(e.relatedTarget.current());
    $(`.sobre-inicio [data-index]`).hide(0);
    $(`.sobre-inicio [data-index="${currentIndex}"]`).fadeIn(100);
  });

  var planoHeaderHeight = 0;
  $.each($('.plano .plano-header'), function () {
    var height = $(this).height();
    if (height > planoHeaderHeight) {
      planoHeaderHeight = height;
    }
  });
  $('.plano .plano-header').height(planoHeaderHeight);

  // window.topoHeight = 0;
  // checkElementResize(document.getElementById('topo'), function (e) {
  //
  //   // elementIsAnimating($('#topo'), function () {
  //   //   if (e[0].contentRect.height !== window.topoHeight) {
  //   //
  //   //     window.topoHeight = e[0].contentRect.height;
  //   //
  //   //     if(e[0].contentRect.height > window.topoHeight){
  //   //       calculateTopoHeight();
  //   //     }
  //   //
  //   //   }
  //   // }, true);
  //
  // });

  autoModalWithTpl('servico-modal', 'servico-modal-content', function (e) {

    var $related = $(e.relatedTarget),
      servicoId = $related.data('id'),
      servico = window.servicos.find(function (servico) {
        return servico.Id_int == servicoId;
      });

    return {
      titulo: servico.Nome_tit,
      titulo_alt: $('<div>' + servico.Nome_tit + '</div>').text(),
      descricao: servico.Texto_txa,
      imagem: window.utils.painel + servico.Imagens[0].Caminho_txf
    };

  });

});

function autoModalWithTpl(modalId, tplId, callback) {

  // var $body = $('body');
  // var $modalBase = $('<div id="' + modalId + '" class="modal fade"><div class="modal-dialog" style="max-width: 1230px; width: 100%;"></div></div>');
  //
  // $body.append($modalBase);
  // $modalBase = $('#' + modalId);
  //
  // $modalBase.on('show.bs.modal', function (e) {
  //
  //   var $tpl = $('#' + tplId);
  //   var data = callback(e);
  //
  //   var output = Mustache.render($tpl.html(), data);
  //
  //   $($modalBase).find('.modal-dialog').html(output);
  //
  // });

}

function mustacheTpl(data, tplId) {
  var tpl = doT.template($('#' + tplId).html());
  return tpl({...data, _appUtils: window.utils});
}

function autoModal($modal, dataArray) {

  var
    originalModal = $modal.html(),
    defaultOptions = {
      modal: null,
      data: {},
      fields: {
        titulo: 'Nome_tit',
        texto: 'Descricao_txa'
      },
      callback: function () {

      }
    },
    modals = {};

  if (Array.isArray(dataArray)) {
    $.each(dataArray, function (i, item) {
      if (item.modal) {
        modals[item.modal] = $.extend({}, defaultOptions, item);
      }
    });
  }

  $modal.on('show.bs.modal', function (e) {

    $modal.html(originalModal);

    var $this = $modal,
      $target = $(e.relatedTarget),
      id = $target.data('id'),
      modal = $target.data('modal'),
      data;

    if (modals[modal]) {
      data = modals[modal].data.filter(function (s) {
        return s.Id_int == id;
      })[0];
      if (data) {
        $this.find('#titulo').html(data[modals[modal].fields.titulo] || data.Nome_tit);
        $this.find('#texto').html(data[modals[modal].fields.texto] || data.Descricao_txa);
      }
      if (typeof modals[modal].callback === 'function') {
        modals[modal].callback($this, $target, id, data);
      }
    }

  });

}

function fixarTopo($topo, distance, callback = null) {

  $(window).on('scroll', function (e) {

    if ($(this).width() > 992) {

      var topDistance = $(this).scrollTop(),
        callbackObj = {
          top: topDistance,
          distance: distance,
          type: 'solto'
        };

      if (topDistance > distance) {
        $topo.addClass('fixo');
        $topo.removeClass('solto');
        callbackObj.type = 'fixo';
      } else {
        $topo.removeClass('fixo');
        $topo.addClass('solto');
      }

      if (typeof callback === "function") {
        callback(callbackObj);
      }

    }
  }).trigger('scroll');

}

function paginacaoAjax($container, endpoint, paginacaoOptions, ajaxOptions) {

  var paginacaoOptionsFinal = {
    total: 1,
    page: 1
  };

  var ajaxOptionsFinal = {
    url: window.appUrl + 'super_ajax/' + endpoint,
    data: paginacaoOptionsFinal,
    beforeSend: function () {
      alert('antes');
    },
    success: function (html) {
      $container.html(html);
    }
  };

  $.extend(ajaxOptionsFinal, ajaxOptions);
  $.extend(paginacaoOptionsFinal, paginacaoOptions);

  $.ajax(ajaxOptionsFinal);

}

function checkElementResize(element, callback) {
  new ResizeObserver(callback).observe(element);
}

function elementIsAnimating(element, callback, onlyOneTime = false) {

  var transitioning = element.data('transitioning');
  element.data('transitioning', true);

  console.log(transitioning);

  if (!transitioning) {

    element.one(
      "transitionend MSTransitionEnd webkitTransitionEnd oTransitionEnd",
      function () {
        callback();  // Transition has ended.
        element.data('transitioning', false);
      }
    );

  }

}

function createCSSHelpers() {

  var rootSize = 16;

  var breakpoints = [
    {
      rule: false,
      suffix: '',
    },
    {
      rule: '(min-width: 576px)',
      suffix: 'sm',
    },
    {
      rule: '(min-width: 768px)',
      suffix: 'md',
    },
    {
      rule: '(min-width: 992px)',
      suffix: 'lg',
    },
    {
      rule: '(min-width: 1400px)',
      suffix: 'xl',
    }
  ];
  var directions = [
    {
      suffix: 't',
      dir: 'top'
    },
    {
      suffix: 'r',
      dir: 'right'
    },
    {
      suffix: 'b',
      dir: 'bottom'
    },
    {
      suffix: 'l',
      dir: 'left'
    }
  ];

  function createFonts(breakpoint) {

    var min = 10, max = 120, fzs = '';

    for (var i = min; i <= max; i++) {
      if (i % 2 === 0) {
        var fz = i / rootSize;
        fzs += `.fz-${breakpoint.suffix ? breakpoint.suffix + '-' : ''}${i} { font-size: ${fz}rem !important; } `;
      }
    }

    return fzs;

  }

  function createMarginsAndPaddings(breakpoint) {

    function commom(prefix, property) {
      var step = 5, min = 0, max = 150, partialResult = '';
      directions.forEach((direction) => {
        for (var i = min; i <= max; i += step) {
          var size = i / rootSize;
          partialResult += `.${prefix}${direction.suffix}-${breakpoint.suffix ? breakpoint.suffix + '-' : ''}${i} { ${property}-${direction.dir}: ${size}rem !important; } `;
        }
      });
      return partialResult;
    }

    var result = commom('p', 'padding');
    result += commom('m', 'margin');

    return result;

  }

  function createHelpers() {

    var css = '';

    $.each(breakpoints, function (key, breakpoint) {

      if (breakpoint.rule) {
        css += `@media screen and ${breakpoint.rule} { `;
      }

      css += createMarginsAndPaddings(breakpoint);
      css += createFonts(breakpoint);

      if (breakpoint.rule) {
        css += `}`;
      }

    });

    return css;

  }

  return createHelpers();

}
