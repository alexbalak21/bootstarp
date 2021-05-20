<main class="container my-5">
  <h2>S'inscrire:</h2>
  <form class="row g-3 needs-validation" novalidate>
  <img class="col-12 mb-4" src="assets/person-plus.svg" alt="person LOGO" width="72" height="57">

    <div class="col-md-6">
      <label class="form-label">Vote Pseudo:</label>
      <input type="text" name="username" class="form-control" required />
    </div>
    <div class="col-md-6">
      <label class="form-label">Vote Pseudo:</label>
      <input type="text" name="username" class="form-control" required />
    </div>
    <div class="col-md-6">
      <label class="form-label">Adresse E-mail:</label>
      <input type="email" class="form-control" aria-describedby="inputGroupPrepend" required />
    </div>

      <div class="col-md-6">
        <label class="form-label">Entrèez un mot de pass:</label>
        <input type="password" name="password2  " class="form-control" required />
      </div>
    <div class="col-md-6"></div>
      <div class="col-md-6 mb-3">
        <label class="form-label">Confirmez le Mot de pass:</label>
        <input type="password" name="password2" class="form-control" aria-describedby="inputGroupPrepend" required />
      </div>

    <div class="col-12">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required />
        <label class="form-check-label" for="invalidCheck"> J'accepte les conditions d'utilisation.</label><br><br>
      </div>
    </div>
    <div class="col-md-12 text-center">
      <button class="btn btn-primary" type="submit">Inscription</button>
    </div>
  </form>
</main>
