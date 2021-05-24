<?php
global $pdo;
$pdo = null;

// CONNECT TO MySQL and DATABASE
function db_connect()
{
    global $pdo;
    $servername = "localhost";
    $email = "admin";
    $password = "root";
    $db_name = "eventbright";
    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$db_name", $email, $password);
        // set the PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}

//--------------------------------------------------------------------------------------CREATE USER
function registerUser($email, $firstname, $lastname, $password, $img = "profile.png")
{
    $passHash = password_hash($password, PASSWORD_DEFAULT);
    $validation = md5(rand(0, 1000));
    db_connect();
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO `users` (`email`, `firstname`, `lastname`, `password`, `img`, reg_date, `validation`) VALUES (:email, :firstname, :lastname, :passHash, :img, NOW(), :validation)");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':passHash', $passHash);
    $stmt->bindParam(':img', $img);
    $stmt->bindParam(':validation', $validation);
    try {
        $done = $stmt->execute();
    } catch (PDOException $e) {

        foreach ($e as $key => $case) {
            $err = $case[1];
        }
        if ($err == 1062) {
            $pdo = 0;
            return "DUPLICATE";
        }
    }
    $last_id = $pdo->lastInsertId();
    $pdo = null;
    return $last_id;
}

//----------------------------------------------SEND VALIDATION TOKEN TO MAIL
function sendValidation($userID)
{
    db_connect();
    global $pdo;
    $user = $pdo->query("SELECT `email`, `validation` FROM `users` WHERE id = $userID")->fetch(PDO::FETCH_ASSOC);
    $email = $user['email'];
    $token = $user['validation'];
    $url = "http://127.0.0.1/event/index.php?validation";
    $get = "&email=$email&token=$token";
    $fullUrl = $url . $get;
    $link = "<a href='$fullUrl'>activation</a>";
    $pdo = null;
    return $link;
}

//-------------------------------------------------RECIVE VALIDATION REQUEST
function reciveValidation($email, $token)
{
    db_connect();
    global $pdo;
    $stmt = $pdo->prepare("SELECT `validation` FROM users WHERE email=:email");
    $stmt->bindValue(':email', $email);
    $stmt->execute();
    $db_token = $stmt->fetchColumn();
    if ($token === $db_token) {
        $stmt = $pdo->prepare("UPDATE `users` SET `validation` = 0, `validated`= 1 WHERE email=:email");
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $pdpo = null;
        return 1;
    }
    $pdo = null;
    return 0;
}

//--------------------------------------------------------------------------------UPDATE USER

function updateUser($userID, $email, $firstname, $lastname, $password, $img)
{

    db_connect();
    global $pdo;
    $stmt = $pdo->prepare("UPDATE `users` SET `email`=:email, `firstname`=:firstname, `lastname`=:lastname, `img`=:img  WHERE `id`=$userID");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':img', $img);
    $updateDone = $stmt->execute();
    if (!empty($password)) {
        $passHash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE `users` SET `password`=:passHash");
        $stmt->bindParam(':passHash', $passHash);
        $done = $stmt->execute();
    }
    $pdo = null;
    return $updateDone;
}

//--------------------------------------------------------------------------CHECK USER LOGIN
function checkUserPass($email, $password)
{
    db_connect();
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email=:email");
    $stmt->bindValue(':email', $email);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $data = $stmt->fetch();
    if (empty($data)) {
        return 'NOUSER';
    }
    $passHash = $data['password'];
    if (password_verify($password, $passHash)) {
        unset($data['password']);
        $data['connected'] = "TRUE";
        $pdo = null;
        $id = $data['id'];
        $token = updateToken($id);
        $data['token'] = $token;
        return $data;
    } else {
        $data = null;
        return "WRONGPASS";
    }
    $pdo = null;
}

//--------------------------------------------------------------------GET ALL EVENTS
function getAll($table = 'events')
{
    db_connect();
    global $pdo;
    $sql = sprintf("SELECT * FROM $table");
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $data = $stmt->fetchAll();
    $dpo = null;
    return $data;
}

//--------------------------------------------------------------------GET ALL EVENTS OF USER
function getAllEventsOfUser($userID)
{
    db_connect();
    global $pdo;
    $sql = sprintf("SELECT * FROM events WHERE creatorID=$userID");
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $data = $stmt->fetchAll();
    $dpo = null;
    return $data;
}

//------------------------------------------------------------DELETE ALL EVENTS OF USER

function deleteEventsOfUser($id)
{
    db_connect();
    global $pdo;
    $events = $pdo->exec("DELETE FROM `events` WHERE `creatorID`=$id");
    $subs = $pdo->exec("DELETE FROM `subs` WHERE `userID`=$id");
    $pdo = null;
    return $done;
}

//------------------------------------------------------------------------------------ADD EVENT
function addEvent($userID, $name, $category, $place, $city, $description, $date, $time, $img = 'default.png')
{
    db_connect();
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO `events` (`creatorID`, `name`, `category`, `place`, `city`, `description`, `img`, `postDate`, `date`, `time`)
                                        VALUES ($userID, :name, :category, :place, :city, :description, :img, NOW(), :date, :time)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':category', $category);
    $stmt->bindParam(':place', $place);
    $stmt->bindParam(':city', $city);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':img', $img);
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':time', $time);
    $done = $stmt->execute();
    $last_id = $pdo->lastInsertId();
    $pdo = null;
    return $last_id;
}
//-------------------------------------------------------------------------------------UPDATE EVENT
function updateEvent($eventID, $name, $category, $place, $city, $description, $date, $time, $img)
{
    db_connect();
    global $pdo;
    $stmt = $pdo->prepare("UPDATE `events` SET `name` = :name, `category` = :category, `place`=:place, `city` = :city, `description`=:description, `img`=:img, `postDate`=NOW(), `date`=:date, `time`=:time WHERE id=$eventID");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':category', $category);
    $stmt->bindParam(':place', $place);
    $stmt->bindParam(':city', $city);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':img', $img);
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':time', $time);
    $done = $stmt->execute();
    $pdo = null;
    return $done;
}

//--------------------------------------------------------------------ACTIVATE / DEACTIVATE EVENT
function activDeactivEvent($eventID, $userID)
{
    db_connect();
    global $pdo;
    $active = $pdo->query("SELECT active FROM events WHERE id = $eventID and creatorID = $userID")->fetchColumn();
    if ($active) {
        $pdo->exec("UPDATE `events` SET `active` = 0 WHERE `id`=$eventID and creatorID = $userID");
    } else {
        $pdo->exec("UPDATE `events` SET `active` = 1 WHERE `id`=$eventID and creatorID = $userID");
    }
    $active = $pdo->query("SELECT active FROM events WHERE id = $eventID and creatorID = $userID")->fetchColumn();
    return $active;
}
//-----------------------------------------------------------DELETE EVENT
function deleteEvent($eventID, $userID)
{
    db_connect();
    global $pdo;
    $sql = "DELETE FROM `events` WHERE id=$eventID and creatorID=$userID";
    $done = $pdo->exec($sql);
    $del = $pdo->exec("DELETE FROM `subs` WHERE `eventID` = $eventID");
    $pdo = null;
    return $done;
}

//----------------------------------------------------GET SINGLE EVENT
function getEventByID($eventID)
{
    db_connect();
    global $pdo;
    $sql = "SELECT * FROM events WHERE id=$eventID";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $data = $stmt->fetch();
    $creatorID = $data['creatorID'];
    $dpo = null;
    $creator = getOriansator($creatorID);
    $data['names'] = $creator;
    return $data;
}

//-------------------------------------------------------------GET ROW IN A TABLE
function getRowByID($table = 'events', $id)
{
    db_connect();
    global $pdo;
    $sql = "SELECT * FROM $table WHERE id=$id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $data = $stmt->fetch();
    $dpo = null;
    return $data;
}

//---------------------------------------------------------GET EVENT ORGATISATOR FISTANAME AND LASTNAME
function getOriansator($creatorID)
{
    db_connect();
    global $pdo;
    $data = $pdo->query("SELECT firstname, lastname FROM `users` WHERE `id`= $creatorID")->fetch(PDO::FETCH_ASSOC);
    $names = implode(" ", $data);
    return $names;
}

//-------------------------------------------------------------ADD USER TO AN EVENT

function addToEvent($eventID, $userID)
{
    db_connect();
    global $pdo;
    $pdo->exec("INSERT INTO `subs` (`eventID`, `userID`) VALUES ($eventID, $userID)");
    $last_id = $pdo->lastInsertId();
    $pdo->exec("UPDATE `events` SET `subscribed` = `subscribed`+1 WHERE `id`=$eventID");
    $pdo = null;
    return $last_id;
}

//------------------------------------------------------------UNSUBSCRIBE FORM EVENT
function unsubscribeEvent($eventID, $userID)
{
    db_connect();
    global $pdo;
    $sql = "DELETE FROM `subs` WHERE eventID=$eventID and userID=$userID";
    $pdo->exec($sql);
    $last_id = $pdo->lastInsertId();
    $pdo->exec("UPDATE `events` SET `subscribed` = `subscribed`-1 WHERE `id`=$eventID");
    $pdo = null;
    return $last_id;
}

//--------------------------------------------------------CHECK IF USER ON EVENT
function checkUserInEvent($eventID, $userID)
{
    db_connect();
    global $pdo;
    $data = $pdo->query("SELECT id FROM `subs` WHERE `eventID`= $eventID and `userID`=$userID")->fetchAll(PDO::FETCH_ASSOC);
    $dpo = null;
    return $data;
}

function getAllUsersParticipatingEvets($userID)
{
    db_connect();
    global $pdo;
    $data = $pdo->query("SELECT id FROM `subs` WHERE `userID`= $userID")->fetchAll(PDO::FETCH_ASSOC);
    $dpo = null;
    return $data;
}
//----------------------------------------------------DELETE USER
function deleteUser($userID, $password)
{
    db_connect();
    global $pdo;
    $passHash = $pdo->query("SELECT `password` FROM users WHERE id = $userID")->fetchColumn();
    if (password_verify($password, $passHash)) {
        $userImg = $pdo->query("SELECT `img` FROM users WHERE id = $userID")->fetchColumn();
        $done = $pdo->exec("DELETE FROM `users` WHERE id= $userID");
        if ($userImg != 'profile.png') {
            $delete = unlink("../public/uploads/$userImg");
        }
        deleteEventsOfUser($userID);
        updateSubsCount();
    }
    updateSubsCount();
    $pdo = null;
    return $done;
}

//-----------------------------USERS ON EVENT
function usersOnEvent($eventID)
{
    db_connect();
    global $pdo;
    $subs = $pdo->query("SELECT * FROM `subs` WHERE eventID = $eventID")->fetchAll(PDO::FETCH_ASSOC);
    $row = [];
    $eventUsers = [];
    $users = $pdo->query("SELECT  id, firstname, lastname FROM `users`")->fetchAll(PDO::FETCH_ASSOC);
    $usersByID = [];
    foreach ($users as $user) {
        $usersByID[$user['id']] = $user['firstname'] . ' ' . $user['lastname'];
    }
    $users = [];
    foreach ($subs as $sub) {
        $users[$sub['userID']] = [];
        $users[$sub['userID']]['name'] = $usersByID[$sub['userID']];
        $users[$sub['userID']]['date'] = substr($sub['subTime'], 0, 10);
    }
    $pdo = null;
    return $users;
}

//------------------------------------------GET USER BY ID

function getUserByID($userID)
{
    db_connect();
    global $pdo;
    $user = $pdo->query("SELECT firstname, lastname, email, img FROM `users` WHERE id = $userID")->fetch(PDO::FETCH_ASSOC);
    unset($user['password']);
    unset($user['validation']);
    unset($user['token']);
    return $user;
}

//------------------------------------------------VALID

function validMail($id)
{
    db_connect();
    global $pdo;
    $done = $pdo->exec("UPDATE `users` SET `validated` = 1 WHERE `id`=$id");
    return $done;
}
//----------------------------------------UNVALID MAIL
function invalidMail($id)
{
    db_connect();
    global $pdo;
    $done = $pdo->exec("UPDATE `users` SET `validated` = 0 WHERE `id`=$id");
    return $done;
}
//---------------------------------------ACTIVATE USER
function activateUser($id)
{
    db_connect();
    global $pdo;
    $done = $pdo->exec("UPDATE `users` SET `activated` = 1 WHERE `id`=$id");
    return $done;
}
//----------------------------------------DEACTIVATE USER
function deactivateUser($id)
{
    db_connect();
    global $pdo;
    $done = $pdo->exec("UPDATE `users` SET `activated` = 0 WHERE `id`=$id");
    return $done;
}
//----------------------------------------------ADMIN DELETE USER
function sudoDeleteUser($id)
{
    db_connect();
    global $pdo;
    $done = $pdo->exec("DELETE FROM `users` WHERE `id` = $id");
    deleteEventsOfUser($userID);
    updateSubsCount();
    $pdo = null;
    return $done;
}

//--------------------------------------------ADMIN ACTIVATE EVENT
function activateEvent($id)
{
    db_connect();
    global $pdo;
    $done = $pdo->exec("UPDATE `events` SET `active` = 1 WHERE `id`=$id");
    return $done;
}

//------------------------------------------------DEACTIVATE EVENT
function deactivateEvent($id)
{
    db_connect();
    global $pdo;
    $done = $pdo->exec("UPDATE `events` SET `active` = 0 WHERE `id`=$id");
    return $done;
}

//------------------------------------------------ADMIN DELETE EVENT
function sudoDeleteEvent($id)
{
    db_connect();
    global $pdo;
    $eventIMG = $pdo->query("SELECT `img` FROM events WHERE id = $id")->fetchColumn();
    $done = $pdo->exec("DELETE FROM `events` WHERE `id` = $id");
    $del = $pdo->exec("DELETE FROM `subs` WHERE `eventID` = $id");
    if ($eventIMG != 'default.png') {
        $delete = unlink("../public/uploads/$userImg");
    }
    return $done;
}
//--------------------------------------------------------------UPADATE TOKEN ON LOGIN
function updateToken($id)
{
    db_connect();
    global $pdo;
    $token = md5(rand(0, 1000));
    $hashToken = password_hash($token, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("UPDATE `users` SET `token` = :token WHERE `id`= $id");
    $stmt->bindParam(':token', $hashToken);
    $stmt->execute();
    return $token;
}

//--------------------------------CHECK TOKEN
function checkConnect()
{
    db_connect();
    global $pdo;
    $connected = false;
    $userID = 0;
    if (isset($_COOKIE['userID'])) {
        $userID = $_COOKIE['userID'];
        $token = $_COOKIE['token'];
        $hashToken = $pdo->query("SELECT `token` FROM `users` WHERE id = $userID")->fetchColumn();
        $connected = password_verify($token, $hashToken);
    }
    if ($connected) {
        return $userID;
    } else {
        logout($userID);
        return false;
    }
}

//-----------------------------------LOGOUT

function logout($id)
{
    if ($id) {
        db_connect();
        global $pdo;
        $done = $pdo->exec("UPDATE `users` SET `token` = 0 WHERE `id`=$id");
    }
    $done = 0;
    setcookie('user', null, -1, '/');
    unset($_COOKIE['user']);
    setcookie('userID', null, -1, '/');
    unset($_COOKIE['userID']);
    setcookie('token', null, -1, '/');
    unset($_COOKIE['token']);
    return $done;
}

//-------------------GET TITLE OF EVENT ID
function getTitleOfEvent($id)
{
    db_connect();
    global $pdo;
    $eventName = $pdo->query("SELECT `name` FROM `events` WHERE id = $id")->fetchColumn();
    $pdo = null;
    return $eventName;
}

//----------------------GET ALL EVENTS WHRE USER IS PARTICIPANTNG

function allParticipateEvents($userID)
{
    db_connect();
    global $pdo;
    $events = $pdo->query("SELECT `eventID` FROM `subs` WHERE userID = $userID")->fetchAll(PDO::FETCH_ASSOC);
    $subEvents = [];
    foreach ($events as $key => $value) {
        $id = $value['eventID'];
        $subEvents[$key] = $pdo->query("SELECT * FROM `events` WHERE id=$id")->fetch(PDO::FETCH_ASSOC);
        $creator = $subEvents[$key]['creatorID'];
        $subEvents[$key]['names'] = $firstLastName = getOriansator($creator);
    }
    return $subEvents;
}

//----------------------------GET ALL SUBS
function getAllSubs()
{
    $allSubs = getAll('subs');
    db_connect();
    global $pdo;
    $subs = $allSubs;
    foreach ($allSubs as $key => $sub) {
        $subID = $sub['userID'];
        $names = $pdo->query("SELECT firstname, lastname FROM `users` WHERE id = $subID")->fetchAll(PDO::FETCH_ASSOC);
        $names = $names[0];
        $names = implode(" ", $names);
        $subs[$key]['names'] = $names;
        $eventID = $sub['eventID'];
        $eventName = $pdo->query("SELECT `name` FROM `events` WHERE id = $eventID")->fetchColumn();
        $subs[$key]['eventName'] = $eventName;
    }
    return $subs;
}

//------------------------------------------------------DELETE SUBSCRIPTION
function delSub($subID)
{
    db_connect();
    global $pdo;
    $del = $pdo->exec("DELETE FROM `subs` WHERE `id`=$subID");
    var_dump($del);
    updateSubsCount();
    $pdo = null;
    return $del;
}

function updateSubsCount()
{
    db_connect();
    global $pdo;
    $events = $pdo->query("SELECT `id` FROM `events`")->fetchAll(PDO::FETCH_ASSOC);
    foreach ($events as $event) {
        $eventID = $event['id'];
        $subs = $pdo->query("SELECT `id` FROM `subs` WHERE eventID = $eventID")->fetchAll(PDO::FETCH_ASSOC);
        $count = count($subs);
        $done = $pdo->exec("UPDATE `events` SET `subscribed` = $count WHERE `id`=$eventID");
        $pdo = null;
        return null;
    }
}

function subsCount($eventID)
{
    db_connect();
    global $pdo;
    $subs = $pdo->query("SELECT `id` FROM `subs` WHERE eventID = $eventID")->fetchAll(PDO::FETCH_ASSOC);
    $count = count($subs);
    return $count;

}
