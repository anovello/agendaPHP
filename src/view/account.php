<?php
    include_once('header.php'); 
?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">   
    <div class="container">       
        <form>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Email" disabled>
                </div>
                <div class="form-group col-md-6">
                    <label for="name">Nome</label>
                    <input type="text" class="form-control" id="name" placeholder="Nome">
                </div>

                <div class="form-group col-md-6">
                    <label for="password">Senha</label>
                    <input type="password" class="form-control" id="password" placeholder="Senha">
                </div>
                <div class="form-group col-md-6">
                    <label for="conf-password">Conf Senha</label>
                    <input type="password" class="form-control" id="conf-password" placeholder="Conf Senha">
                </div>
            </div>
            
            <button type="button" class="btn btn-primary" id="save">Alterar</button>
        </form>
    </div>
</main>
  

<?php include_once('footer.php'); ?>