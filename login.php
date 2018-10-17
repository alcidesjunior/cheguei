<?php require_once('_config/conf.php'); ?>

<?php require_once(HEADER); ?>

  <div id="login-page">

    <!-- Page Content -->
  <header>
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center mt-5">
          <img class="img-fluid rounded-circle" src="assets/imgs/logo.png"/>
          <h2>Cheguei! Web App</h2>
          <p class="lead">Painel Administrativo</p>
        </div>
      </div>
    </div>
  </header>

   <section>      
          <div class="login-box col-lg-4 mx-auto text-center">
          	<form>
	            <div class="form-group">
	              <label for="login">Login</label>
	              <input type="email" class="form-control" id="login" aria-describedby="emailHelp" placeholder="Login">
	            </div>
	            <div class="form-group">
	              <label for="senha">Senha</label>
	              <input type="password" class="form-control" id="senha" placeholder="Senha">
	            </div>
	            <button type="submit" class="btn btn-primary">Fazer Login</button>
          	</form>
          </div>   
  </section>

<?php require_once(FOOTER); ?>

</div>