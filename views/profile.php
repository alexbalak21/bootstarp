<?php
if (isset($_COOKIE['user'])) {
    $USER = json_decode($_COOKIE['user'], true);
} else {
    header("Location: index.php");
}
?>
<main class="mt-4 container">
  <div class="row">
    <div class="col-12 row border">
    <h1 class="text-center my-4 col-12">Profile</h1>
    <div class="col-md-4">
      <a href="#!"><img class="card-img-top" src="public/uploads/<?=$USER['img'] ?>" alt="..." /></a>
    </div>
    <div class="col-md-8 text-center py-5">
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
    <div class="my-5 mx-auto">
      <div class="py-3 row">
        <h2 class="px-4">Vos activitées à venir: 12</h2>
        <button type="button" class="btn-lg btn-primary">Voir</button>
      </div>
      <div class="py-3 row">
        <h2 class="px-4">Participations à venir: 19</h2>
        <button type="button" class="btn-lg btn-primary">Voir</button>
      </div>
      </div>
    </div>
</main>
