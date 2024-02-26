<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--    <link rel="apple-touch-icon" sizes="76x76" href="../../assets/img/apple-icon.png">-->
    <link rel="shortcut icon" type="image/png" href="<?= base_url('/favicon.png') ?>">
    <title>CheckPoint - Login</title>

    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet"/>
    <link href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" rel="stylesheet">

    <link href="<?= base_url('assets/css/nucleo-icons.css') ?>" rel="stylesheet"/>
    <link href="<?= base_url('assets/css/black-dashboard.css?v=1.1.1') ?>" rel="stylesheet"/>
    <!--<link href="--><?php //= base_url('assets/demo/demo.css') ?><!--" rel="stylesheet"/>-->
</head>

<body class="login-page">
<nav class="navbar navbar-expand-lg navbar-absolute navbar-white fixed-top">
    <div class="container-fluid">
        <div class="navbar-wrapper">
            <div class="navbar-toggle d-inline">
                <button type="button" class="navbar-toggler">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </button>
            </div>
            <a class="navbar-brand" href="javascript:void(0)">CheckPoint - Controle de Ponto</a>
        </div>
    </div>
</nav>

<div class="wrapper wrapper-full-page ">
    <div class="full-page login-page ">
        <div class="content">
            <?php if (session()->has('validationErrors')) : ?>
                <div class="container pb-0">
                    <div class="col-lg-4 col-md-6 ml-auto mr-auto">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= session()->getFlashdata('validationErrors') ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
