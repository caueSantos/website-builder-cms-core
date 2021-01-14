(function ($) {
    $.landsAlert = function(config) {
        if (typeof config === "undefined") {
            return $.landsAlert.prototype;
        }

        clearInterval($.landsAlert.prototype.autoCloseTimer);
            
        // ConfiguraÃ§Ã£o padrÃ£o
        config = typeof config === "object" ? $.extend(true, {}, $.landsAlert.prototype.defaultConfig, config) : $.extend(true, {}, $.landsAlert.prototype.defaultConfig);

        // Criar alerta
        $('#lands-alert').remove();
        $('body').append('<div id="lands-alert"><div class="wrapper '+ config.openAnim +'"></div></div>');

        // Icon
        if (!!config.icon.length) {
            $.landsAlert().setIcon(config.icon);
        }

        // Title
        if (!!config.title.length) {
            $('#lands-alert').find('.wrapper').append('<div class="title">'+ config.title +'</div>');
        }

        // Text
        if (!!config.text.length) {
            $('#lands-alert').find('.wrapper').append('<div class="text">'+ config.text +'</div>');
        }

        // Auto close
        if (config.autoClose != null) {
            $.landsAlert.prototype.autoCloseTimer = setTimeout(function () {
                console.log('Fechou');
                $.landsAlert().close();
            }, config.autoClose);
        }
        
        // Close button
        if (config.closeButton === true) {
            config.buttons.push({
                text: config.closeButtonText || "Fechar",
                type: config.closeButtonType || "success",
                onClick: function () {
                    $.landsAlert().close();
                }
            });
        }

        // Button
        if (!!config.buttons.length) {
            $('#lands-alert').find('.wrapper').append('<div class="buttons"></div>');

            $(config.buttons).each(function () {
                var type = (this.type || config.icon || "info") + " ";
                var tempoLiberar = this.tempoLiberar || 0;
                var tempoRestante = tempoLiberar;

                if (config.buttons.length === 1) {
                    type += "btn-block ";
                }

                var button = $('<button class="button '+ type +'">'+ this.text +'</button>');
                button.appendTo('#lands-alert .wrapper .buttons');
                button.click(this.onClick);

                if (tempoLiberar > 0) {
                    button.attr('disabled', '');
                    button.append($('<span class="release-time"> '+ tempoLiberar +'s</span>'));

                    var timer = setInterval(function () {
                        if (tempoRestante === 0) {
                            clearInterval(timer);
                            button.removeAttr('disabled');
                            button.find('.release-time').remove();
                        }

                        button.find('.release-time').html(' ' + tempoRestante + 's');
                        tempoRestante--;
                    }, 1000);
                }
            });
        }
    };

    $.landsAlert.prototype.close = function () {
        $('#lands-alert').addClass('fadeOut');
        $('#lands-alert').find('.wrapper').addClass('fadeOutUp');

        setTimeout(function () {
            $('#lands-alert').remove();
        }, 500);
    };
    
    $.landsAlert.prototype.autoCloseTimer = null;

    $.landsAlert.prototype.setTitle = function (title) {
        $('#lands-alert').find('.wrapper .title').html(title);
    };

    $.landsAlert.prototype.setIcon = function (iconNome) {
        var icon = $('#lands-alert').find('.wrapper .icon');

        icon.remove();
        icon = $('<div class="icon ' + $.landsAlert.prototype.defaultConfig.iconAnim + '"></div>').appendTo(('#lands-alert .wrapper'));

        switch (iconNome) {
            case "success":
                icon.append('<div class="success"></div>');
                break;
            case "error":
                icon.append('<div class="danger"></div>');
                break;
            case "info":
                icon.append('<div class="info"></div>');
                break;
            case "warning":
                icon.append('<div class="warning"></div>');
                break;
            case "question":
                icon.append('<div class="question"></div>');
                break;
            case "loading":
                icon.append('<div class="loading"></div>');
                break;
            default:
                break;
        }
    };

    $.landsAlert.prototype.defaultConfig = {
        title: "",
        text: "",
        icon: "",
        iconAnim: "bounceIn",
        openAnim: "fadeInDown",
        closeAnim: "fadeInUp",
        autoClose: null,
        closeButton: false,
        buttons: []
    };
}) (jQuery);