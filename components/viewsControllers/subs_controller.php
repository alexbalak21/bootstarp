<?php
require_once "components/convert.php";
$userID = checkConnect();
if ($userID != 1) {
    header('Location: ../index.php');
} else {
    $subs = getAllSubs();
    foreach ($subs as $sub) {
        $dateTime = explode(' ', $sub['subTime']);
        $subOn = toFrDate($dateTime[0]) . ' ' . substr($dateTime[1], 0, 5);

        require "blocks/subsRow.php";
    }
}
