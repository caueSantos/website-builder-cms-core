$(function () {

  landsTabs();

  $.each($('.dropdown.dropdown-select'), function (item) {
    var $selected = $(this).find('a.active');
    if (!$selected) {
      $selected = $(this).find('a:first');
      $selected.addClass('active');
    }
    $(this).find('.dropdown-toggle .dropdown-selected').html($selected.html());
    $(this).find('.dropdown-value').val($selected.data('value'));
  });

  $(".dropdown.dropdown-select .dropdown-menu a").click(function () {
    var $parent = $(this).parents('.dropdown');
    $parent.find('.dropdown-toggle .dropdown-selected').html($(this).html());
    $('.active', $parent).removeClass('active');
    $(this).addClass('active');
    $parent.find('.dropdown-value').val($(this).data('value'));
    $parent.trigger('change');
  });

  $('#filtro-ordenacao').on('change', function () {
    $('#imoveis .filtros [name="filtro\[Order_by]"\]')
      .val($(this).find('.dropdown-value').val());
    $('#imoveis-filtros-form').trigger('submit');
  });

  $.each($('[data-autoload="estados"]'), function () {
    listaEstadosBrasil($(this));
  });

  $.each($('[data-autoload="cidades"]'), function () {

    var $this = $(this),
      depends = $this.data('autoload-depends'),
      $dependsElement = $(depends);

    $this.html('<option selected disabled hidden value="">' + $this.data('placeholder') + '</option>');

    if (typeof depends !== 'undefined') {

      $dependsElement.on('change', function () {

        var $selected = $(this).find("option:selected");

        $this.prop('disabled', true);

        listaCidadesEstadoBrasil($this, $selected.data('id'));

      });

    }

  });

  $.each($('.select-lands select'), function () {
    $(this).select2({
      minimumResultsForSearch: 20,
    });
  });

  $(window).on('resize', function () {

    setTimeout(function () {
      $.each($('.align-center'), function (i, v) {
        if (!$(this).parents('.tab-pane:not(.active)').length) {
          var $parent = $(this).parent();
          $parent.outerHeight($parent.outerHeight());
        }
      });

      calculateTopoHeight();

    }, 200);

  }).trigger('resize');

  $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    setTimeout(function () {
      $.each($('.align-center'), function (i, v) {
        if (!$(this).parents('.tab-pane:not(.active)').length) {
          var $parent = $(this).parent();
          $parent.outerHeight($parent.outerHeight());
        }
      });

      calculateTopoHeight();

    }, 100);
  });

  formNewsletter();

  //PLUGIN WHATS
  if (window.whatsappPlugin) {
    var whats = window.whatsappPlugin;
    $.landsWhatsApp({
      header: whats.Cabecalho_txf,
      number: whats.Numero_txf,
      message: whats.Texto_balao_txf,
      autoOpen: whats.Abrir_inicio_sel === 'SIM',
      autoOpenDelay: whats.Abir_delay_txf,
      right: false
    });
  }

  $.each($('[data-read-more]'), function () {
    var lineHeight = $(this).height() / getRows($(this));
    $(this).readmore({
      collapsedHeight: ($(this).data('read-more') || 6) * lineHeight,
      moreLink: '<a class="mt-5 d-block fz-13" href="#">Ver mais</a>',
      lessLink: '<a class="mt-5 d-block fz-13" href="#">Fechar</a>'
    });
  });

  function getRows(selector) {
    var height = $(selector).height();
    var line_height = $(selector).css('line-height');
    line_height = parseFloat(line_height) || 1;
    var rows = height / line_height;
    return Math.round(rows);
  }

  aplicarMascaras();

  $(window).on('resize', function (e) {

    const $carousel = $('.owl-responsive.owl-carousel');
    $.each($carousel, function () {
      gridToCarousel($(this), {}, 991);
    });

  }).trigger('resize');

  // $(".rolagem[data-target], .rolagem[data-target]").on('click', function (e) {
  //
  //   e.preventDefault();
  //
  //   var $this = $(this),
  //     $parent = $('#topo, #rodape'),
  //     id = $this.data('target').replace('#', ''),
  //     href = $this.attr('href'),
  //     margin = $this.data('rolagem-margin');
  //
  //   if ($parent.length) {
  //     $parent.find('.rolagem.active').removeClass('active');
  //     $parent.find('a[href="' + href + '"]').addClass('active');
  //   }
  //
  //   if (typeof margin !== 'number') {
  //     margin = 150;
  //   }
  //
  //   rolagem(id, margin);
  //   window.location.hash = id;
  //
  // });

  // var hash = window.location.hash;
  // var $places = $('#topo, #rodape');
  // $places.find('.nav-link.active').removeClass('active');
  // $places.find('a[href="' + window.appUrl + hash + '"]').addClass('active');

});

function gridToCarousel($el, breakpoint) {

  if (!$el || !$el.length) return false;

  const $window = $(window), windowWidth = $window.width(),
    windowHeight = $window.height();

  //add responsive class
  $el.addClass('owl-responsive');

  var defaultOptions = {
    items: 2,
    slideBy: 2,
    nav: false,
    autoplay: true,
    autoplayTimeout: 3000,
    loop: true,
    dots: true
  };

  var availOwlOptions = ["forceRun", "navText", "items", "margin", "loop", "center", "mouseDrag", "touchDrag", "pullDrag", "freeDrag", "stagePadding", "merge", "mergeFit", "autoWidth", "startPosition", "URLhashListener", "nav", "rewind", "navElement", "slideBy", "dots", "dotsEach", "dotData", "lazyLoad", "lazyContent", "autoplay", "autoplayTimeout", "autoplayHoverPause", "smartSpeed", "fluidSpeed", "autoplaySpeed", "navSpeed", "dotsSpeed", "dragEndSpeed", "callbacks", "responsiveRefreshRate", "video", "videoHeight", "videoWidth", "animateOut", "animateInClass", "fallbackEasing", "nestedItemSelector", "itemElement", "stageElement", "navContainer", "dotsContainer", "dotClass", "equalize"];
  var data = $el.data();
  var finalOptions = {};

  $.each(data, function (k, v) {

    var realOptionName = k.replace('owl', '');
    realOptionName = camelize(realOptionName);

    if (availOwlOptions.indexOf(realOptionName) >= 0) {
      finalOptions[realOptionName] = v;
    }

  });

  var rwdOptions = {};
  if (data && data.rwd != null) {
    var itemsArr = data.rwd.split('-');
    rwdOptions = {
      responsive: {
        0: {
          items: itemsArr[0],
          mouseDrag: true,
          touchDrag: true
        },

        768: {
          items: itemsArr[1],
          mouseDrag: true,
          touchDrag: true
        },

        1024: {
          items: itemsArr[2],
          mouseDrag: true,
          touchDrag: true
        },

        1200: {
          items: itemsArr[3],
          mouseDrag: true,
          touchDrag: true
        }
      }
    };
  }

  //define as opcoes do carrosel
  options = $.extend(true, {}, rwdOptions, defaultOptions, finalOptions);

  //define o breakpoint
  breakpoint = typeof breakpoint !== 'number' ? 991 : breakpoint;

  //carrega e destrói o carrossel
  if (windowWidth > breakpoint) {
    $el.owlCarousel('destroy');
  } else {
    $el.owlCarousel(options);
  }

}

$(document).ready(function () {

  //ANIMAÇÂO NOS DROPDOWNS
  $(".dropdown:not('.no-animate')").on("mousedown", function (e) {
    if (e.which === 1 && $(window).width() > 992) {
      e.currentTarget.click();
      var $href = $(this).find('.nav-link').attr('href');
      window.open($href, '_self');
    }
  });

  //FANCYBOX

  if ($.fancybox) {

    $.fancybox.defaults.hash = false;

    $(".fancybox:not(.disable-fancybox-trigger)").fancybox({
      helpers: {
        title: {
          type: 'float',
          position: 'top'
        }
      },
      nextEffect: 'fade',
      prevEffect: 'fade'
    });

  }

  $('.galeria-mista [data-fancybox]')
    .on('click', function (e) {

      e.preventDefault();
      e.stopPropagation();

    });

  $('.galeria-mista .abre-galeria').on('click', function () {

    var links = $('.galeria-mista [data-fancybox]');

    $.fancybox.open(links, {
      helpers: {
        title: {
          type: 'float',
          position: 'top'
        }
      },
      nextEffect: 'fade',
      prevEffect: 'fade',
      thumbs: {
        autoStart: false
      }
    }, links.index(this));

    return false;

  });


  $('.galeria-mista .troca-destaque').on('click', function () {

    var $this = $(this);
    var $destaque = $('#destaque-principal');
    var $clone_destaque = $destaque.clone();

    $('#destaque-load-overlay').fadeIn(100, function () {

      $destaque.attr('href', $this.attr('href'));
      $destaque.find('img').attr('src', $this.find('img').attr('src'));

      $this.attr('href', $clone_destaque.attr('href'));
      $this.find('img').attr('src', $clone_destaque.find('img').attr('src'));

      setTimeout(function () {
        $('#destaque-load-overlay').fadeOut(100);
      }, 500)

    })

  });

  //ENVIO CONTATO
  $(".form-contato").submit(function (event) {
    event.preventDefault();

    $("#retorno").html('');
    desabilita();

    var values = $(this).serialize();
    $.ajax({
      url: window.appUrl + "post/enviar_contato",
      type: "post",
      data: values,
      success: function (data) {
        $("#retorno").html(data);
        habilita();
      },
      error: function () {
        $("#retorno").html('Erro ao enviar.');
        habilita();
      }
    });
  });

  $(".form-matricula").submit(function (event) {

    event.preventDefault();
    desabilita();

    var values = objectifyForm($(this).serializeArray());
    var $jsonFields = {};

    $.each($('[data-json=true]', this), function (i, v) {
      var $this = $(this);
      $jsonFields[$this.attr('placeholder') || $this.attr('name')] = $this.val();
    });

    values.Campos_extras_jso = JSON.stringify($jsonFields);

    $.ajax({
      url: window.appUrl + "post/lead",
      type: "post",
      data: values,
      success: function (data) {
        $("#retorno").html(data);
        habilita();
      },
      error: function () {
        $("#retorno").html('Erro ao enviar.');
        habilita();
      }
    });

  });

});

function desabilita($form = null) {

  var $btns = $('#bt-enviar', '.btn-enviar');

  if ($form != null) {
    $btns = $btns.add($form.find('[type=submit]'));
  }

  $.each($btns, function () {

    var _this = $(this);

    if (_this.val().length) {
      _this.data('message-value', _this.val())
        .val("Enviando mensagem...");
    } else {
      _this.data('message-text', _this.text())
        .html("Enviando mensagem...")
    }

  });

  $btns.prop('disabled', true);

}

function habilita($form = null) {

  var $btns = $('#bt-enviar', '.btn-enviar');

  if ($form != null) {
    $btns = $btns.add($form.find('[type=submit]'));
  }

  $.each($btns, function () {

    var _this = $(this);

    if (_this.data('message-value')) {
      _this.val(_this.data('message-value'));
    } else if (_this.data('message-text')) {
      _this.text(_this.data('message-text'));
    } else {
      if (_this.val().length) {
        _this.val('Enviar mensagem')
      } else {
        _this.text('Enviar mensagem')
      }
    }

  });

  $btns.prop('disabled', false);

}

function rolagem($id, $margem, velocidade = 1000) {

  if (!$('#' + $id).length) return;

  if (!$margem) {
    $margem = '50';
  }
  var distancia = $('#' + $id).offset().top;
  $('html, body').stop().animate({
    scrollTop: distancia - $margem
  }, velocidade);
}

function changeUrl(page, url) {

  if (typeof (history.pushState) != "undefined") {

    var obj = {
      Page: page,
      Url: url
    };

    history.pushState(obj, obj.Page, obj.Url);

  } else {
    alert("Browser does not support HTML5.");
  }

}

function super_ajax($container, $loader, pagina, data = {}) {

  $container.hide(0);
  $loader.fadeIn(150);

  $.ajax({
    url: window.appUrl + "super_ajax/" + pagina,
    type: "get",
    data: data,
    success: function (data) {
      $container.html(data);
      $container.fadeIn(150);
    },
    error: function () {
      $container.html('<div class="super-ajax-error">Erro ao abrir página</div>');
    },
    complete: function () {
      $loader.hide(0);
    }
  });

}

function carrega_pagina(pagina) {

  changeUrl(window.appUrl, window.appUrl + pagina);

  $.ajax({
    url: window.appUrl + "super_ajax/" + pagina,
    type: "get",
    success: function (data) {
      $("#principal").html(data);
    },
    error: function () {
      $("#principal").html("Erro ao abrir página");
    }
  });
}

function listaEstadosBrasil($selectEstados) {

  $.getJSON('https://servicodados.ibge.gov.br/api/v1/localidades/estados/', function (json) {

    json = json.sort((a, b) => a.nome.localeCompare(b.nome, 0, {numeric: false}));

    var options = '<option selected disabled hidden value="">' + $selectEstados.data('placeholder') + '</option>';
    for (var i = 0; i < json.length; i++) {
      options += '<option data-sigla="' + json[i].sigla + '" data-id="' + json[i].id + '" value="' + json[i].nome + '" >' + json[i].nome + '</option>';
    }

    $selectEstados.html(options);

  });

}

function listaCidadesEstadoBrasil($selectCidade, IdEstado) {

  $selectCidade.html('<option selected disabled hidden value="">Carregando...</option>');

  $.getJSON('https://servicodados.ibge.gov.br/api/v1/localidades/estados/' +
    IdEstado + '/municipios', function (json) {

    var options = '<option selected disabled hidden value="">' + $selectCidade.data('placeholder') + '</option>';
    for (var i = 0; i < json.length; i++) {
      options += '<option value="' + json[i].nome + '" >' + json[i].nome + '</option>';
    }

    $selectCidade.html(options);
    $selectCidade.prop('disabled', false);

  });

}

function carregaCidade($selectEstados, $inputCidades) {

  var $cidadesFormGroup = $inputCidades.parents('.form-lands-group');

  function toggleCidade($status) {
    if ($status === 'show') {
      $cidadesFormGroup.show();
      $inputCidades.show();
    } else {
      $cidadesFormGroup.hide();
      $inputCidades.hide();
    }

  }

  toggleCidade('hide');

  $.getJSON('https://servicodados.ibge.gov.br/api/v1/localidades/estados/', function (json) {

    json = json.sort((a, b) => a.nome.localeCompare(b.nome, 0, {numeric: false}))

    console.log(json);

    var options = '<option value="">-- Selecione o seu estado --</option>';
    for (var i = 0; i < json.length; i++) {
      options += '<option data-id="' + json[i].id + '" value="' + json[i].nome + '" >' + json[i].nome + '</option>';
    }
    $selectEstados.html(options);
  });

  $selectEstados.change(function () {

    $inputCidades.prop('disabled', true);

    var $this = $(this),
      $selected = $this.find("option:selected");

    if ($this.val()) {

      $.getJSON('https://servicodados.ibge.gov.br/api/v1/localidades/estados/' +
        $selected.attr('data-id') + '/municipios', function (json) {
        var options = '<option value="">–- Selecione o seu município -–</option>';
        for (var i = 0; i < json.length; i++) {
          options += '<option value="' + json[i].nome + '" >' + json[i].nome + '</option>';
        }
        $inputCidades.html(options);
        toggleCidade('show');
        $inputCidades.prop('disabled', false);
      });

    } else {
      $inputCidades.html('<option value="">–- Selecione o seu município -–</option>');
      toggleCidade('hide');
    }

  });

}

/**
 * @brief Converte uma string em formato moeda para float
 * @param valor(string) - o valor em moeda
 * @return valor(float) - o valor em float
 */
function converteMoedaFloat(valor) {

  valor = valor + '';

  if (valor === "") {
    valor = 0;
  } else {
    valor = valor.replace(".", "");
    valor = valor.replace(",", ".");
    valor = parseFloat(valor);
  }
  return valor;

}

function clearObject(obj) {
  Object.keys(obj).forEach(function (key) {
    if (obj[key] && typeof obj[key] === 'object') clearObject(obj[key]);
    else if (obj[key] == null || obj[key] === '') delete obj[key];
  });
  return obj;
}

function calculateTopoHeight() {
  $topo = $('#topo');
  if ($topo.css("position") === 'fixed') {

    $('body').css('padding-top', `${$topo.outerHeight()}px`);

    var styleCode = `:root { --topo-height: ${$topo.outerHeight()}px; }`;
    styleFromJs('utils-js-style', styleCode);
  }
}

function formNewsletter() {
  $(".form-newsletter").submit(function (event) {

    var $this = $(this), $retorno = $('#retorno');

    event.preventDefault();

    $retorno.html('');

    $.ajax({
      url: window.appUrl + 'post/informativo',
      type: 'post',
      data: $this.serialize(),
      beforeSend: function () {
        desabilita($this);
      },
      success: function (data) {
        $retorno.html(data);
        habilita($this);
      },
      error: function () {
        swal('Falha ao enviar =(', 'Tente novamente mais tarde', 'error');
      }
    });

  });
}

function aplicarMascaras() {

  //MASCARAS
  $(".cep-mask").mask("00000-000");
  $(".data-mask").mask("00/00/0000");
  $(".cnpj-mask").mask("00.000.000/0000-00", {reverse: true});
  $(".cpf-mask").mask("000.000.000-00", {reverse: true});
  $(".money-mask").mask("#.##0,00", {reverse: true});
  $(".float-2-mask").mask("#0.00", {reverse: true});
  $('.placa-mask').mask('SSS-00A0');


  var SPMaskBehavior = function (val) {
    return val.replace(/\D/g, '').length === 11
      ? '(00) 00000-0000' : '(00) 0000-00009';
  };
  $('.phone-mask').mask(SPMaskBehavior, {
    onKeyPress: function (val, e, field, options) {
      field.mask(SPMaskBehavior.apply({}, arguments), options);
    },
    reverse: false
  });

  $('.cpf-cnpj-mask').mask('000.000.000-000', {
    onKeyPress: function (cpfcnpj, e, field, options) {
      var masks = ['000.000.000-000', '00.000.000/0000-00'];
      var mask = (cpfcnpj.length > 14) ? masks[1] : masks[0];
      $('.cpfcnpj').mask(mask, options);
    },
    reverse: true
  });

}

String.prototype.replaceAll = function (replacement) {
  var str = this.toString();
  Object.keys(replacement)
    .forEach((toReplace) => {
      str = str.replace(toReplace, replacement[toReplace]);
    });
  return str;
};


$(function () {

  enviarFormularioGenerico($('.form-generico'));
  enviarFormularioGenerico($('.form-interessado-imovel'));

  listaEstadosBrasil($('#estados-avalie'));

  function buscaCep(cepNum) {

    return new Promise(function (resolve, reject) {
      cep(cepNum)
        .then(function (data) {
          resolve(data);
        })
        .catch(function (err) {
          reject(err.type);
        });
    });

  }

  $('#busca-cep-avalie').on('blur', function (e) {

    e.preventDefault();

    var $this = $(this),
      $parent = $this.parents('form');

    var addressFields = {
      'Estado_txf': 'state',
      'Cidade_txf': 'city',
      'Bairro_txf': 'neighborhood',
      'Endereco_txf': 'street',
      'Numero_txf': 'number'
    };

    if ($this.val()) {
      buscaCep($this.val())
        .then(function (data) {

          $this.removeClass('is-invalid').addClass('is-valid');
          $this[0].setCustomValidity('');

          data.state = window.estadosBrasil[data.state];

          Object.keys(addressFields).forEach(function (key) {

            $field = $('[name="' + key + '"]', $parent);

            if (typeof data[addressFields[key]] !== 'undefined') {

              $field.val(data[addressFields[key]])
                .prop('disabled', false)
                .addClass('is-valid')
                .trigger('change');

            } else {

              $field.prop('disabled', false)
                .addClass('is-invalid')
                .trigger('change');

            }
          });

        })
        .catch(function (err) {
          console.log(err);
          $this.removeClass('is-valid').addClass('is-invalid');
          $this[0].setCustomValidity('erro');
        });
    }

  });

  $('#form-matricula').on('submit', function (event) {

    $(this).addClass('was-validated');

    if ($(this)[0].checkValidity() === false) {

      event.preventDefault();
      event.stopPropagation();

    } else {

      $(this).removeClass('was-validated');
      $(this).find('.is-valid, .is-invalid').removeClass('is-valid is-invalid');
      $(this)[0].reset();

    }

  })

});

function processaMensagemAlert(msgBackend) {

  var defaultMessages = [
    {
      Codigo_mensagem_txf: 'lead_erro',
      Mensagem_txf: 'Erro ao enviar contato...',
      Tipo_mensagem_sel: 'ERRO'
    },
    {
      Codigo_mensagem_txf: 'contato_erro',
      Mensagem_txf: 'Erro ao enviar contato...',
      Tipo_mensagem_sel: 'ERRO'
    },
    {
      Codigo_mensagem_txf: 'email',
      Mensagem_txf: 'Informe seu email!',
      Tipo_mensagem_sel: 'ERRO'
    },
    {
      Codigo_mensagem_txf: 'lead_atualiza_inserido',
      Mensagem_txf: 'Contato Atualizado!',
      Tipo_mensagem_sel: 'SUCESSO'
    },
    {
      Codigo_mensagem_txf: 'contato_ok',
      Mensagem_txf: 'Contato enviado com sucesso.',
      Tipo_mensagem_sel: 'SUCESSO'
    },
    {
      Codigo_mensagem_txf: 'lead_inserido',
      Mensagem_txf: 'Enviado com sucesso!',
      Tipo_mensagem_sel: 'SUCESSO'
    }
  ];
  var msgs = defaultMessages;

  window.utils.mensagensRetorno.forEach(function (item) {

    var existeIndex = defaultMessages.findIndex(function (msg) {
      return msg.Codigo_mensagem_txf === item.Codigo_mensagem_txf;
    });

    if (existeIndex) {
      msgs[existeIndex] = item;
    } else {
      msgs.push(item);
    }

  });

  var msgEscolhida = msgs.find(function (msg) {
    return msg.Codigo_mensagem_txf === msgBackend;
  });

  var msgDefinida = {
    title: "",
    text: msgEscolhida.Mensagem_txf || '',
    type: msgEscolhida.Tipo_mensagem_sel === 'SUCESSO' ? 'success' : 'error'
  };

  setTimeout(function () {

    swal(msgDefinida);

  }, 10);

}

function objectifyForm(formArray) {//serialize data function

  var returnArray = {};
  for (var i = 0; i < formArray.length; i++) {
    returnArray[formArray[i]['name']] = formArray[i]['value'];
  }
  return returnArray;
}

function nomeCamposEnviarEmail($form) {
  var camposEmail = [];
  $.each($form.find('[name]:not([type=hidden])'), function (campo) {

    var $campo = $(this);

    var label = $campo.data('nome') || $campo.attr('placeholder')
      || $campo.data('placeholder') || $campo.attr('name');
    label = label.replaceAll({
      'Digite seu ': '',
      'Digite sua ': '',
      '*': ''
    });

    camposEmail.push({
      label: _.startCase(_.toLower(label)),
      valor: $campo.val()
    });

  });
  return camposEmail;
}

function enviarFormularioGenerico($form, options) {

  var defaultOptions = {
    $retorno: $('#retorno')
  };

  options = Object.assign({}, defaultOptions, options);

  $('body').on('blur', '.is-invalid, .is-valid', function () {
    var $field = $(this);
    if ($field.is(':valid')) {
      $field.removeClass('is-invalid');
    } else if ($field.is(':invalid')) {
      $field.removeClass('is-valid');
    }
  });

  $form.on('submit', function (event) {

    event.preventDefault();

    $form = $(this);

    $form.addClass('was-validated');

    if ($form[0].checkValidity() === false) {

      event.preventDefault();
      event.stopPropagation();

      setTimeout(function () {
        swal({title: '', text: 'Preencha os campos corretamente', type: 'error'});
      }, 10);

    } else {

      var values = clearObject(objectifyForm($form.serializeArray()));
      values.Meio_envio_txf = 'AJAX';

      values.CamposTplEmail = JSON.stringify(nomeCamposEnviarEmail($form));

      var holdNome = values.Nome_txf;
      var holdEmail = values.Email_txf;
      var holdTel = values.Telefone_txf;

      $.ajax({
        url: `${window.appUrl}post/lead`,
        type: 'POST',
        data: values,
        beforeSend: function () {
          desabilita($form);
        },
        success: function () {
          setTimeout(function () {
            $form.removeClass('was-validated');
            $form.find('.is-valid, .is-invalid').removeClass('is-valid is-invalid');
            $form[0].reset();

            $('[name=Nome_txf]', $form).val(holdNome);
            $('[name=Email_txf]', $form).val(holdEmail);
            $('[name=Telefone_txf]', $form).val(holdTel);

          }, 500);
        },
        error: function () {
          options.$retorno.html('Erro ao enviar.');
        },
        complete: function (data) {
          try {
            data = JSON.parse(data.responseText);
            if (data.message) {
              mensagensRetornoFormulario(data.message);
            }
          } catch (e) {

          }

          habilita($form);
        }
      });

    }

  });

}

function mensagensRetornoFormulario(message) {
  processaMensagemAlert(message);
}

function landsTabs() {

  $(window).on('resize', function () {

    if ($(this).width() < 992) {

      var containerWidth = 0;

      $.each($('.lands-tabs'), function (i, v) {

        var $this = $(this);

        $.each($('.nav-item', $this), function () {
          var $li = $(this);
          var liOuterWidth = $li.outerWidth(true);
          var liWidth = $li.width();
          $li.width(liWidth);
          containerWidth += liOuterWidth;
        });

        $('.nav', $this).width(containerWidth + 6);

        if (!$this.find('.lands-tabs-fake-pad').length) {
          $this.append('<div class="lands-tabs-fake-pad"/>');
        }

      });

    }

  }).trigger('resize');

  function goToTab() {

    $('.lands-tabs .arrow').on('click', function (e) {

      e.preventDefault();

      var $this = $(this),
        $parent = $this.parents('.lands-tabs');

      $parent.scrollLeft($parentDiv.scrollTop() + $innerListItem.position().top);

    });

  }

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
