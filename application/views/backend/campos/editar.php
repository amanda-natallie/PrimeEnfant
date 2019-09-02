<div class="content-wrapper">

    <section class="content-header">

        <h1>

            Advanced Form Elements

            <small>Preview</small>

        </h1>

        <ol class="breadcrumb">

            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="#">Forms</a></li>

            <li class="active">Advanced Elements</li>

        </ol>

    </section>

    <section class="content">



        <div class="box box-primary">

            <div class="box-body">

                <div class="row">

                    <div class="col-md-12">

                        <?php

                        echo validation_errors('<div class="alert alert-danger">','</div>');

                        echo form_open('campos/salvar_alteracoes');

                        foreach ($campos as $camp) {

                            ?>

                            <input type="hidden" name="cat-id" value="<?= $camp['tip_id'] ?>">

                            <div class="form-group">

                                <label for="tip_nome">Nome do campo</label>

                                <input type="text" class="form-control" id="tip_nome" value="<?= $camp['tip_nome']; ?>" name="tip_nome" placeholder="Digite o nome do campo">

                            </div>

                            <div class="form-group">

                                <label for="tip_codigo">Tipo do input(Type)</label>

                                <input type="text" class="form-control" id="tip_codigo" value="<?= $camp['tip_codigo']; ?>" name="tip_codigo" placeholder="Digite o tipo do input">

                            </div>

                        <?php } ?>

                        <div class="box-footer">

                            <input type="submit" name="btn_alt_df" class="btn btn-primary btn-flat" value="Cadastrar">

                            <a href="<?= base_url('campos/');?>"  class="btn btn-danger btn-flat" >Voltar para o gerenciamento de <?= $subtitle; ?></a>

                        </div>

                        <?= form_close(); ?>

                    </div>

                </div>



            </div>

        </div>



</div>