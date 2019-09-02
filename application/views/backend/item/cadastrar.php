<div class="content-wrapper">
    <section class="content-header">
        <h1>Cadastro de Formulário</h1>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <?= validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                        <form action="<?= base_url(); ?>campo/cadastrar/<?= $secao ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="cam_sessao_form" value="<?= $secao ?>">
                            <div class="form-group col-md-6">
                                <label for="cam_tipo">Tipo do campo</label>
                                <select class="form-control" name="cam_tipo" id="cam_tipo">
                                    <option value="">-- Escolha o tipo do campo --</option>
                                    <?php
                                    foreach ($tipos as $tipo) {
                                        echo "<option value='" . $tipo['tip_id'] . "'>" . $tipo['tip_nome'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group  col-md-6">
                                <label for="cam_label">Label do campo</label>
                                <input type="text" class="form-control" id="cam_label" name="cam_label"
                                       placeholder="Texto a ser exibido antes do campo">
                            </div>
                            <div class="form-group  col-md-6">
                                <label for="cam_name">Nome do campo</label>
                                <input type="text" class="form-control" id="cam_name" name="cam_name"
                                       placeholder="Nome do campo">
                            </div>
                            <div class="form-group  col-md-6">
                                <label for="cam_validation_message">Mensagem de validação</label>
                                <input class="form-control" id="cam_validation_message" name="cam_validation_message"
                                       placeholder="Mensagem de retorno para o usuário">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="cam_opt1">Campo opcional 1</label>
                                <input class="form-control" id="cam_opt1" name="cam_opt1" placeholder="campo caso opcional">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="cam_opt2">Campo opcional 2</label>
                                <input class="form-control" id="cam_opt2" name="cam_opt2" placeholder="campo caso opcional">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="cam_opt3">Campo opcional 3</label>
                                <input class="form-control" id="cam_opt3" name="cam_opt3" placeholder="campo caso opcional">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="cam_opt4">Campo opcional 4</label>
                                <input class="form-control" id="cam_opt4" name="cam_opt4" placeholder="campo caso opcional">
                            </div>
                            <div class="form-group">
                                <label for="cam_mandatory">Campo obrigatório:</label>
                                <input type="checkbox" id="cam_mandatory" name="cam_mandatory" checked="">
                            </div>
                            <div class="box-footer">
                                <input type="submit" name="btn_alt_df" class="btn btn-primary btn-flat"
                                       value="Cadastrar">
                                <a href="<?= base_url("campo/" . $secao) ?>" class="btn btn-danger btn-flat">Voltar para o
                                    gerenciamento de <?= $subtitle; ?></a>
                            </div>
                        </form>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="alert alert-info">
            <strong>Atenção!</strong> Se seu campo for do tipo <i>checkbox</i>, <i>radio</i> ou <i>select</i>, você deve setar as configurações após cadastrá-lo.
        </div>
</div>