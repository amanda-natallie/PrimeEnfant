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
                        <?php
                        if (!$param) {
                            ?>
                            <div class="form-group">
                                <?php
                                foreach ($formulario as $form) {
                                    echo "<input type='radio' name='form' id='form' value='" . $form['form_id'] . "' onclick='montaFormulario(" . $form['form_id'] . ");'>" . $form['form_nome'] . "<br />";
                                }
                                ?>
                            </div>
                        <?php } else {
                            ?>
                            <?= validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                        <form action="<?= base_url(''); ?>responder/cadastrar/<?= $param ?>" method="post"
                              enctype="multipart/form-data">
                            <?php
                            $repete = NULL;
                            foreach ($secoes

                                     as $secao) {
                                if ($repete != $secao) { ?>
                                    <h4><?= $secao; ?></h4>

                                    <?php

                                    for ($i = 0; $i < sizeof($formularioMontado); $i++) {
                                        ?>
                                        <div class="form-group">
                                            <label for="<?= $formularioMontado[$i]['cam_name']; ?>"><?= $formularioMontado[$i]['cam_label']; ?></label>
                                            <?php

                                            if ($formularioMontado[$i]['tip_codigo'] == 'text') {?>


                                                <input class="form-control"
                                                       type="<?= $formularioMontado[$i]['tip_codigo']; ?>"
                                                       name="<?= $formularioMontado[$i]['cam_name']; ?>"
                                                       id="<?= $formularioMontado[$i]['cam_name']; ?>" <?= $formularioMontado[$i]['cam_mandatory'] == true ? 'required' : NULL; ?> <?= $formularioMontado[$i]['tip_nome'] == 'CPF' ? 'mascara' : NULL; ?> />


                                            <?php }
                                            if ($formularioMontado[$i]['tip_codigo'] == 'date') { ?>

                                                <input class="form-control"
                                                       type="<?= $formularioMontado[$i]['tip_codigo']; ?>"
                                                       name="<?= $formularioMontado[$i]['cam_name']; ?>"
                                                       id="<?= $formularioMontado[$i]['cam_name']; ?>" <?= $formularioMontado[$i]['cam_mandatory'] == true ? 'required' : NULL; ?> <?= $formularioMontado[$i]['tip_nome'] == 'CPF' ? 'mascara' : NULL; ?> />

                                            <?php }
                                            if ($formularioMontado[$i]['tip_codigo'] == 'email') { ?>

                                                <input class="form-control"
                                                       type="<?= $formularioMontado[$i]['tip_codigo']; ?>"
                                                       name="<?= $formularioMontado[$i]['cam_name']; ?>"
                                                       id="<?= $formularioMontado[$i]['cam_name']; ?>" <?= $formularioMontado[$i]['cam_mandatory'] == true ? 'required' : NULL; ?> <?= $formularioMontado[$i]['tip_nome'] == 'CPF' ? 'mascara' : NULL; ?> />

                                            <?php }
                                            if ($formularioMontado[$i]['tip_codigo'] == 'tel') { ?>
                                                <input class="form-control"
                                                       type="<?= $formularioMontado[$i]['tip_codigo']; ?>"
                                                       name="<?= $formularioMontado[$i]['cam_name']; ?>"
                                                       id="<?= $formularioMontado[$i]['cam_name']; ?>" <?= $formularioMontado[$i]['cam_mandatory'] == true ? 'required' : NULL; ?> <?= $formularioMontado[$i]['tip_nome'] == 'CPF' ? 'mascara' : NULL; ?> />


                                            <?php }
                                            if ($formularioMontado[$i]['tip_codigo'] == 'number') { ?>
                                                <input class="form-control"
                                                       type="<?= $formularioMontado[$i]['tip_codigo']; ?>"
                                                       name="<?= $formularioMontado[$i]['cam_name']; ?>"
                                                       id="<?= $formularioMontado[$i]['cam_name']; ?>" <?= $formularioMontado[$i]['cam_mandatory'] == true ? 'required' : NULL; ?> <?= $formularioMontado[$i]['tip_nome'] == 'CPF' ? 'mascara' : NULL; ?> />

                                            <?php
                                            }
                                            if ($formularioMontado[$i]['tip_codigo'] == 'select') { ?>

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
                                            if ($formularioMontado[$i]['tip_codigo'] == 'radio' || $formularioMontado[$i]['tip_codigo'] == 'checkbox') { ?>
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
                                }
                                $repete = $secao;
                            } ?>
                            <input class="btn btn-primary" type="submit" name="btn_enviar" id="btn_enviar"
                                   value="Enviar"/>
                            </form><?php } ?>
                    </div>
                </div>
            </div>
        </div>
</div>
<script type="text/javascript">


    function montaFormulario(id) {

        window.location.assign('responder/' + id);
    }
</script>