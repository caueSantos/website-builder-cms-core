;
( function( $, window, document, undefined ) {

    "use strict";

    var pluginName = "landsSocialLogin",
    defaults = {
        appId: null,
        btnLoginTxt: 'Login com o facebook',
        btnLogoutTxt: 'Desconectar do facebook',
        formId: null,
        coreFields: []        
    },
    privateOptions = {
        btn: {
            id: 'btn-login-face',
            classes: 'btn btn-block btn-face',
            iconClass: 'fa-facebook',
            textClass: 'status-text'
        }        
    };
    
    // The actual plugin constructor
    function Plugin ( element, options ) {
        this.element = element;
        this.settings = $.extend( {}, defaults, options );
        this._defaults = defaults;
        this._name = pluginName;
        this._privateOptions = privateOptions;
        
        if(!this.settings.formId){                        
            this.settings.formId = $(this.element).parents('form').attr('id');
        }
        
        this.init();
    }

    // Avoid Plugin.prototype conflicts
    $.extend( Plugin.prototype, {
        init: function() { 
            var $this = this;
            this.loadScript('https://connect.facebook.net/en_US/sdk.js').then(function(){                
                $this.FBInit();
            });
        },
        FBInit: function(){        
            
            var $this = this;
            
            FB.init({
                appId      : $this.settings.appId,
                cookie     : true,
                xfbml      : true,
                version    : 'v3.2'
            });      
        
            FB.AppEvents.logPageView();   
        
            FB.getLoginStatus(function(response) {  
                $this.insertStyle();
                $($this.element).html($this.mountButton());
                $this.btnEvent();
                if(response.status !== 'connected'){                                
                    $this.FBButtonStatus(response.status);
                }else{
                    window.FBToken = response.authResponse.accessToken;
                    $this.FBGetUserInfo().then(function(){
                        $this.FBButtonStatus(response.status);
                    });
                }                                 
                $('#' + $this._privateOptions.btn.id).addClass('allowed');
            });
                                    
        },       
        
        mountButton: function() {            
            var $btnTpl = $(`<button type="button" id="${this._privateOptions.btn.id}" class="${this._privateOptions.btn.classes}">`),
            btnIco = `<span class="ico"><span class="fa ${this._privateOptions.btn.iconClass}"></span></span>`,
            btnTxt = `<span class="${this._privateOptions.btn.textClass}">...</span>`;
            $btnTpl.append([btnIco, btnTxt]);
            $(this.element).html($btnTpl);
        },
        
        btnEvent: function(){
            var $this = this;
            $('#' + $this._privateOptions.btn.id).on('click', function(e){
                e.preventDefault(); 
                $this.FBLogin();
            });
        },
        
        FBButtonStatus: function FBButtonStatus(loginStatus){      
            var $btn = $('#' + this._privateOptions.btn.id),
            $btnTxt = $btn.find('.' + this._privateOptions.btn.textClass);
            if(loginStatus === 'connected'){
                $btnTxt.text(this.settings.btnLogoutTxt);
            }else{
                $btnTxt.text(this.settings.btnLoginTxt);
            }        
        },
        
        FBGetUserInfo: function FBGetUserInfo(){
            var $this = this;
            return new Promise(function(resolve, reject){
                FB.api('/me', {fields: 'last_name,first_name,email,picture,name'}, function(res) {
                    $this.fillFields(res);
                    resolve(res);
                });
            });        
        },
        
        fillFields: function fillFields(FBResponse){
            var _fields = this.settings.coreFields;
            $.each(_fields, function(i, field){            
                if(field.Classe_txf && field.Classe_txf.length){
                    var classes = field.Classe_txf.split(" ");
                    for (var i = 0; i < classes.length; i++) {
                        var matches = /^fbl\_(.+)/.exec(classes[i]);                        
                        if (matches != null) {
                            $('.' + classes[i]).val(FBResponse[matches[1]]);                    
                        }
                    }
                }            
            
            });
        },
        
        FBLogin: function(){
            
            var $this = this,
            $form = $('#' + this.settings.formId);
            
            if(FB.getUserID() && FB.getAccessToken()){
                FB.logout(function(response){                
                    $this.FBButtonStatus(response.status);                           
                    $form[0].reset();                    
                });
            }else{
                FB.login(function(response){            
                    $this.FBGetUserInfo().then(function(r){
                        $this.FBButtonStatus(response.status);
                    });
                }, {scope: 'email', return_scopes: true});
            }        
        },
        
        loadScript: function(src) {
            return new Promise(function (resolve, reject) {
                var s;
                s = document.createElement('script');
                s.src = src;
                s.onload = resolve;
                s.onerror = reject;
                document.head.appendChild(s);
            });
        },
        
        insertStyle: function(){
            if(!$('#fbl-style').length){
                var style = '.btn-face{ display: none; background-color: #4267B2; color: #fff; padding: 10px 20px; font-size: 18px; margin-bottom: 20px; } .btn-face > *{ vertical-align: middle; } .btn-face.allowed{ display: block; } .btn-face .ico{ margin-right: 10px; }';
                $('head').append('<style id="fbl-style">' + style + '</style>');
            }
        }
          
    });

    // A really lightweight plugin wrapper around the constructor,
    // preventing against multiple instantiations
    $.fn[ pluginName ] = function( options ) {
        return this.each( function() {
            if ( !$.data( this, "plugin_" + pluginName ) ) {
                $.data( this, "plugin_" +
                    pluginName, new Plugin( this, options ) );
            }
        } );
    };

} )( jQuery, window, document );