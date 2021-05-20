<main class="container my-5">
  <h2 class="text-center">Ajouter un evenement:</h2>
  <form class="row g-3 needs-validation" name="addEventForm" action="components/controller.php" method="POST" novalidate>
  <img class="col-12 mb-4" src="assets/calendar2-event.svg" alt="person LOGO" width="72" height="57">

    <input type="file" name="fileUpload" class="form-control-file">

    <div class="col-md-8 py-2 text-center">
      <label class="form-label ">Nom de l'evenment:</label>
      <input type="text" name="eventName" class="form-control" required />
    </div>
    <div class="col-md-8 py-2 text-center">
      <label class="form-label ">Date et Heure:</label>
      <input type="datetime-local" name="startTime" class="form-control" required />
    </div>

    <div class="col-md-8 py-2 text-center">
      <label class="form-label ">Nature de l'evenment:</label><br>
      <select name='category' class="form-select col-12" aria-label="Default select example" required>
  <option selected>Votre choix...</option>
  <option value="SPORT">SPORT</option>
  <option value="LOISIR">LOISIR</option>
  <option value="CULTURE">CULTURE</option>
</select>
    </div>
    <div class="col-md-8">
    <label for="">Description:</label>
    <textarea name="description" class="form-control"rows="6"></textarea>
    </div>
    <div class="col-md-8 py-2 text-center">
      <label class="form-label ">Ville:</label>
      <input type="text" name="city" class="form-control" required />
    </div>
    <div class="col-md-8 py-2 text-center">
      <label class="form-label ">Lieu Exacte:</label>
      <input type="text" name="place" class="form-control" required />
    </div>
    <div class="col-md-8 text-center">
    <button class="btn btn-primary btn-lg" type="submit" name="addEvent">Ajouter</button>
    </div>
  </form>
</main>
