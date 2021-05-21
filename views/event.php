<?php
require_once "components/event_controller.php";
?>
<main class="py-5 container">
  <div class="row">
    <h2 class="p-3"><?=$name ?></h2>
    <h3 class="p-3 d-flex ml-auto"><?="$frDate à $time" ?></h3>
  </div>
  <div class="row text-center">
    <img class="card-img-top col-md-5" src="<?="public/uploads/", $event['img'] ?>" alt="" />
    <div class="col-md-7">
      <h3 class="py-3">Organisateur:<a href=""><?="$firstname $lastname" ?></a></h3>
      <h3 class="py-3">Publié le : <?="$postDate" ?> </h3>
      <h3 class="py-3">Participants : <a href=""><?=$event['subscribed'] ?></a></h3>
      <form name="subscribe" action="components/router.php" method="POST">
      <?=$button ?>
      <input  type="hidden" name="eventID" value=<?="$eventID" ?>>
      </form>

    </div>
  </div>
</main>
<!-- <button type="button" class="btn btn-primary btn-lg">Participer</button>
<button type="submit" name="unsubscribe" value="10" class="btn btn-secondary btn-lg">Se desiscrire </button>


