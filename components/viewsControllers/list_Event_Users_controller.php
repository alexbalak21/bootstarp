<?php
require_once "components/checkLogin.php";
$users = usersOnEvent($eventID);
foreach ($users as $subID => $user) {
    $name = $user['name'];
    $date = $user['date'];
    $link = "?page=user&id=$subID";
    echo "
<tr>
<td>$date</td>
<td><a href='$link'>$name</a></td>
</tr>
";
}
