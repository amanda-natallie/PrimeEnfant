<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Cadastro de Formulário
            <small>Itabirito</small>
        </h1>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <?= validation_errors('<div class="alert alert-danger">', '</div>'); ?>

                        <form action="<?= base_url(); ?>formulario/cadastrar" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="form_nome">Nome</label>
                                <input type="text" class="form-control" id="form_nome" name="form_nome" placeholder="Nome do formulário">
                            </div>
                            <div class="box-footer">
                                <input type="submit" name="btn_alt_df" class="btn btn-primary btn-flat" value="Cadastrar">
                                <a href="<?= base_url("formulario") ?>"  class="btn btn-danger btn-flat" >Voltar para o gerenciamento de <?= $subtitle; ?></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>