<?php
if (isset($_COOKIE['userID'])) {
    $USER = json_decode($_COOKIE['user'], true);
    $activ = '';
    $valid = '';
    if (!($_COOKIE['userID'] == 99 && $USER['email'] == 'admin@gmail.com')) {
        header("Location: index.php");
    } else {
        $adminID = $_COOKIE['userID'];
        $events = getAll('events');
        foreach ($events as $event) {
            $img = $event['img'];
            $id = $event['id'];
            require "blocks/eventDeleteConfirm.php";
            if ($event['active']) {
                $activ = "<a href='components/controller.php/?cmd=deactivateEvent&event=$id'><button class='btn btn-secondary'>Desactiver</button></a>";
            } else {
                $activ = "<a href='components/controller.php/?cmd=activateEvent&event=$id'><button class='btn btn-success'>Activer</button></a>";
            }
            $delete = "<button class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#deleteEventConfirm$id'>Suprimer</button>";

            require "blocks/eventsRow.php";
        }

    }
}
