<header class="main-header">
                <a href="<?= base_url()?>" class="logo">
                    <span class="logo-mini"><b>P</b>E</span>
                    <span class="logo-lg"><b>Prime</b> Enfanty</span>
                </a>
                <nav class="navbar navbar-static-top">
                    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="<?= base_url("assets/backend/img/avatar3.png")?>" class="user-image" alt="User Image">
                                    <span class="hidden-xs"><?= $this->session->userdata('userlogado')->user_nome; ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="user-header">
                                        <img src="<?= base_url("assets/backend/img/avatar3.png")?>" class="img-circle" alt="User Image">
                                        <p>
                                            <?= $this->session->userdata('userlogado')->user_nome; ?> - Usuário
                                        </p>
                                    </li>
                                    <li class="user-footer">
                                        <div class="pull-left">
                                           <a href="<?= base_url('usuarios/editar/').$this->session->userdata('userlogado')->user_id?>" class="btn btn-default btn-flat">Editar Perfil</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="<?= base_url('usuarios/logout')?>" class="btn btn-default btn-flat">Deslogar</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <aside class="main-sidebar">
                <section class="sidebar">
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?= base_url("assets/backend/img/avatar3.png")?>" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p><?= $this->session->userdata('userlogado')->user_nome; ?></p>
                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <?php  $p = $this->session->userdata('userlogado')->user_permissao; ?>
                   <ul class="sidebar-menu" data-widget="tree">
                        <li class="header">Menu Principal</li>
                        <li><a href="<?= base_url(); ?>"><i class="fa fa-globe"></i> <span>Home</span></a></li>
                        <?= apenasADM($p, 'usuarios', "Usuários", "fa-user"); ?>
                        <?= apenasGESTOR($p, 'solicitacoes', "Ver Solicitações", "fa-database"); ?>
                        <li><a href="<?= base_url(); ?>cadastro"><i class="fa fa-copy"></i> <span>Gerenciar Cadastro</span></a></li>
                        <li><a href="<?= base_url('formulario');?>"><i class="fa fa-list"></i> <span>Gerenciar Formulário</span> </a> </li>
                        <li><a href="<?= base_url('responder');?>"><i class="fa fa-list"></i> <span>Responder Formulário</span> </a> </li>
                    </ul>
                </section>
            </aside>