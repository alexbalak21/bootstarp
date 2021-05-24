<?php
require_once "components/login_controller.php";
?>
<main id='main' class="container d-flex justify-content-center">
  <div class="form-signin text-center col-sm-8 col-md-6 col-lg-3 my-4">
    <form class="needs-validation" method="POST" action="components/controller.php" novalidate>
      <img class="mb-4" src="assets/person.svg" alt="person" width="57 " height="57" />
      <h1 class="h3 mb-4 fw-normal">Identifiez Vous</h1>

      <div class="mb-3">
      <b>  <label for="exampleInputEmail1" class="form-label">Adresse email</label> </b>
        <input
          type="email"
          name="email"
          class="form-control col"
          id="exampleInputEmail1"
          aria-describedby="emailHelp"
          required
        />
      </div>

      <div class="mb-3">
      <b>  <label for="exampleInputPassword1" class="form-label">Mot de Pass</label> </b>
        <input type="password" name="password" class="form-control" id="exampleInputPassword1"  minlength="8" required />
      </div>

      <div class="d-flex justify-content-center mb-3 col-12 form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1" />
        <label class="form-check-label px-3" for="exampleCheck1">Se souvenir de moi.</label>
      </div>

      <h5 class="text-danger"><?=$error ?></h5>
      <br />
      <button class="col-sm-9 col-md-6 btn btn-lg btn-primary mb-5" name="login" type="submit">S'identifier</button>
    </form>
  </div>
</main>
