<?php
if (isset($_COOKIE['user'])) {
    $USER = json_decode($_COOKIE['user'], true);
    require_once "blocks/deleteUserModal.php";
} else {
    header("Location: index.php");
}
?>


<main class="container my-5">
  <h2>Mettre à Jour son profil:</h2>
  <form class="row g-3 needs-validation" enctype="multipart/form-data" action="components/controller.php" method="POST" novalidate>
  <div class="col-12">
  <img id="formLogo" class="mb-4" src="public/uploads/<?=$USER['img'] ?>" alt="person LOGO">
  </div>
    <input type="file" name="fileToUpload" id="fileUpload" class="form-control-file">

    <div class="col-md-6">
      <label class="form-label">Vote Prènom:</label>
      <input type="text" name="firstname" class="form-control" value="<?=$USER['firstname'] ?>" required />
    </div>
    <div class="col-md-6">
      <label class="form-label">Vote Nom:</label>
      <input type="text" name="lastname" class="form-control" value="<?=$USER['lastname'] ?>" required />
    </div>
    <div class="col-md-6">
      <label class="form-label">Adresse E-mail:</label>
      <input type="email" name="email" class="form-control" value="<?=$USER['email'] ?>" required />
    </div>

      <div class="col-md-6">
        <label class="form-label">Entrèez un mot de pass:</label>
        <input type="password" name="password1" class="form-control"/>
      </div>
    <div class="col-md-6"></div>
      <div class="col-md-6 mb-3">
        <label class="form-label">Confirmez le Mot de pass:</label>
        <input type="password" name="password2" class="form-control"/>
      </div>
    <div class="col-12 d-flex justify-content-end">
      <button class="btn-lg btn-primary" type="submit" name="updateUser">Mettre à Jour</button>
    </div>
  </form>

<button class="btn btn-danger" data-bs-toggle='modal' data-bs-target="#deleteUserModal">Suprimer</button>


</main>


<script>
document.getElementById('formLogo').addEventListener('click', () => {
  document.getElementById('fileUpload').click()
})

</script>
