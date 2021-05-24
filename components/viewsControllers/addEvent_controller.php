<?php
require_once "components/model.php";
$userID = checkConnect();
if (!$userID) {
    header('Location: index.php');
}
$USER = getUserByID($userID);
$error = "";

if (isset($_GET['error'])) {
    $error = $_GET['error'];
}
