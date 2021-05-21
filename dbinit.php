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
    $db_name = "eventbright";

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
    $sql = "CREATE TABLE `users` (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(50) NOT NULL UNIQUE,
    firstname VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    img VARCHAR(255) NOT NULL DEFAULT 'profile.png',
    reg_date DATE NULL DEFAULT NULL,
    validated BOOLEAN DEFAULT 0,
    validation VARCHAR(255) NULL DEFAULT NULL,
    activated BOOLEAN DEFAULT 1
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
    `id` INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `creatorID` INT(6) UNSIGNED,
    --  FOREIGN KEY (creatorID) REFERENCES users(id),
    `name` VARCHAR(150) NULL DEFAULT NULL,
    `category` VARCHAR(50) NULL DEFAULT NULL,
    `place`  VARCHAR(255) NULL DEFAULT NULL,
    `city` VARCHAR(50) NULL DEFAULT NULL ,
    `description` TEXT  NULL DEFAULT NULL,
    `img` VARCHAR(50) NULL DEFAULT NULL,
    `active` BOOLEAN NOT NULL DEFAULT 1,
    `postDate` DATE NULL DEFAULT NULL,
    `date` DATE NULL DEFAULT NULL,
    `time` TIME NULL DEFAULT NULL,
    `subscribed` INT(2) DEFAULT 0

    )";
    $pdo->exec($sql);
    echo "<br>TABLE EVENTS CREATED SUCCESSFULLY";
    $pdo = null;
}

function create_table_sub()
{
    db_connect();
    global $pdo;
    $sql = "CREATE TABLE `subs` (
    `id` INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `eventID` INT(6) UNSIGNED,
    -- FOREIGN KEY (eventID) REFERENCES events(id) ON DELETE CASCADE,
    `userID` INT(6) UNSIGNED,
    -- FOREIGN KEY (userID) REFERENCES users(id) ON DELETE CASCADE,
    `subTime` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
    )";
    $pdo->exec($sql);
    echo "<br>TABLE SUB CREATED SUCCESSFULLY";
    $pdo = null;
}

create_table_users();
create_table_events();
