<main class="container my-5">
  <h2>S'inscrire:</h2>
  <form class="row g-3 needs-validation" action="components/controller.php" method="POST" novalidate>
  <img class="col-12 mb-4" src="assets/person-plus.svg" alt="person LOGO" width="72" height="57">

    <input type="file" name="fileUpload" class="form-control-file">

    <div class="col-md-6">
      <label class="form-label">Vote Prènom:</label>
      <input type="text" name="firstname" class="form-control" required />
    </div>
    <div class="col-md-6">
      <label class="form-label">Vote Nom:</label>
      <input type="text" name="lastname" class="form-control" required />
    </div>
    <div class="col-md-6">
      <label class="form-label">Adresse E-mail:</label>
      <input type="email" name="email" class="form-control" required />
    </div>

      <div class="col-md-6">
        <label class="form-label">Entrèez un mot de pass:</label>
        <input type="password" name="password1" class="form-control" required />
      </div>
    <div class="col-md-6"></div>
      <div class="col-md-6 mb-3">
        <label class="form-label">Confirmez le Mot de pass:</label>
        <input type="password" name="password2" class="form-control"required />
      </div>

    <div class="col-12">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required />
        <label class="form-check-label" for="invalidCheck"> J'accepte les conditions d'utilisation.</label><br><br>
      </div>
    </div>
    <div class="col-md-12 text-center">
      <button class="btn btn-primary" type="submit" name="register">Inscription</button>
    </div>
  </form>
</main>
