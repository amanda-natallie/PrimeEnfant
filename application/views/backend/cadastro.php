<section class="section">
    <div class="container">
        <section class="hero is-success is-fullheight" style="margin-top: -30px;">
            <div class="hero-body">
                <div class="container has-text-centered">
                    <div class="columns">
                        <div class="column is-4 is-offset-4">
                            <h3 class="title has-text-grey">Cadastrar no  Sistema</h3>
                            <p class="subtitle has-text-grey">Preencha os dados corretamente</p>
                            <div class="box" style="margin-top: 1rem">
                                <?php
                                if ($this->session->flashdata('cadastrado_com_sucesso')) {
                                    echo '<div class="notification is-info">' . $this->session->flashdata('cadastrado_com_sucesso') . '</div>';
                                }
                                if ($this->session->flashdata('erro_login')) {
                                    echo '<div class="notification is-danger">' . $this->session->flashdata('erro_login') . '</div>';
                                }
                                echo validation_errors('<div class="notification is-danger">', '</div>');
                                ?>
                                <form action="<?=base_url() ?>usuarios/cadastrar/2" method="post" accept-charset="utf-8" id="validation-form">
                                <div class="field">
                                    <div class="control">
                                        <label for="cat-nome">Nome</label>
                                        <input class="input is-medium" type="text" id="user_nome" name="user_nome" placeholder="Digite o nome do Usuário">
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="control">
                                        <label for="cat-nome">Telefone</label>
                                        <input class="input is-medium" id="telefone" type="text" id="user_telefone" name="user_telefone" placeholder="Digite seu telefone">
                                    </div>
                                </div>

                                <div class="field">
                                    <div class="control">
                                        <label for="cat-nome">E-mail (será usado como login)</label>
                                        <input class="input is-medium" type="email" id="user_email" name="user_email" placeholder="Digite o e-mail do usuário">
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="control">
                                        <label for="cat-nome">Senha</label>
                                        <input class="input is-medium" type="password" id="user_senha" name="user_senha" placeholder="Digite a senha do usuário">
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="control">
                                        <label for="cat-nome">Confirme a Senha</label>
                                        <input class="input is-medium" type="password" id="user_senha_conf" name="user_senha_conf" placeholder="Digite a senha novamente">
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="control">
                                        <div id="recaptcha" class="g-recaptcha" data-sitekey="6LfBVqgUAAAAACTfktnQbCq3xmwsIIg4RNOAmwR5" style="width: 100%;"></div>
                                    </div>
                                </div>
                                <button class="button is-block is-info is-large is-fullwidth">Cadastrar</button>
                                </form>
                            </div>
                            <p class="has-text-grey">
                                <a href="<?= base_url() ?>login">Já possuo Cadastro</a> &nbsp;·&nbsp;
                                <a href="<?= base_url() ?>esqueci_senha">Esqueci minha senha</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script async type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.5/css/bulma.css"></script>
<script src="https://www.google.com/recaptcha/api.js?render=6LfBVqgUAAAAACTfktnQbCq3xmwsIIg4RNOAmwR5"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
<script>
    grecaptcha.ready(function () {
        grecaptcha.execute('6LfBVqgUAAAAACTfktnQbCq3xmwsIIg4RNOAmwR5', {action: 'homepage'}).then(function (token) {
        });
    });
     $("#telefone").mask("(99) 99999-9999");

</script>

