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

// CREATE USER
function registerUser($email, $firstname, $lastname, $password, $img = "profile.png")
{
    $passHash = password_hash($password, PASSWORD_DEFAULT);
    $validation = md5( rand(0,1000));
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



//CHECK USER LOGIN
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

function addEvent($userID, $name, $category, $place, $city, $description, $startTime, $img='default.png'){
    db_connect();
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO `events` (`creatorID`, `name`, `category`, `place`, `city`, `description`, `img`, `postDate`, startTime) 
                                        VALUES ($userID, :name, :category, :place, :city, :description, :img, NOW(), :startTime)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':category', $category);
    $stmt->bindParam(':place', $place);
    $stmt->bindParam(':city', $city);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':img', $img);
    $stmt->bindParam(':startTime', $startTime);
    $done = $stmt->execute();
    $last_id = $pdo->lastInsertId();
    $pdo = null;
    return $last_id;
}
