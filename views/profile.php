<?php
require_once "components/profile_controller.php";
?>
<main id='main' class="mt-4 container">
  <div class="row">
    <div class="col-12 row border">
    <h1 class="text-center my-4 col-12">Votre Compte</h1>
    <div class="col-md-3">
      <a href="#!"><img class="card-img-top" src="public/uploads/<?=$USER['img'] ?>" alt="..." /></a>
    </div>
    <div class="col-md-9 text-center py-5">
      <h2><?=$USER['firstname'] ?></h2>
      <br />
      <h2><?=$USER['lastname'] ?></h2>
      <br />
      <h2><?=$USER['email'] ?></h2>
      <br />
    <div>
    <a href="?page=updateProfile"><button class="btn btn-lg btn-primary" type="submit">Modifer</button></a>
    </div>
    </div>
    </div>
    <div class="col-12 row text-center">
    <div class="my-5">
      <div class="py-3 row ">
        <h2 class="px-4 col-lg-5">Vos activitées à venir:</h2>
        <a class="col-lg-2" href="?page=eventsTable&userID=<?=$userID ?>"><h2><?=$MyEvents ?></h2>
        <div class="col-lg-2">
        <a class="col-lg-2" href="?page=eventsTable&userID=<?=$userID ?>"><button type="button" class="btn-lg btn-primary">Voir</button></a>
        </div>
      </div>
      <div class="py-3 row ">
        <h2 class="px-4 col-lg-5">Vos activitées à participées:</h2>
        <a class="col-lg-2" href="index.php?page=userSubEvntsTable&id=<?=$userID ?>"><h2><?=$participatingEvents ?></h2></a>
        <div class="col-lg-2">
        <a class="col-lg-2" href="index.php?page=userSubEvntsTable&id=<?=$userID ?>"><button type="button" class="btn-lg btn-primary">Voir</button></a>
        <div class="col-lg-2">
        </div>
      </div>
      </div>
      </div>
    </div>
</main>