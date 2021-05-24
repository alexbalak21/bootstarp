<?php
require_once "components/convert.php";
$users = usersOnEvent($eventID);
foreach ($users as $subID => $user) {
    $name = $user['name'];
    $date = toFrDate($user['date']);
    $link = "?page=user&id=$subID";
    echo "
<tr>
<td><a href='$link'>$name</a></td>
<td>$date</td>
</tr>
";
}
