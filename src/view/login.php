<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Agenda</title>

    <!-- Bootstrap core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link href="<?php echo BASE_URL ?>public/assets/css/login.css" rel="stylesheet">
  </head>

  <body>
    <form class="form-signin">
      <div class="text-center mb-4">
      
        <i class="fa fa-address-book logo"></i>
        <h1 class="h3 mb-3 font-weight-normal">Agenda</h1>
      </div>

      <div class="form-label-group">
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputEmail">Email</label>
      </div>

      <div class="form-label-group">
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <label for="inputPassword">Senha</label>
      </div>

      <button class="btn btn-lg btn-primary btn-block" type="button" id="entrar">Entrar</button>

      <div class="checkbox mb-3">
        <label>
            
            <a href="#modalCadastro" data-toggle="modal" data-target="#modalCadastro" id="create">
            Criar Conta
            </a>
            
        </label>
      
      </div>

    </form>

    <!-- Modal -->
    <div class="modal fade" id="modalCadastro" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">Cadastro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>

                <div class="modal-body">
                    <form>

                        <div class="form-group">
                            <label for="name-create">Nome</label>
                            <input type="text" class="form-control modal-create" id="name-create" placeholder="Nome">
                            
                            <small class="form-text error-cad name-cad-req">Campo Obrigatório.</small>
                        </div>

                        <div class="form-group">
                            <label for="email-create">Email</label>
                            <input type="email" class="form-control modal-create" id="email-create" placeholder="E-mail">
                            
                            <small class="form-text error-cad email-cad-req">Campo Obrigatório.</small>
                            <small class="form-text error-cad email-cad-inv">E-mail inválido.</small>
                            <small class="form-text error-cad email-cad-cad">E-mail já cadastrado.</small>
                        </div>

                        <div class="form-group">
                            <label for="password-create">Senha</label>
                            <input type="password" class="form-control modal-create" id="password-create" placeholder="Senha">
                            <small class="form-text error-cad password-cad-req">Campo Obrigatório.</small>
                        </div>

                        <div class="form-group">
                            <label for="conf-senha">Conf. Senha</label>
                            <input type="password" class="form-control modal-create" id="conf-senha" placeholder="Confirmar Senha">
                            <small class="form-text error-cad pass-conf-req">Campo Obrigatório.</small>
                            <small class="form-text error-cad pass-conf-dif">Senha e confirmar senha diferente.</small>
                        </div>

                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="save">Salvar</button>
                </div>
            </div>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.1.1.min.js" crossorigin="anonymous"></script>

    <script>
        var url = "<?php echo BASE_URL ?>";
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.15.1/sweetalert2.all.js" integrity="sha256-NlHeNEXmgM59zSDcFwf3OphwpeatLuiFJ4utVbzowqk=" crossorigin="anonymous"></script>
    <script src="<?php echo BASE_URL.'public/assets/js/login.js'?>"></script>
  </body>
</html>
