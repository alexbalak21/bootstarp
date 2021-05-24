<?php
$userID = checkConnect();
$register = "<li class='nav-item'><a class='nav-link' href='?page=signin#main'>Inscription</a></li>";
$events = "<li class='nav-item'><a class='nav-link' href='?page=events#main'>Evenments</a></li>";
$login = "<li class='nav-item'><a class='nav-link' href='?page=login#main'>Log in</a></li>";
$eventTab = "<li class='nav-item'><a class='nav-link' href='?page=eventsTable#main'>EVENT TABLE</a></li>";

//----------------------------------USER LINKS
$addEvent = " <li class='nav-item'><a class='nav-link' href='?page=addevent#main'>Ajouter Evenment</a></li>";
$logout = "<li class='nav-item'><a class='nav-link' href='?logout'>Deconnecter</a></li>";
$account = "<li class='nav-item'><a class='nav-link' href='?page=profile#main'>Votre Compte</a></li>";
$contact = "<li class='nav-item'><a class='nav-link' href='?page=contact#main'>Contact</a></li>";
$yourEvents = "<li class='nav-item'><a class='nav-link' href='?page=eventsTable&userID=$userID#main'>Vos evenments</a></li>";
$yourSubriptions = "<li class='nav-item'><a class='nav-link' href='?page=userSubEvntsTable&id=$userID#main'>Vos participations</a></li>";

//-----------------------------ADMIN

$AdminAccount = "<li class='nav-item'><a class='nav-link' href='?page=admin#main'>ADMIN</a></li>";
$AdminUserList = "<li class='nav-item'><a class='nav-link' href='?page=usersList'>Lste des Utilisateurs</a></li>";
$AdminEventList = "<li class='nav-item'><a class='nav-link' href='?page=eventList'>Lste des Evenments</a></li>";
$AdminsubsList = "<li class='nav-item'><a class='nav-link' href='?page=subsTable'>Lste des Evenments</a></li>";

$link1 = $events;
$link2 = $contact;
$link3 = $register;
$link4 = $login;
$link5 = "";
$link6 = "";

if ($userID) {
    $link2 = $addEvent;
    $link3 = $yourEvents;
    $link4 = $yourSubriptions;
    $link5 = $account;
    $link6 = $logout;
    if ($userID == 1) {
        $link1 = $AdminAccount;
        $link2 = $AdminUserList;
        $link3 = $AdminEventList;
        $link4 = $AdminsubsList;
    }
}

?>

<nav class="navbar navbar-expand-lg bg-dark navbar-dark fixed-top py-2" id="mainNav">
      <div class="container-fluid px-3 px-lg-5">
        <a class="navbar-brand" href="?page=events#main">EventBright</a>
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
            <?=$link6 ?>

          </ul>
        </div>
      </div>
    </nav>
