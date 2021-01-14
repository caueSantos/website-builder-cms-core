{*<div class="card signin-card clearfix">

<img src="//assets.lands.srv.br/logos/{$app->Logo_txa}" width="275px" />
<!--      <img class="profile-img" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" alt="">-->
<p class="profile-name"></p>  

<form >


<label  class="hidden-label" for="Login_txf">Login</label>
<input  id="Login_txf" name="Login_txf" type="text"
placeholder="login"                
spellcheck="false"
class="" value='{$Login_txf|default:''}'> 
<label  class="hidden-label" for="Senha_txp">senha</label>
<input  id="Senha_txp"  type="password"
placeholder="senha"
class="" >
<input id="signIn" name="signIn" class="rc-button rc-button-submit" type="submit" value="Fazer login">

</form>
</div>*}
 

<div class="row">
    <div class="col-sm-6 col-md-4 col-md-offset-4">
        <div class="account-wall">
            <div class="text-center" style="margin: auto;">
                <img class="profile-img" src="//assets.lands.srv.br/logos/lands-core.png" width="250px">
            </div>
            <form class="form-signin" action="{$app->Url_cliente}login/fazer_login" method="post">
                <input type="hidden"  id="Lands_id" name="Lands_id" value='{$app->Lands_id}'/>
             
<!--                <input type="hidden"  id="redirect_link" name="redirect_link" value='{if (isset($redirect_link))}{$redirect_link}{else}{$app->Url_cliente}{/if}'/>-->

                <input type="text" class="form-control" name="Login_txf" placeholder="Login" value="{if is_lands()}lands{else}{$cookies->Login_txf|default:''}{/if}" required autofocus>
                <div class="espaco"></div>
                <input type="password" class="form-control" placeholder="Senha" name="Senha_txp" value="{if is_lands()}Ldlf8384@1{else}{$cookies->Senha_txp|default:''}{/if}" required>
                <button class="btn btn-lg btn-primary btn-block" type="submit">
                    Entrar</button>
                {if !is_lands()}
                    
                <label class="checkbox pull-left" style="color: #B8AAAA;">
                    <input name="Armazena_senha" type="checkbox" {if isset($lembrar_senha)} checked="checked"{/if} class="styled">
                    Lembrar senha
                </label>
                    {/if}
            </form>
        </div>
    </div>
</div>
                     