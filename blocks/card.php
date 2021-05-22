<?php
$button = "";
if (isset($_COOKIE['userID'])) {
    $userID = $_COOKIE['userID'];
    $check = checkUserInEvent($eventID, $userID);
//-----------------------------AFFICHE BOUTON PARTICIPER / SE DESINSCRIRE
    if ($check) {
        $button = "<a href='index.php?unsub=$userID&eventID=$eventID'><button type='submit' class='m-4 position-absolute bottom-0 end-0 btn btn-secondary btn'>Se desinscrire</button></a>
        ";
    } else {
        $button = "<a href='index.php?sub=$userID&eventID=$eventID'><button type='submit' class='m-4 position-absolute bottom-0 end-0 btn btn-primary btn'>Participer</button></a>
        ";
    }
    if ($creatorID == $userID) {
        $button = "<a href='index.php?page=updateEvent&id=$eventID'><button type='submit' class='m-4 position-absolute bottom-0 end-0 btn btn-success btn'>Gerer l'evenement</button></a>";
    }

}

?>

<div class="col-lg-4 col-md-6 mb-4">
  <div class="card h-100">
    <a href="?page=event&id=<?=$eventID ?>"><img class="card-img-top" src="public/uploads/<?=$img ?>" alt="<?=$img ?>"></a>
    <div class="card-body">
    <h3><?=$name ?></h3>
    <h3><?=$date ?></h3>
    <h3><?=$event['city'] ?></h3>
      <p class="card-text card-desc"><?=$event['description'] ?></p>
      <div class="position-realative">
      <button type="button" class="m-4 position-absolute bottom-0 start-0 btn btn-primary">Voir les details</button>
      <?=$button ?>
      </div>
    </div>
  </div>
</div>



