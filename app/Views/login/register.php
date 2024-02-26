<div class="container">
    <div class="col-lg-7 col-md-6 ml-auto mr-auto">
        <div class="card card-login card-white">
            <div class="card-header">
                <img src="<?= base_url('assets/img/card-success.png') ?>" style="height: 39%;">
                <h1 class="card-title text-default">Crie sua conta</h1>
            </div>
            <form id="form-register" class="form form-login" method="post" action="<?= base_url('users/store') ?>">
                <div class="card-body mt-0 pt-0">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-user fa-fw"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="name" placeholder="Nome e Sobrenome *">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-id-card fa-fw"></i>
                                    </div>
                                </div>
                                <input type="tel" class="form-control cpf" name="cpf" placeholder="CPF">
                            </div>
                        </div>
                    </div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-at fa-fw"></i>
                            </div>
                        </div>
                        <input type="text" name="email" class="form-control" placeholder="Email *">
                    </div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-lock fa-fw"></i>
                            </div>
                        </div>
                        <input type="password" class="form-control" name="password" placeholder="Senha *">
                    </div>
                </div>
                <div class="card-footer mt-0 pt-0">
                    <button type="submit" class="btn btn-success btn-round btn-lg btn-login">Cadastrar</button>
                    <label class="text-default form-check-label ml-2 mt-3 twelve-px">
                        Já possui uma conta?
                        <a href="<?= base_url('app/login') ?>" class="text-info">Acesse.</a>
                    </label>
                </div>
            </form>
        </div>
    </div>
</div>
