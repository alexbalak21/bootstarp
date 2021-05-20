<?php
require_once "model.php";
require_once "upload.php";


//-----------------------------------------------REGISTER
if (isset($_POST['register'])) {
    $img = 'profile.png';
    if (!empty($_FILES['fileToUpload']['name'])) {
        $error = imgFileUpload();
        if($error == 0)
        $_GET['uploadError']= $error;
        else
        $img = $_FILES['uploaded'];
    }
    $email = $_POST['email'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    if ($password1 === $password2) {
        $id = registerUser($email, $firstname, $lastname, $password1, $img);
        if ($id > 0) {
            header("Location: ../index.php?page=login&register=success");
        }
    }
}

//----------------------------------------------LOGIN
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $result = checkUserPass($email, $password);
    if ($result == 'NOUSER') {
        header("Location: ../index.php?page=login&error=NOUSER");
    }

    if ($result == 'WRONGPASS') {
        header("Location: ../index.php?page=login&error=WRONGPASS");
    }
    if ($result['connected'] == 'TRUE') {
        array_pop($result);
        $data = json_encode($result, true);
        set_cookie('user', $data, 14);
        header("Location: ../index.php?page=profile");
    }
}

function set_cookie($name, $value, $expDays)
{
    $set = setcookie($name, $value, time() + (86400 * (INT)$expDays), "/");
    return $set;
}

//--------------------------------------------ADD PRODUCT
$user = json_decode($_COOKIE['user'], true);

// Array ( [name] => Apple Iphone [category] => Phone [price] => 100 [description] => Some text... [addProduct] => [productForm] => REGISTER
if (isset($_POST['addProduct'])) {
    $img = 'product.png';
    if (!empty($_FILES['fileToUpload']['name'])) {
        $error = imgFileUpload();
        $img = $_FILES['uploaded'];
    }
    $lastID = addProduct($user['id'], $_POST['name'], $_POST['category'], $_POST['price'], $_POST['description'], $img);
    if ($lastID > 0) {
        header("Location: ../index.php?page=login");
    }
}

if (isset( $_POST['addEvent'])){
    // $user = json_decode($_COOKIE['user'], true);
    $userID = 12;
        $img = 'default.png';
        if (!empty($_FILES['fileToUpload']['name'])) {
            $error = imgFileUpload();
            if($error == 0)
            $_GET['uploadError']= $error;
            else
            $img = $_FILES['uploaded'];
        }
    $user['id'] = 12;
    $name = $_POST['eventName'];
    $category = $_POST['category'];
    $place = $_POST['place'];
    $city = $_POST['city'];
    $description = $_POST['description'];
    $startTime = $_POST['startTime'];
    $latsID = addEvent($userID, $name, $category, $place, $city, $description, $startTime, $img);
    if($latsID > 0){
        header("Location:../index.php");
    }
}

if(isset($_GET['admin'])){
    //CHECK IF ADMIN
    $admin = $_GET['admin'];
    if($admin == 'allevents'){
        echo "TETS";
    }
}

function getAllEvents(){
    $events = getAll('events');
    return $events;
}
