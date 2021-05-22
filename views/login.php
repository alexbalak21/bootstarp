<?php
require_once "components/login_controller.php";
?>
<main class="container d-flex justify-content-center">
<div class="form-signin text-center my-4">
<form class="needs-validation" method="POST" action="components/controller.php" novalidate>
<img class="mb-4" src="assets/person.svg" alt="person"  width="57 " height="57" >
    <h1 class="h3 mb-3 fw-normal">Identifiez Vous</h1>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Adresse email</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Mot de Pass</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1" required>
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Se souvenir de moi.</label>
  </div>
  <h5 class="text-danger"><?=$error ?></h5>
  <br>
  <button class="w-100 btn btn-lg btn-primary mb-5" name="login" type="submit">Sign in</button>
</form>
</div>
</main>
