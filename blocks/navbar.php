<?php

$register = "<li class='nav-item'><a class='nav-link' href='?page=signin'>Inscription</a></li>";
$events = "<li class='nav-item'><a class='nav-link' href='?page=events'>Evenments</a></li>";
$connect = "<li class='nav-item'><a class='nav-link' href='?page=login'>Connecter</a></li>";
$eventTab = "<li class='nav-item'><a class='nav-link' href='?page=eventsTable'>EVENT TABLE</a></li>";

$userId = checkConnect();

$addEvent = " <li class='nav-item'><a class='nav-link' href='?page=addevent'>Ajouter Evenment</a></li>";
$logout = "<li class='nav-item'><a class='nav-link' href='?logout'>Deconnection</a></li>";
$account = "<li class='nav-item'><a class='nav-link' href='?page=profile'>Votre Compte</a></li>";
$contact = "<li class='nav-item'><a class='nav-link' href='?page=contact'>Contact</a></li>";

$link1 = $events;
$link2 = $register;
$link3 = $contact;
$link4 = $connect;
$link5 = "";
$link6 = "";

?>

<nav class="navbar navbar-expand-lg bg-dark navbar-dark fixed-top py-2" id="mainNav">
      <div class="container-fluid px-3 px-lg-5">
        <a class="navbar-brand" href="#page-top">EventBright</a>
        <button
          class="navbar-toggler navbar-toggler-right"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarResponsive"
          aria-controls="navbarResponsive"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ms-auto my-2 my-lg-0">
            <?=$link1 ?>
            <?=$link2 ?>
            <?=$link3 ?>
            <?=$link4 ?>
            <?=$link5 ?>

          </ul>
        </div>
      </div>
    </nav>
