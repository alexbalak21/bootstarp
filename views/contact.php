<?php
require_once "components/login_controller.php";
?>
<main id="message" class="container d-flex justify-content-center">
  <div class="form-signin text-center col-sm-12 col-md-8 col-lg-6 my-4">
    <form class="needs-validation" method="POST" action="components/controller.php" novalidate>
      <img class="mb-4" src="assets/chat-left-dots.svg" alt="person" width="57 " height="57" />
      <h1 class="h3 mb-4 fw-normal">Cantactez nous</h1>

      <div class="container d-flex justify-content-center">
      <div class="text-center my-3 col-lg-8 col-sm-12">
        <label for="exampleInputEmail1" class="form-label">Votre Nom</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required />
      </div>
      </div>

      <div class="container d-flex justify-content-center">
      <div class="py-3 col-lg-8 col-sm-12">
        <label for="exampleInputEmail1" class="form-label">Votre e-mail</label>
        <input type="text" class="form-control col" id="exampleInputEmail1" aria-describedby="emailHelp" required />
      </div>
      </div>

      <div class="container d-flex justify-content-center">
      <div class="pt-5 col-sm-12 col-md-12   col-lg-8">
        <label for="exampleInputEmail1" class="form-label">Sujet de votre message</label>
        <input type="text" class="form-control col" id="exampleInputEmail1" aria-describedby="emailHelp" required />
      </div>
      </div>

      <div class="container d-flex justify-content-center">
      <div class="form-group m-4 col-12">
        <label class ="py-3" for="exampleFormControlTextarea1" >Votre message</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="10"></textarea>
      </div>
  </div>
      <h5 class="text-danger"><?=$error ?></h5>
      <br />
      <button class="col-sm-9 col-md-6 btn btn-lg btn-primary mb-5" name="login" type="submit">Envoyer</button>
    </form>
  </div>
</main>
