<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--    <link rel="apple-touch-icon" sizes="76x76" href="../../assets/img/apple-icon.png">-->
    <link rel="shortcut icon" type="image/png" href="<?= base_url('/favicon.png') ?>">
    <title>Controle de Ponto - Login</title>

    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet"/>
    <link href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" rel="stylesheet">

    <link href="<?= base_url('assets/css/nucleo-icons.css') ?>" rel="stylesheet"/>
    <link href="<?= base_url('assets/css/black-dashboard.css?v=1.1.1') ?>" rel="stylesheet"/>
    <!--<link href="--><?php //= base_url('assets/demo/demo.css') ?><!--" rel="stylesheet"/>-->
</head>

<body>
<div class="wrapper">
    <div class="navbar-minimize-fixed">
        <button class="minimize-sidebar btn btn-link btn-just-icon">
            <i class="fas fa-ellipsis-v fa-lg visible-on-sidebar-regular text-muted"></i>
            <i class="fas fa-bars fa-lg visible-on-sidebar-mini text-muted"></i>
        </button>
    </div>
    <div class="sidebar">
        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="javascript:" class="simple-text logo-mini" style="cursor:unset">
                </a>
                <a href="javascript:" class="simple-text logo-normal" style="cursor:unset">
                    Controle de Ponto
                </a>
            </div>
            <ul class="nav">
                <li class="active">
                    <a href="<?= base_url('app/home') ?>">
                        <i class="fas fa-home fa-fw"></i>
                        <p>Painel Inicial</p>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('app/logoff') ?>">
                        <i class="fas fa-power-off fa-fw"></i>
                        <p>Sair do Sistema</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="main-panel">
        <nav class="navbar navbar-expand-lg navbar-absolute navbar-transparent">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <div class="navbar-minimize d-inline">
                        <button class="minimize-sidebar btn btn-link btn-just-icon" rel="tooltip" data-original-title="" data-placement="right">
                            <i class="fas fa-bars fa-2x visible-on-sidebar-regular text-muted"></i>
                            <i class="fas fa-ellipsis-v fa-2x visible-on-sidebar-mini text-muted"></i>
                        </button>
                    </div>
                    <div class="navbar-toggle d-inline">
                        <button type="button" class="navbar-toggler">
                            <span class="navbar-toggler-bar bar1"></span>
                            <span class="navbar-toggler-bar bar2"></span>
                            <span class="navbar-toggler-bar bar3"></span>
                        </button>
                    </div>
                    <a class="navbar-brand">CheckPoint</a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                </button>
                <div class="collapse navbar-collapse" id="navigation">
                    <ul class="navbar-nav ml-auto">
                        <li class="dropdown nav-item">
                            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                                <span class="mr-2"><?= $userName ?? null ?></span>
                                <div class="photo">
                                    <img src="<?= base_url('assets/img/avatar.png') ?>" alt="Profile Photo">
                                </div>
                                <b class="caret d-none d-lg-block d-xl-block"></b>
                            </a>
                            <ul class="dropdown-menu dropdown-navbar">
                                <li class="dropdown-divider"></li>
                                <li class="nav-link">
                                    <a href="<?= base_url('app/logoff') ?>" class="nav-item dropdown-item">Sair</a>
                                </li>
                            </ul>
                        </li>
                        <li class="separator d-lg-none"></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="modal modal-search fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="SEARCH">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="tim-icons icon-simple-remove"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

