<div class="content-wrapper">
    <section class="content-header">
        <h1>Gerenciamento de Seções de Formulário</h1><br>
        <p><strong>Formulário: </strong> <?= $subtitle; ?></p>
        <ol class="breadcrumb">
            <li><a href="<?= base_url(''); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?= base_url('formulario'); ?>">Formulários</a></li>
            <li class="active">Seções</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title">Visualize aqui as seções existentes</h3>
                        <?= mostraTagADMIN($p, '<a href="' . base_url('secao/inserir/' . $form["form_id"]) . '" class="btn btn-small pull-right btn-flat btn-primary">Inserir nova seção</a>'); ?>
                    </div>
                    <div class="box-body">
                        <table id="tabelinha" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Seção</th>
                                    <th>Formulário</th>
                                    <th style="width:120px">Opções</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($secao as $sec) { ?>
                                    <tr>
                                        <td><?= $sec["ses_id"]; ?></td>
                                        <td><?= $sec["ses_nome"] ?></td>
                                        <td><?= $form['form_nome']; ?></td>
                                        <td><a href="<?= base_url('campo/' . $sec["ses_id"]); ?>" class="btn btn-flat btn-default" data-toggle="tooltip" title="Gerenciar Campos"><i class="fa fa-eye"></i></a>

                                            <a href="<?= base_url('secao/editar/' . $sec["ses_id"]); ?>"
                                               class="btn btn-flat btn-info"  data-toggle="tooltip" title="Editar Seção"><i class="fa fa-edit"></i></a>
                                               <?= mostraTagADMIN($p, '<a onclick="deletar(' . $sec["ses_id"]. ','.$form['form_id'].')" class="btn btn-flat btn-danger"  data-toggle="tooltip" title="Excluir Seção"><i class="fa fa-trash"></i></a>') ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Seção</th>
                                    <th>Formulario</th>
                                    <th style="width:100px">Opções</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>

    function deletar(id, form) {

        if (confirm("Deseja mesmo excluir?")) {

            window.location.href = "<?= base_url('secao/excluir/'); ?>" + id + '/' + form;

        }

    }


</script>