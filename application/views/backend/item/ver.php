<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Gerenciamento de Campos<br><br>
        </h1>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5">
                    <p class=""><strong>Formulário:</strong> <?= $dados_secao["form_nome"]; ?></p>
                    <p class=""><strong>Seção:</strong> <?= $dados_secao["ses_nome"]; ?></p>
                </div>
                <div class="col-md-7 text-right">
                    <p>
                        <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapseExample"
                                aria-expanded="false" aria-controls="collapseExample">
                            Ir para seção:
                        </button>
                    </p>
                    <div class="collapse" id="collapseExample" style="max-width: 100%">
                        <div class="card card-body">
                            <ul class="list-unstyled">

                                <?php
                                foreach ($secoes as $s) {
                                    echo '<li><a href="' . base_url('campo/' . $s["ses_id"]) . '">' . $s["ses_nome"] . '</a></li>';
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <ol class="breadcrumb">
            <li><a href="<?= base_url(''); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?= base_url('formulario'); ?>">Formulários</a></li>
            <li><a href="<?= base_url('secao/' . $dados_secao["form_id"]); ?>">Seções</a></li>
            <li class="active">Campos</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-header">
                        <h5 class="box-title">Gerencie os campos existentes para o formulário acima</h5>

                        <?= mostraTagADMIN($p, '<a href="' . base_url('campo/inserir/' . $secao) . '" class="btn btn-small pull-right btn-flat btn-primary">Inserir novo Campo</a>'); ?>

                    </div>
                    <div class="box-body">
                        <table id="tabelinha" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Campo</th>
                                <th style="width:100px">Opções</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($campos as $itens) { ?>
                                <tr>
                                    <td><?= $itens["cam_id"] ?></td>
                                    <td><?= $itens["cam_label"] ?></td>
                                    <td>
                                        <?php if ($itens["cam_tipo"] == 4 || $itens["cam_tipo"] == 15 || $itens["cam_tipo"] == 17) { ?>
                                            <a href="#ger-fields" class="btn btn-flat btn-default" data-toggle="tooltip"
                                               title="Gerenciar Opções"
                                               onclick="buscarOpcao(<?= $itens['cam_id'] ?>)"><i class="fa fa-eye"></i></a>
                                        <?php } ?>
                                        <a href="<?= base_url('campo/editar/' . $itens["cam_id"] . "/" . $secao); ?>"
                                           class="btn btn-flat btn-info"><i class="fa fa-edit"></i></a>
                                        <?= mostraTagADMIN($p, '<a onclick="deletar(' . $itens["cam_id"] . ',' . $secao . ')" class="btn btn-flat btn-danger"><i class="fa fa-trash"></i></a>') ?>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Campo</th>
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
<div class="remodal" data-remodal-id="ger-fields" role="dialog" aria-labelledby="modal1Title"
     aria-describedby="modal1Desc" style="padding: 10px 0">
    <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="col-xs-12">
                <div class="box-header">
                    <h3 class="box-title">Visualize aqui as opções deste campo</h3>
                    <a href="https://dev.valloritecnologia.com.br/prime/field/inserir/7"
                       class="btn btn-small pull-right btn-flat btn-primary">Inserir novo option</a></div>
                <div class="box-body">
                    <div class="float-right">
                        <select class="form-group align-right" name="options" id="options">
                            <option value="">Insira um grupo de opção</option>
                        </select>
                        <button class="btn-success"><i class="fa fa-plus"></i> Incluir</button>
                    </div>
                    <table id="tabelinha" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Label</th>
                            <th style="width:100px">Opções</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>10</td>
                            <td>Feminino</td>
                            <td>
                                <a href="https://dev.valloritecnologia.com.br/prime/field/editar/10/7"
                                   class="btn btn-flat btn-info"><i class="fa fa-edit"></i></a>
                                <a onclick="deletar(10, 7)" class="btn btn-flat btn-danger"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>9</td>
                            <td>Masculino</td>
                            <td>
                                <a href="https://dev.valloritecnologia.com.br/prime/field/editar/9/7"
                                   class="btn btn-flat btn-info"><i class="fa fa-edit"></i></a>
                                <a onclick="deletar(9, 7)" class="btn btn-flat btn-danger"><i
                                            class="fa fa-trash"></i></a></td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Label</th>
                            <th style="width:100px">Opções</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <br>
    <button data-remodal-action="cancel" class="remodal-cancel">Cancelar</button>
    <button data-remodal-action="confirm" class="remodal-confirm">OK
    </button> <!-- bota sua função aqui -->
</div>
<script>

    function deletar(id, secao) {

        if (confirm("Deseja mesmo excluir?")) {
            window.location.href = "<?= base_url('campo/excluir/'); ?>" + id + "/" + secao;
        }
    }

    function buscarOpcao($id) {


    }
</script>