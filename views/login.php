<main class="container d-flex justify-content-center">
<div class="form-signin text-center my-3">
<form class="needs-validation" method="POST" action="components/controller.php" novalidate>
    <img class="mb-4" src="assets/person.svg" alt="person LOGO" width="72" height="57">
    <h1 class="h3 mb-3 fw-normal">Identifiez Vous</h1>

    <div class="form-floating">
      <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
      <label for="floatingInput">Adresse e-mail</label>
    </div>
    <div class="form-floating">
      <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password" required>
      <label for="floatingPassword">Mot de Pass</label>
    </div>

    <div class="checkbox mb-3">
      <label>
        <input type="checkbox" value="remember-me"> Se souvenir de moi.
      </label>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p>
  </form>
</div>
</main>
