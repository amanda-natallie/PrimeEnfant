<section class="section bg-parallax bg-room-detail" style="background: url(<?= $img[12] ?>) bottom center no-repeat; background-size:cover">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                <h3><?= $chale[0]['cha_nome']; ?></h3>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="slider-check">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="big-slider">
                        <div class="item">
                            <div class="post-thumbnail">
                                <img src="<?= $chale[0]['cha_imagem']; ?>" alt="<?= $chale[0]['cha_nome']; ?>" title="<?= $chale[0]['cha_nome']; ?>"/>
                            </div>

                            <div class="post-body">
                                <h5><?= $chale[0]['cha_resumo']; ?></h5>
                            </div>
                        </div>
                        <?php foreach ($fotos as $foto) { ?>
                            <div class="item">
                                <div class="post-thumbnail">
                                    <img src="<?= $foto['foq_imagem'] ?>" alt="<?= $foto['foq_titulo'] ?>" />
                                </div>
                                <div class="post-body">
                                    <h5><?= $foto['foq_titulo'] ?></h5>
                                </div>
                            </div>

                        <?php } ?>
                    </div>
                    <div class="small-slider">

                        <div class="item">
                            <div class="post-thumbnail">
                                <img src="<?= $chale[0]['cha_imagem']; ?>" alt="<?= $chale[0]['cha_nome']; ?>" title="<?= $chale[0]['cha_nome']; ?>" >
                            </div>
                        </div>
                        <?php foreach ($fotos as $foto) { ?>
                            <div class="item">
                                <div class="post-thumbnail">
                                    <img src="<?= $foto['foq_imagem'] ?>" alt="<?= $foto['foq_titulo'] ?>" >
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>


            </div>
        </div>
    </div>
</section>
<section class="section bg-white">
    <div class="container">
        <div class="room-infomation">
            <div class="switch-list">
                <ul>
                    <li>
                        <a href="#overview" class="active">
                            <h3 class="h4">Visão Geral</h3>
                            <span class="icon-arrow">&nbsp;</span>
                        </a>
                    </li>

                    <li>
                        <a href="#rates">
                            <h3 class="h4">Tarifas</h3>
                            <span class="icon-arrow">&nbsp;</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="info-content">
                <div id="overview" class="info-inner">
                    <div class="info-header">
                        <?= $chale[0]['cha_descricao']; ?>
                    </div>
                </div>

                <div id="rates" class="info-inner">
                    <div class="info-footer">
                        <table>
                            <thead>
                                <tr>
                                    <th>Período do ano</th>
                                    <th>Diária</th>
                                    <th>Semanal Pernoite</th>
                                    <th>Mensal</th>
                                    <th>Eventos</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tarifas as $tar) { ?>
                                    <tr>
                                        <td>
                                            <h4 class="h5"><?= $tar['tar_periodo'] ?></h4>
                                            <p><?= $tar['tar_dias'] ?></p>
                                            <p><?= $tar['tar_minimopernoite'] ?></p>
                                        </td>
                                        <td><?= $tar['tar_diaria'] ?></td>
                                        <td><?= $tar['tar_semanal'] ?></td>
                                        <td><?= $tar['tar_mensal'] ?></td>
                                        <td><?= $tar['tar_eventos'] ?></td>
                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="row">
            <h2 class="section-title mb-5">Outras Acomodações</h2>
            <div class="accommodation-slider">

                <?php
                foreach ($chales as $cha) {
                    if ($chale[0]['cha_id'] != $cha['cha_id']) {
                        ?>
                        <div class="item ef-width">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="post">
                                    <div class="post-media">
                                        <img src="<?= $cha['cha_imagem']; ?>" alt="<?= $cha['cha_nome']; ?>" title="<?= $cha['cha_nome']; ?>">
                                        <a href="<?= base_url("chale/" . $cha['cha_id'] . "/" . limpar($cha['cha_nome'])) ?>" class="overlay"><span class="fa fa-search"></span></a>
                                    </div>
                                    <div class="post-body">
                                        <h2><a href="<?= base_url("chale/" . $cha['cha_id'] . "/" . limpar($cha['cha_nome'])) ?>"><?= $cha['cha_nome']; ?></a></h2>
                                        <div class="post-content">
                                            <p data-number-line="3"><?= $cha['cha_resumo']; ?></p>
                                        </div>
                                        <div class="post-footer">
                                            <p class="price">
                                                <?= $cha['cha_diaria']; ?> <span class="small">/ Pernoite</span>
                                            </p>
                                            <a href="<?= base_url("chale/" . $cha['cha_id'] . "/" . limpar($cha['cha_nome'])) ?>" class="btn btn-classic">Ver detalhes <span class="icon-btn-arrow"><span class="inner">&nbsp;</span></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    } else {
                        echo "Não há outras acomodações para mostrar";
                    }
                }
                ?>

            </div>
        </div>
    </div>
</section>