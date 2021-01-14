function buildPorfolio(username, $container, options = {}) {

  var defaults = {
    quantity: 6,
    cols: 'col-6 col-md-2',
    success: function(){},
    error: function(){}
  };
  options = $.extend({}, defaults, options);

  var lib = new Nanogram();

  lib.getMediaByUsername(username, 2).then(function (response) {

    var photos = response.profile.edge_owner_to_timeline_media.edges;

    for (var i = 0; i <= options.quantity - 1; i++) {

      var current = photos[i].node;
      var thumbnail = current.thumbnail_resources[4];
      var imgSrc = thumbnail.src;
      var imgWidth = thumbnail.config_width;
      var imgHeight = thumbnail.config_height;
      var imgAlt = current.accessibility_caption.replace(/(<([^>]+)>)/gi, "");

      var shortcode = current.shortcode;
      var linkHref = 'https://www.instagram.com/p/' + shortcode;

      var $colTpl = $(`<div class="${options.cols}"></div>`);
      var $innerTpl = $(`<a target="_blank" href="${linkHref}" class="d-block aspect aspect-1-1">
                          <figure class="imagem aspect-item">
                            <img alt="imagem do instagram" src="${imgSrc}" class="img-fit">
                          </figure>
                        </a>`);

      $colTpl.append($innerTpl);
      $container.append($colTpl);

    }

    options.success(photos);

  }).catch(function (error) {
    options.error(error);
  })
}
