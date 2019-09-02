<div class="content-wrapper">

    <section class="content-header">
        <h1>
            Gerenciamento de <?= $subtitle; ?>
            <small>Gerencie o(a)s <?= $subtitle; ?> de seu site</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('');?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?= base_url('usuario');?>"><?= $title; ?></a></li>
            <li class="active"><?= $subtitle; ?></li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title">Visualize aqui os <?= $subtitle; ?>s existentes</h3>
                        <a href="<?= base_url('usuarios/inserir');?>" class="btn btn-small pull-right btn-flat btn-primary">Inserir novo usuário</a>
                    </div>

                    <div class="box-body">
                        
                        <table id="tabelinha" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                    <th>Tipo de Usuário</th>
                                    <th style="width:100px">Opções</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($usuarios as $user) { ?>
                                    <tr>
                                        <td><?= $user->user_id; ?></td>
                                        <td><?= $user->user_nome; ?></td>
                                        <td><?= $user->user_email; ?></td>
                                        <td><?= tipoUsuario($user->user_permissao); ?></td>
                                        <td>
                                            <a href="<?= base_url('usuarios/editar/'.$user->user_id);?>" class="btn btn-flat btn-info"><i class="fa fa-edit"></i></a>
                                            <a onclick="deletar(<?= $user->user_id; ?>)" class="btn btn-flat btn-danger"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                   <th>#</th>
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                    <th>Tipo de Usuário</th>
                                    <th>Opções</th>
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
    function deletar(id) {
            if (confirm("Deseja mesmo excluir?")) {
                window.location.href = "<?= base_url('usuarios/excluir/');?>" + id;
            }
        }
    
</script>    