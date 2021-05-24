<?php
require_once "components/event_controller.php";
?>
<main class="py-5 container">
  <div class="row">
    <h2 class="p-3 col-6"><?=$name ?></h2>
    <h3 class="p-3 col-6 text-end"><?="$frDate à $time" ?></h3>
  </div>
  <div class="row">
  <div class="col-lg-5">
  <img class="card-img-top" src="<?="public/uploads/", $event['img'] ?>" alt="" />
  </div>
  <div class="col-lg-7">
  <div class="row">
      <h3 class="col-6 py-2">Organisateur:<a href="<?=$link ?>"><?="$names" ?></a></h3>
      <h4 class="col-6 text-end py-2">Publié le : <?="$postDate" ?> </h4>
         <h3 class="ms-2 py-4">Participants: <a href="?page=lestEventUsers&eventID=<?=$eventID ?>"><?=$event['subscribed'] ?></a></h3>
         <div class="col-12">
    <h4 class="text-start">Description:</h4>
      <p class="py3">
      <?=$event['description'] ?>
      </p>
    </div>

  </div>

      <form name="subscribe" action="components/controller.php" method="POST">
      <?=$button ?>
      <input  type="hidden" name="eventID" value=<?="$eventID" ?>>

      </form>
    </div>


  </div>
</main>




