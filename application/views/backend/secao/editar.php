<div class="content-wrapper">
    <section class="content-header">
        <h1>Editar Texto</h1>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <?= validation_errors('<div class="alert alert-danger">', '</div>'); ?>

                        <form action="<?= base_url("secao/salvar_alteracoes/".$secao[0]["ses_id"]."/".$secao[0]['form_id']); ?>" method="post"
                              enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="form_nome">Nome</label>
                                <?php if ($secao[0]["ses_id"] == 3) { ?>
                                    <textarea type="text" class="form-control" id="ses_nome" name="ses_nome"
                                              placeholder="Cole aqui o código do Iframe"><?= $secao[0]["ses_nome"]; ?></textarea>

                                <?php } else { ?>

                                    <input value="<?= $secao[0]["ses_nome"]; ?>" type="text" class="form-control"
                                           id="ses_nome" name="ses_nome" placeholder="Nome da seção">
                                <?php } ?>
                            </div>
                            <div class="box-footer">
                                <input type="submit" name="btn_alt_df" class="btn btn-primary btn-flat"
                                       value="Alterar Informações">
                                <a href="<?= base_url('secao/').$secao[0]['form_id']; ?>" class="btn btn-danger btn-flat">Voltar para o
                                    gerenciamento de <?= $subtitle; ?></a>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
</div>