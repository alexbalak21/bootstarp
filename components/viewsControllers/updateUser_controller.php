<?php
require_once "components/model.php";
require_once "blocks/deleteUserModal.php";
$userID = checkConnect();
if (!$userID) {
    header('Location: index.php');
}
$user = getUserByID($userID);
$error = "";

if (isset($_GET['error'])) {
    $error = $_GET['error'];
}
