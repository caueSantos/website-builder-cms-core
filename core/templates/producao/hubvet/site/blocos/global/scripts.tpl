{literal}<script>  function styleFromJs(styleId, cssCode) {    $styleTag = document.getElementById(styleId);    if (!$styleTag) {      var style = document.createElement('style');      style.setAttribute('id', styleId);      document.getElementsByTagName('head')[0].appendChild(style);      $styleTag = document.getElementById(styleId);    }    $styleTag.innerHTML = cssCode;  }  function containerHelper() {    var $container = document.querySelector('.container');    window.containerOutterWidth = Math.ceil((window.innerWidth - $container.clientWidth + 30) / 2);    var styleCode = `:root { --container-width: ${$container.clientWidth}px; --container-outter-gutter: ${window.containerOutterWidth}px; }`;    styleFromJs('container-js-style', styleCode);  }  window.addEventListener('resize', function () {    containerHelper();  });  window.dispatchEvent(new Event('resize'));</script>{/literal}{*PLUGINS*}<script src="{$assets}plugins/utils/lodash.js"></script><script src="{$assets}plugins/utils/cep-promise.min.js"></script><script src="{$assets}plugins/jquery/jquery.ui.widget.js"></script><script src="{$assets}plugins/utils/jquery.mask.min.js"></script><script src="{$assets}plugins/bootstrap/popper.min.js"></script><script src="{$assets}plugins/bootstrap/bootstrap.min.js"></script><script src="{$assets}plugins/fancybox/jquery.fancybox.min.js"></script><script src="{$assets}plugins/owl-carousel/owl.carousel.min.js"></script><script src="{$assets}plugins/utils/readmore.min.js"></script><script src="{$assets}plugins/utils/jquery.scrolling-tabs.min.js"></script><script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script><script src="https://cdn.jsdelivr.net/npm/nanogram.js@2.0.0/dist/nanogram.iife.min.js"></script><script src="{$assets}plugins/utils/instagram.portfolio.js"></script><script type="text/javascript" src="https://cdn.jsdelivr.net/npm/dot@1.1.3/doT.min.js"></script>{*LANDS*}<script src="{$assets}js/default.js"></script><script src="{$assets}js/lands.js"></script>{carrega_script('imoveis.js', 'imoveis')}{$app->Scripts_txa}<script>  $(function () {    setTimeout(function () {      $('#full-loader').fadeOut(200);    }, 250);  })</script>