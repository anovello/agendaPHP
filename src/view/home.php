<?php 
  $type = 'home';
  include_once('header.php'); 
?>

  <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">          
    <div class="table-responsive">

      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
        <h1 class="h2">Dashboard Agenda</h1>

        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
            <button class="btn btn-sm btn-outline-success" id="add"><span data-feather="plus"></span></button>
          </div>
        </div>
      </div>
      
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th>#</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Telefone</th>
            <th></th>
          </tr>
        </thead>
        <tbody class="tbody"></tbody>
      </table>

      <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
          <li class="page-item prev" data-ty="prev">
            <a class="page-link" href="#">Anterior</a>
          </li>
          <li class="page-item next" data-ty="next">
            <a class="page-link" href="#">Próximo</a>
          </li>
        </ul>
      </nav>
    </div>
  </main>

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

            <input type="hidden" id="id" value="0">

            <div class="form-group">
              <label for="name-create">Nome</label>
              <input type="text" class="form-control is-invalid" id="name" placeholder="Nome">
              
              <div class="invalid-feedback">
                Campo Obrigatório.
              </div>
              
            </div>

            <div class="form-group">
              <label for="email-create">Email</label>
              <input type="email" class="form-control modal-create" id="email" placeholder="E-mail">

              <div class="invalid-feedback">
                Campo Obrigatório ou e-mail inválido.
              </div>
              
              <small class="form-text error-cad email-cad">E-mail já cadastrado.</small>
            </div>

            <div class="form-group">
                <label for="password-create">Telefone</label>
                <input type="text" class="form-control modal-create" id="phone" placeholder="Telefone">

                <div class="invalid-feedback">
                  Campo Obrigatório ou telefone inválido.
                </div>
            </div>

          </form>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="save">Salvar</button>
        </div>
      </div>
    </div>
  </div>

<?php include_once('footer.php'); ?>