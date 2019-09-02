<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Cadastro de Sessão
            <small>Crie uma sessão do formulário</small>
        </h1>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <?= validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                        <form action="<?= base_url(''); ?>secao/cadastrar/<?= $form?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name='ses_id_form' value="<?= $form?>">
                            <div class="form-group">
                                <label for="ses_nome">Seção do Formulário</label>
                                <input type="text" class="form-control" id="ses_nome" name="ses_nome" placeholder="Ex.: Dados da Criança / Child's Information">
                            </div>
                            <div class="box-footer">
                                <input type="submit" name="btn_alt_df" class="btn btn-primary btn-flat" value="Cadastrar">
                                <a href="<?= base_url("secao/").$form ?>"  class="btn btn-danger btn-flat" >Voltar para o gerenciamento de <?= $subtitle; ?></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>