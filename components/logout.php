<?php
if (isset($_COOKIE['userID'])) {
    $localUser = $_COOKIE['userID'];
    logout($localUser);
}
header('Location: index.php?page=login&msg=Vous avez ete deconnecte.');
unset($_COOKIE['userID']);
unset($_COOKIE['token']);
