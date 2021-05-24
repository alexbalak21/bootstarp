<?php
require_once "components/user_controller.php";
?>
<main id='main' class="mt-4 container">
  <div class="row">
    <div class="col-12 row border">
    <h1 class="text-center my-4 col-12">Utilisatuer</h1>
    <div class="col-md-3">
      <a href="#!"><img class="card-img-top" src="public/uploads/<?=$user['img'] ?>" alt="..." /></a>
    </div>
    <div class="col-md-9 text-center py-5">
      <h2><?=$user['firstname'] ?></h2>
      <br />
      <h2><?=$user['lastname'] ?></h2>
      <br />
      <h2><?=$user['email'] ?></h2>
      <br />
    </div>
    </div>
    <div class="col-12 row text-center">
    <div class="my-5">
      <div class="py-3 row ">
        <h2 class="px-4 col-lg-4">Activitées organisées:</h2>
        <a class="col-lg-2" href="?page=eventsTable&userID=<?=$userID ?>"><h2><?=$MyEvents ?></h2>
        <div class="col-lg-2">
        </div>
      </div>
      </div>
      </div>
    </div>
</main>