<?php
require_once "components/profile_controller.php";
$userID = checkConnect();
if ($userID != 1) {
    header("Location: index.php");
}
?>
<main id='main' class="mt-4 container">
  <div class="row">
    <div class="col-12 row border">
    <h1 class="text-center my-4 col-12">ADMIN</h1>
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
      <div class="py-1 col-12">
        <h2 class="text-center">ACTIONS</h2>
  <table class="table">
  <tr>
        <a class='nav-link' href='?page=usersList'><h3>Table des Utilisateurs</h3></a>
        </tr>
    <tr>
      <a class='nav-link' href='?page=eventList'><h3>Table des Evenments</h3></a>
      </tr>
      <tr>
    <a class='nav-link' href='?page=subsTable'><h3>Table des Inscriptions</h3></a>
    </tr>
    </table>
    </div>
</main>