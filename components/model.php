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
    $done = $stmt->execute();
    $last_id = $pdo->lastInsertId();
    $pdo = null;
    return $last_id;
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
        return $data;
    } else {
        $data = null;
        $pdo = null;
        return "WRONGPASS";
    }
}

function addProduct($userID, $name, $category, $price, $description, $img = 'porduct.png')
{
    db_connect();
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO `products` (`userID`, `name`, `category`, `price`, `description`, `img`) VALUES (:userID, :name, :category, :price, :description, :img)");
    $stmt->bindParam(':userID', $userID);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':category', $category);
    $stmt->bindParam(':price', $price, PDO::PARAM_INT);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':img', $img);
    $done = $stmt->execute();
    $last_id = $pdo->lastInsertId();
    $pdo = null;
    return $last_id;
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
function activateEvent($eventID, $userID)
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
    $last_id = $pdo->lastInsertId();
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
    $data += $creator;
    return $data;
}

//---------------------------------------------------------GET EVENT ORGATISATOR FISTANAME AND LASTNAME
function getOriansator($creatorID)
{
    db_connect();
    global $pdo;
    $stmt = $pdo->query("SELECT firstname, lastname FROM users WHERE id=$creatorID");
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $data = $stmt->fetch();
    return $data;
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
        $done = $pdo->exec("DELETE FROM `users` WHERE id= $userID");
        echo $done;
    }
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

function sudoDeleteUser($id)
{
    db_connect();
    global $pdo;
    $done = $pdo->exec("DELETE FROM `users` WHERE `id` = $id");
    return $done;
}
