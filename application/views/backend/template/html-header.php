<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?= $title; if(isset($subtitle)){ echo " - ". $subtitle;}?></title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="<?= base_url("assets/backend/components/bootstrap/dist/css/bootstrap.min.css")?>">
        <link rel="stylesheet" href="<?= base_url("assets/backend/components/font-awesome/css/font-awesome.min.css")?>">
        <link rel="stylesheet" href="<?= base_url("assets/backend/components/Ionicons/css/ionicons.min.css")?>">
        <link rel="stylesheet" href="<?= base_url("assets/backend/css/AdminLTE.min.css")?>">
        <link rel="stylesheet" href="<?= base_url("assets/backend/css/style.css")?>">
        <link rel="stylesheet" href="<?= base_url("assets/backend/css/skins/_all-skins.min.css")?>">
        <link rel="stylesheet" href="<?= base_url("assets/backend/components/datatables.net-bs/css/dataTables.bootstrap.min.css")?>">
        <link rel="stylesheet" href="<?= base_url("assets/backend/components/select2/dist/css/select2.min.css")?>">
        <link rel="stylesheet" href="<?= base_url("assets/backend/components/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css")?>">
        <link rel="stylesheet" href="<?= base_url("assets/backend/components/bootstrap-fileupload/bootstrap-fileupload.css")?>">
        <link rel="stylesheet" href="<?= base_url("assets/backend/components/dropzone/basic.min.css")?>">
        <link rel="stylesheet" href="<?= base_url("assets/backend/components/dropzone/dropzone.min.css")?>">
        <link rel="stylesheet" href="<?= base_url("assets/backend/components/remodal/dist/remodal.css")?>">
        <link rel="stylesheet" href="<?= base_url("assets/backend/components/remodal/dist/remodal-default-theme.css")?>">
        <script src="<?= base_url("assets/backend/components/jquery/dist/jquery.min.js") ?>"></script>
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="hold-transition skin-blue fixed sidebar-mini">
        <div class="wrapper">