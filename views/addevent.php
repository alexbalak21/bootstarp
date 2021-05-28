<?php
require_once "components/viewsControllers/addEvent_controller.php";
if (!checkConnect()) {
    header("Location : index.php");
}
?>

<main id='main' class="container my-5">
  <h2 class="text-center">Ajouter un evenement:</h2>
  <form
    class="row g-3 needs-validation d-flex justify-content-center"
    name="addEventForm"
    enctype="multipart/form-data"
    action="components/controller.php"
    method="POST"
    novalidate
  >
  <div class="col-12 d-flex justify-content-center">
    <img id="formLogo" class="col-12 mb-4" src="assets/image.svg" alt="image.svg" width="72" height="57" />
  </div>

    <input id="fileUpload" type="file" name="fileToUpload" class="form-control-file" />

    <div class="col-md-6 col-lg-4  py-2 text-center">
      <b><label class="form-label">Nom de l'evenment:</label></b>
      <input type="text" name="eventName" class="form-control" minlength="6" required />
    </div>
    <div class="d-flex justify-content-center">
    <div class="col-md-4 col-lg-2 py-2 text-center">
      <b><label class="form-label">Date:</label></b>
      <input type="date" name="date" class="form-control" min="<?=$today ?>" required />
    </div>
    </div>
    <div class="d-flex justify-content-center">
    <div class="col-md-4 col-lg-2 py-2 text-center">
    <b><label class="form-label">Heure :</label></b>
      <input type="time" name="time" class="form-control" required />
    </div>
    </div>

    <div class="col-md-8 py-2 text-center">
      <b><label class="form-label">Nature de l'evenment:</label></b>
      <select name="category" class="form-select col-12" aria-label="Default select example" required>
        <option selected>Votre choix...</option>
        <option value="SPORT">SPORT</option>
        <option value="LOISIR">LOISIR</option>
        <option value="CULTURE">CULTURE</option>
      </select>
    </div>
    <div class="col-md-8">
   <label for="">Description:</label>
      <textarea name="description" class="form-control" rows="6"></textarea>
    </div>
    <div class="col-md-8 py-2 text-center">
    <b> <label class="form-label">Ville:</label> </b>
      <input type="text" name="city" class="form-control" minlength="3" required />
    </div>
    <div class="col-md-8 py-2 text-center">
    <b> <label class="form-label">Lieu:</label> </b>
      <input type="text" name="place" class="form-control" required="6" required />
    </div>
    <div class="col-md-8 text-center">
      <button class="btn btn-primary btn-lg" type="submit" name="addEvent">Ajouter</button>
    </div>
  </form>
</main>

<script>
document.getElementById('formLogo').addEventListener('click', () => {
  document.getElementById('fileUpload').click()
})
</script>
