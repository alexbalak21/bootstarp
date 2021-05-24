<?php
if (isset($_COOKIE['userID'])) {
    require_once "model.php";
    $id = $_COOKIE['userID'];
    dbLogOut($id);

}

setcookie('user', null, -1, '/');
unset($_COOKIE['user']);
setcookie('userID', null, -1, '/');
unset($_COOKIE['userID']);
setcookie('token', null, -1, '/');
unset($_COOKIE['token']);
header('Location:index.php?page=logout');
