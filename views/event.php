<?php
require_once "components/viewsControllers/event_controller.php";
?>
<main id='main' class="py-5 container">
  <div class="row">
    <h2 class="p-3 col-6"><?=$name ?></h2>
    <h4 class="p-3 col-6 text-end"><?="$frDate à $time" ?></h4>
  </div>
  <div class="row">
  <div class="col-lg-5">
  <img class="card-img-top" src="<?="public/uploads/", $event['img'] ?>" alt="" />
  </div>
  <div class="col-lg-7">
  <div class="row">
  <div class='col-6 py<i class="fas fa-wifi-2    "></i>'>
      <h3>Organisateur:</h3> <br>
      <h3 class="text-end"><a href="<?=$link ?>"><?="$names" ?></a></h3>
  </div>
      <h4 class="col-6 text-end py-2">Publié le : <?="$postDate" ?> </h4>
         <h3 class="ms-2 py-4">Participants: <a href="?page=lestEventUsers&eventID=<?=$eventID ?>"><?=$count ?></a></h3>
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




