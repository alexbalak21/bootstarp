<?php
if (isset($_COOKIE['userID'])) {
    $USER = json_decode($_COOKIE['user'], true);
    $activ = '';
    $valid = '';
    if (!($_COOKIE['userID'] == 99 && $USER['email'] == 'admin@gmail.com')) {
        header("Location: index.php");
    } else {
        $users = getAll('users');
        foreach ($users as $user) {
            if ($user['validated']) {
                $valid = "<button class='btn btn-primary'>Enlever</button>";
            } else {
                $valid = "<button class='btn btn-primary'>Valider</button>";
            }
            if ($user['activated']) {
                $activ = "<button class='btn btn-secondary'>Desactiver</button>";
            } else {
                $activ = "<button class='btn btn-success'>Activer</button>";
            }
            $actions = "<button class='btn btn-danger'>Supprimer</button>";
            $img = $user['img'];
            require "blocks/usersRow.php";
        }

    }
} else {
    header("Location: index.php");
}
