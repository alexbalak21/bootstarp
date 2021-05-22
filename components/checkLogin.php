<?php
$USER = 'NOTCON';
if (isset($_COOKIE['user'])) {
    $USER = json_decode($_COOKIE['user'], true);
}
