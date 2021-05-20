<?php
global $pdo;
$pdo = null;

// CONNECT TO MySQL and DATABASE
function db_connect()
{
    global $pdo;
    $pdo = null;
    $servername = "localhost";
    $email = "admin";
    $password = "root";
    $db_name = "eventbrite";

    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$db_name", $email, $password);
        // set the PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}


function create_table_users()
{
    db_connect();
    global $pdo;
    $sql = "CREATE TABLE users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(50) NOT NULL UNIQUE,
    firstname VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    img VARCHAR(255) NOT NULL DEFAULT 'profile.png',
    reg_date DATE NULL DEFAULT NULL,
    validated BOOLEAN DEFAULT 0,
    validation VARCHAR(255) NULL DEFAULT NULL,
    activated BOOLEAN DEFAULT 0
    )";
    $pdo->exec($sql);
    echo "TABLE USERS CREATED SUCCESSFULLY";
    $pdo = null;
}

function create_table_events()
{
    db_connect();
    global $pdo;
    $sql = "CREATE TABLE `events` (
    `eventID` INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `creatorID` INT(6) NOT NULL,
    `name` VARCHAR(150) NULL DEFAULT NULL ,
    `category` VARCHAR(50) NULL DEFAULT NULL,
    `place`  VARCHAR(255) NULL DEFAULT NULL,
    `city` VARCHAR(50) NULL DEFAULT NULL ,
    `description` TEXT  NULL DEFAULT NULL,
    `img` VARCHAR(50) NULL DEFAULT NULL,
    `active` BOOLEAN NOT NULL DEFAULT 1,
    `postDate` DATE NULL DEFAULT NULL,
    `startTime` DATETIME NULL DEFAULT NULL,
    `subscribed` INT(2) DEFAULT 0
    
    )";
    $pdo->exec($sql);
    echo "<br>TABLE EVENTS CREATED SUCCESSFULLY";
    $pdo = null;
}


create_table_events();

?>