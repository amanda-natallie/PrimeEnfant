<div class="content-wrapper">    <section class="content-header">        <h1>            Gerenciamento de Atrações            <small>Itabirito</small>        </h1>    </section>    <section class="content">        <div class="box box-primary">            <div class="box-body">                <div class="row">                    <div class="col-md-12">                        <?= validation_errors('<div class="alert alert-danger">', '</div>'); ?>                        <form action="<?= base_url(); ?>contato/cadastrar" method="post" enctype="multipart/form-data">                            <div class="form-group">                                <label for="con_tipo">Tipo de Informação</label>                                <input type="text" class="form-control" id="con_tipo" name="con_tipo" placeholder="Ex.: Telefone de Contato">                            </div>                            <div class="form-group">                                <label for="con_valor">Valor</label>                                <input type="text" class="form-control" id="con_valor" name="con_valor" placeholder="Ex.: (31) 9 9270-4989">                            </div>                                                        <div class="box-footer">                                <input type="submit" name="btn_alt_df" class="btn btn-primary btn-flat" value="Cadastrar">                                <a href="<?= base_url("contato") ?>"  class="btn btn-danger btn-flat" >Voltar para o gerenciamento de <?= $subtitle; ?></a>                            </div>                        </form>                    </div>                </div>            </div>        </div></div>