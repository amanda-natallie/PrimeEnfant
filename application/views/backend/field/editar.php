<div class="content-wrapper">    <section class="content-header">        <h1>Editar Texto</h1>    </section>    <section class="content">        <div class="box box-primary">            <div class="box-body">                <div class="row">                    <div class="col-md-12">                        <?= validation_errors('<div class="alert alert-danger">', '</div>'); ?>                        <?php foreach ($field as $txt) { ?>                            <form action="<?= base_url("field/salvar_alteracoes/".$id."/".$campo); ?>" method="post" enctype="multipart/form-data">                                <div class="form-group">                                    <label for="opc_label">Label da opção</label>                                    <input type="text" class="form-control" id="opc_label" name="opc_label" placeholder="Label da opção" value="<?= $txt['opc_label']; ?>">                                    <label for="opc_value">Valor da opção</label>                                    <input type="text" class="form-control" id="opc_value" name="opc_value" placeholder="Valor da opção" value="<?= $txt['opc_value']; ?>">                                </div>                                <div class="box-footer">                                    <input type="submit" name="btn_alt_df" class="btn btn-primary btn-flat" value="Alterar Informações">                                    <a href="<?= base_url('field/'.$campo);?>"  class="btn btn-danger btn-flat" >Voltar para o gerenciamento de <?= $subtitle; ?></a>                                </div>                            </form>                        <?php } ?>                    </div>                </div>            </div>        </div></div>