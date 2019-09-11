<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Gerenciar Formulários
            <small>Escolha qual formulário você deseja responder:</small>
        </h1>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                        <?php
                        if (!$param) {
                            ?>
                          
                                <?php
                                foreach ($formulario as $form) {
                                    echo '<div class="form-group col-md-4">';
                                        echo '<div class="selection">';
                                            echo "<input type='radio' name='form' id='form' value='" . $form['form_id'] . "' onclick='montaFormulario(" . $form['form_id'] . ");'>";
                                            echo '<div for="'.$form['form_id'].'" onclick="montaFormulario(' . $form["form_id"] . ');"><p><i class="fa fa-address-card"></i></p><p>'.$form['form_nome'].'</p></div>';
                                        echo '</div>';
                                    echo '</div>';
                                }
                                ?> 
                          
                        <?php } else {
                            ?>
                            <?= validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                    <div class="col-md-12">
                            <form action="<?= base_url(''); ?>responder/cadastrar/<?= $param ?>" method="post"
                                  enctype="multipart/form-data">
                                      <?php $repete = NULL;
                                      foreach ($secoes as $secao) {
                                          if ($repete != $secao) { ?>
                                        <div class="prettybox col-md-6">
                                            <h4><strong><?= $secao; ?></strong></h4>
                                            <?php
                                            for ($i = 0; $i < sizeof($formularioMontado); $i++) {
                                                ?>
                                                <div class="form-group">
                                                    <label for="<?= $formularioMontado[$i]['cam_name']; ?>"><?= $formularioMontado[$i]['cam_label']; ?></label>
                                                    <?php if ($formularioMontado[$i]['tip_codigo'] == 'text') { ?>


                                                        <input class="form-control"
                                                               type="<?= $formularioMontado[$i]['tip_codigo']; ?>"
                                                               name="<?= $formularioMontado[$i]['cam_name']; ?>"
                                                               id="<?= $formularioMontado[$i]['cam_name']; ?>" <?= $formularioMontado[$i]['cam_mandatory'] == true ? 'required' : NULL; ?> <?= $formularioMontado[$i]['tip_nome'] == 'CPF' ? 'mascara' : NULL; ?> />


                <?php }
                if ($formularioMontado[$i]['tip_codigo'] == 'date') {
                    ?>

                                                        <input class="form-control"
                                                               type="<?= $formularioMontado[$i]['tip_codigo']; ?>"
                                                               name="<?= $formularioMontado[$i]['cam_name']; ?>"
                                                               id="<?= $formularioMontado[$i]['cam_name']; ?>" <?= $formularioMontado[$i]['cam_mandatory'] == true ? 'required' : NULL; ?> <?= $formularioMontado[$i]['tip_nome'] == 'CPF' ? 'mascara' : NULL; ?> />

                                                    <?php }
                                                    if ($formularioMontado[$i]['tip_codigo'] == 'email') {
                                                        ?>

                                                        <input class="form-control"
                                                               type="<?= $formularioMontado[$i]['tip_codigo']; ?>"
                                                               name="<?= $formularioMontado[$i]['cam_name']; ?>"
                                                               id="<?= $formularioMontado[$i]['cam_name']; ?>" <?= $formularioMontado[$i]['cam_mandatory'] == true ? 'required' : NULL; ?> <?= $formularioMontado[$i]['tip_nome'] == 'CPF' ? 'mascara' : NULL; ?> />

                                                    <?php }
                                                    if ($formularioMontado[$i]['tip_codigo'] == 'tel') {
                                                        ?>
                                                        <input class="form-control"
                                                               type="<?= $formularioMontado[$i]['tip_codigo']; ?>"
                                                               name="<?= $formularioMontado[$i]['cam_name']; ?>"
                                                               id="<?= $formularioMontado[$i]['cam_name']; ?>" <?= $formularioMontado[$i]['cam_mandatory'] == true ? 'required' : NULL; ?> <?= $formularioMontado[$i]['tip_nome'] == 'CPF' ? 'mascara' : NULL; ?> />


                                                    <?php }
                                                    if ($formularioMontado[$i]['tip_codigo'] == 'number') {
                                                        ?>
                                                        <input class="form-control"
                                                               type="<?= $formularioMontado[$i]['tip_codigo']; ?>"
                                                               name="<?= $formularioMontado[$i]['cam_name']; ?>"
                                                               id="<?= $formularioMontado[$i]['cam_name']; ?>" <?= $formularioMontado[$i]['cam_mandatory'] == true ? 'required' : NULL; ?> <?= $formularioMontado[$i]['tip_nome'] == 'CPF' ? 'mascara' : NULL; ?> />

                                                        <?php
                                                    }
                                                    if ($formularioMontado[$i]['tip_codigo'] == 'select') {
                                                        ?>

                                                        <select class="form-control"
                                                                name="<?= $formularioMontado[$i]['cam_name'] ?>"
                                                                id="<?= $formularioMontado[$i]['cam_name'] ?>">
                                                            <option value="">Selecione</option>
                                                            <?php
                                                            foreach ($opcoes[$formularioMontado[$i]['cam_id']] as $op) {
                                                                echo "<option value'" . $op['opc_value'] . "'>" . $op['opc_label'] . "</option>";
                                                            }
                                                            ?>
                                                        </select>

                                                        <?php }
                                                        if ($formularioMontado[$i]['tip_codigo'] == 'radio' || $formularioMontado[$i]['tip_codigo'] == 'checkbox') {
                                                            ?>
                                                        <div class="form-group">
                                                            <?php
                                                            foreach ($opcoes[$formularioMontado[$i]['cam_id']] as $op) {
                                                                echo "<input type='" . $formularioMontado[$i]['tip_codigo'] . "' name='" . $formularioMontado[$i]['cam_name'] . "' id='" . $formularioMontado[$i]['cam_name'] . "' value='" . $op['opc_value'] . "'>" . $op['opc_label'];
                                                            }
                                                            ?>
                                                        </div>
                                            <?php } ?>
                                                </div>
                                        <?php }
                                    ?> </div><?php }
                                    ?>
                                   
                            <?php $repete = $secao; } ?>
                                <input class="btn btn-primary" type="submit" name="btn_enviar" id="btn_enviar" value="Enviar"/>
                            </form>
                        <?php } ?>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
</div>
<script type="text/javascript">


    function montaFormulario(id) {

        window.location.assign('responder/' + id);
    }
</script>