<div class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Controle de Ponto</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <ul class="nav nav-pills nav-pills-success flex-column">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#link4">
                                        Marcação de Ponto
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#link5">
                                        Histórico de Registro
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-8">
                            <div class="tab-content">
                                <div class="tab-pane active" id="link4">
                                    <div class="mb-4">
                                        <span>
                                            Registre seu ponto clicando no botão abaixo
                                        </span>
                                    </div>
                                    <form class="form-checkpoint" action="<?= base_url('app/registerCheckpoint') ?>" method="post">
                                        <button class="btn btn-success animation-on-hover btn-block btn-submit" type="submit">
                                            <div class="row ">
                                                <div class="col-5 pr-3">
                                                    <i class="fas fa-fingerprint fa-fw fa-3x pull-right"></i>
                                                </div>
                                                <div class="col-7 pl-0 pb-1">
                                                    <span class="pull-left pt-2">Clique aqui para marcar seu ponto</span>
                                                </div>
                                            </div>
                                        </button>
                                    </form>
                                </div>
                                <div class="tab-pane" id="link5">
                                    <div class="mb-4">
                                        <span>
                                            Histórico de registro com as marcações de ponto do colaborador
                                        </span>
                                    </div>
                                    <div class="card-header">
                                        <div class="tools float-right">
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-default dropdown-toggle btn-link btn-icon" data-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-cog fa-fw"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-133px, 22px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                    <a class="dropdown-item" href="#">Filtros</a>
                                                </div>
                                            </div>
                                        </div>
                                        <h4 class="card-title">Suas Marcações de Ponto</h4>
                                    </div>
                                    <div class="table-responsive ps">
                                        <table class="table">
                                            <thead class="text-primary">
                                            <tr>
                                                <th>
                                                    Data/Hora
                                                </th>
                                                <th>
                                                    Tipo Ponto
                                                </th>
                                                <th>
                                                    Descrição
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php if ($checkpointsList) :
                                                foreach ($checkpointsList as $checkpoint) : ?>
                                                    <tr>
                                                        <td>
                                                            <?= date(('d/m/y H:i:s'), strtotime($checkpoint->checkpoint_time)) ?>
                                                        </td>
                                                        <td>
                                                            <?= $checkpoint->label ?>
                                                        </td>
                                                        <td>
                                                            <?= $checkpoint->description ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach;
                                            else: ?>
                                                <tr>
                                                    <td colspan="3">
                                                        Nenhum registro encontrado
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                            </tbody>
                                        </table>
                                        <!--</div>-->
                                        <!--<div class="ps__rail-x" style="left: 0px; bottom: 0px;">-->
                                        <!--    <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>-->
                                        <!--</div>-->
                                        <!--<div class="ps__rail-y" style="top: 0px; right: 0px;">-->
                                        <!--    <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
