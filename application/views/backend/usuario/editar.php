<div class="content-wrapper">
    <section class="content-header">
        <h1>
           Editar informações de usuário
            <small>Edição</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Usuários</a></li>
            <li class="active">Editar usuário</li>
        </ol>
    </section>
    <section class="content">

        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <?php
                        echo validation_errors('<div class="alert alert-danger">','</div>');
                        echo form_open('usuarios/salvar_alteracoes');
                        foreach ($usuario as $user) {
                        ?>
                        <input type="hidden" name="user_id" value="<?= $user->user_id; ?>">
                        <div class="form-group col-md-6">
                            <label for="cat-nome">Nome</label>
                            <input type="text" class="form-control" id="user_nome" value="<?= $user->user_nome; ?>" name="user_nome" placeholder="Digite o nome da Categoria">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="cat-nome">Telefone</label>
                            <input type="text" class="form-control" id="telefone" value="<?= $user->user_telefone; ?>" name="user_telefone" placeholder="Digite um telefone">
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label for="cat-nome">Senha </label>
                            <input type="password" class="form-control" id="cat-nome" name="user_senha" placeholder="Digite a senha do usuário">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="cat-nome">Confirme a Senha</label>
                            <input type="password" class="form-control" id="cat-nome" name="user_senha_conf" placeholder="Digite a senha do usuário">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="cat-nome">E-mail (login do usuário)</label>
                            <input type="text" readonly="" class="form-control" id="cat-nome"  value="<?= $user->user_email; ?>"name="user_email" placeholder="Digite o e-mail do usuário">
                        </div>
                        <?php if($permissao == 1) { ?>
                        <div class="form-group col-md-6">
                            <label for="cat-nome">Permissão do Usuário</label>
                            <select class="form-control" id="user_permissao" name="user_permissao">
                                <option value="">--selecione um --</option>
                                <option value="1" <?php if($user->user_permissao == 1) { echo "selected"; } ?> >Administrador Geral</option>
                                <option value="2" <?php if($user->user_permissao == 2) { echo "selected"; } ?> >Gerente de Conteudo</option>
                                <option value="3" <?php if($user->user_permissao == 3) { echo "selected"; } ?> >Autor do Blog</option>
                            </select>
                        </div>
                        <?php }else if($permissao == 2){ ?>
                        <input type="hidden" name="user_permissao" value="2">
                        <?php } else if($permissao == 3){ ?>
                        <input type="hidden" name="user_permissao" value="3">
                        <?php } ?>
                        <?php } ?>
                        <div class="box-footer">
                            <input type="submit" name="btn_alt_df" class="btn btn-primary btn-flat" value="Salvar Alterações">
                            <a href="<?= base_url(); ?>"  class="btn btn-danger btn-flat" >Cancelar</a>
                        </div>
                        <?= form_close(); ?>
                    </div>
                </div>

            </div>
        </div>

</div>