<div class="container">
    <div class="col-lg-4 col-md-6 ml-auto mr-auto">
        <form id="form-login" class="form form-login" method="post" action="<?= base_url('users/checkLogin') ?>">
            <div class="card card-login card-white">
                <div class="card-header">
                    <img src="<?= base_url('assets/img/card-success.png') ?>" style="height: 39%;">
                    <h1 class="card-title text-default">Acesse sua conta</h1>
                </div>
                <div class="card-body">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-at fa-fw"></i>
                            </div>
                        </div>
                        <input type="text" name="email" class="form-control" placeholder="Email" autocomplete="on">
                    </div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-lock fa-fw"></i>
                            </div>
                        </div>
                        <input type="password" name="password" placeholder="Senha" class="form-control">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success btn-lg btn-block mb-3 btn-login">Acessar</button>
                    <div class="text-center">
                        <span class="small text-default twelve-px">
                            Não possui uma conta? <a href="<?= base_url('users/register') ?>" class="text-info">Cadastre-se.</a>
                        </span>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

