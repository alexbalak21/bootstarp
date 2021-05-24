<?php
require_once "components/convert.php";
if (isset($_COOKIE['userID'])) {
    $USER = json_decode($_COOKIE['user'], true);
    $activ = '';
    $valid = '';
    if (!($_COOKIE['userID'] == 99 && $USER['email'] == 'admin@gmail.com')) {
        header("Location: index.php");
    } else {
        $adminID = $_COOKIE['userID'];
        $users = getAll('users');
        foreach ($users as $user) {
            $id = $user['id'];
            $regDate = toFrDate($user['reg_date']);
            require "blocks/delleteUserConfirm.php";
            if ($user['validated']) {
                $valid = "<a href='components/controller.php/?cmd=invalidMail&user=$id'><button class='btn btn-secondary'>Invalider</button></a>";
            } else {
                $valid = "<a href='components/controller.php/?cmd=vaildMail&user=$id'><button class='btn btn-success'>Valider</button></a>";
            }
            if ($user['activated']) {
                $activ = "<a href='components/controller.php/?cmd=deactivateUser&user=$id'><button class='btn btn-secondary'>Desactiver</button></a>";
            } else {
                $activ = "<a href='components/controller.php/?cmd=activateUser&user=$id'><button class='btn btn-success'>Activer</button></a>";
            }
            $actions = "<button class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#deleteUserConfirm$id'>Suprimer</button>";
            $img = $user['img'];
            require "blocks/usersRow.php";
        }

    }
} else {
    header("Location: index.php");
}
