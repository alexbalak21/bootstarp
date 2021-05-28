<?php
require_once "components/model.php";
$today = date("Y-m-d");
$userID = checkConnect();
if (!$userID) {
    header('Location: index.php');
}
$USER = getUserByID($userID);

$error = "";

if (isset($_GET['error'])) {
    $error = $_GET['error'];
}
