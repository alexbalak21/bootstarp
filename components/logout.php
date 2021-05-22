<?php
setcookie('user', null, -1, '/');
unset($_COOKIE['user']);
setcookie('userID', null, -1, '/');
unset($_COOKIE['userID']);
header('Location:index.php?page=logout');
