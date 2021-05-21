<?php
function checkLogin()
{
    if (isset($_COOKIE['user'])) {
        $USER = json_decode($_COOKIE['user'], true);
    } else {
        $USER = false;
    }
    return $USER;
}
