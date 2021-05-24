<?php
require_once "components/convert.php";
$activ = '';
$valid = '';
$userId = checkConnect();
if ($userId != 1) {
    header("Location: index.php");
} else {
    $adminID = $_COOKIE['userID'];
    $events = getAll('events');
    foreach ($events as $event) {
        $img = $event['img'];
        $eventID = $event['id'];
        $count = subsCount($eventID);
        $time = substr($event['time'], 0, 5);
        $date = toFrDate($event['date']);
        $postDate = toFrDate($event['postDate']);
        require "blocks/eventDeleteConfirm.php";
        if ($event['active']) {
            $activ = "<a href='components/controller.php/?cmd=deactivateEvent&event=$eventID'><button class='btn btn-secondary'>Desactiver</button></a>";
        } else {
            $activ = "<a href='components/controller.php/?cmd=activateEvent&event=$eventID'><button class='btn btn-success'>Activer</button></a>";
        }
        $delete = "<button class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#deleteEventConfirm$eventID'>Suprimer</button>";

        require "blocks/eventsRow.php";
    }

}
