<?php
function toFrDate($date)
{
    $ymd = explode('-', $date);
    $frommatDate = $ymd[2] . '/' . $ymd[1] . '/' . $ymd[0];
    return $frommatDate;
}
