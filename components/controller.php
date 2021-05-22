<?php
require_once "model.php";
require_once "upload.php";
// require_once "dev.php";
//-----------------------------------------------REGISTER
if (isset($_POST['register'])) {
    $img = 'profile.png';
    if (!empty($_FILES['fileToUpload']['name'])) {
        $error = imgFileUpload();
        if ($error == 0) {
            $_GET['uploadError'] = $error;
        } else {
            $img = $_FILES['uploaded'];
        }
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

//-----------------------------------------------------------------LOGIN
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $result = checkUserPass($email, $password);
    if ($result == 'NOUSER') {
        header("Location: ../index.php?page=login&error=Utilisatuer Inconu !");
    }

    if ($result == 'WRONGPASS') {
        header("Location: ../index.php?page=login&error=Mod de pass Incorect !");
    }
    if ($result['connected'] == 'TRUE') {
        array_pop($result);
        $data = json_encode($result, true);
        set_cookie('user', $data, 14);
        set_cookie('userID', $result['id'], 14);
        header("Location: ../index.php?page=profile");
    }
}

function set_cookie($name, $value, $expDays)
{
    $set = setcookie($name, $value, time() + (86400 * (INT)$expDays), "/");
    return $set;
}

//-------------------------------------------------------------------------ADD EVENT
if (isset($_POST['addEvent'])) {
    if (isset($_COOKIE['user'])) {
        $USER = json_decode($_COOKIE['user'], true);
    } else {
        header("Location: index.php");
    }
    $userID = $USER['id'];
    $img = 'default.png';
    if (!empty($_FILES['fileToUpload']['name'])) {
        $error = imgFileUpload();
        if ($error == 0) {
            $_GET['uploadError'] = $error;
        } else {
            $img = $_FILES['uploaded'];
        }
    }
    $name = $_POST['eventName'];
    $category = $_POST['category'];
    $place = $_POST['place'];
    $city = $_POST['city'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $latsID = addEvent($userID, $name, $category, $place, $city, $description, $date, $time, $img);
    if ($latsID > 0) {
        header("Location:../index.php");
    }
}
//-------------------------------------------------------------------------UPDATE EVENT
if (isset($_POST['updateEvent'])) {
    if (isset($_COOKIE['user'])) {
        $USER = json_decode($_COOKIE['user'], true);
    } else {
        header("Location: index.php");
    }
    $userID = $USER['id'];
    $img = $_POST['img'];
    if (!empty($_FILES['fileToUpload']['name'])) {
        $error = imgFileUpload();
        if ($error == 0) {
            $_GET['uploadError'] = $error;
        } else {
            $img = $_FILES['uploaded'];
        }
    }
    $eventID = $_POST['id'];
    $name = $_POST['eventName'];
    $category = $_POST['category'];
    $place = $_POST['place'];
    $city = $_POST['city'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $updated = updateEvent($eventID, $name, $category, $place, $city, $description, $date, $time, $img);
    if ($updated) {
        header("Location:../index.php");
    } else {
        $_GET['message'] = 'EVENT UPDATE FAILED';
    }
    return null;
}

if (isset($_GET['admin'])) {
    //CHECK IF ADMIN
    $admin = $_GET['admin'];
    if ($admin == 'allevents') {
        echo "TETS";
    }
}
//------------------------------------------------------------------------ACTIVATE / DEACTIVATE EVENT
if (isset($_POST['activateEvent'])) {
    if (isset($_COOKIE['user'])) {
        $USER = json_decode($_COOKIE['user'], true);
    } else {
        header("Location: index.php");
    }
    $eventID = $_POST['id'];
    $userID = $USER['id'];
    $active = activateEvent($eventID, $userID);
    if (isset($_POST['table'])) {
        header("Location: ../?page=eventsTable&userID=$userID");
    } else {
        header("Location: ../?page=updateEvent&id=$eventID");
    }
}

//-------------------------------------------UPDATE USER
if (isset($_POST['updateUser'])) {
    if (isset($_COOKIE['user'])) {
        $USER = json_decode($_COOKIE['user'], true);
    } else {
        header("Location: index.php");
    }
    $img = $USER['img'];
    if (!empty($_FILES['fileToUpload']['name'])) {
        $error = imgFileUpload();
        if ($error == 0) {
            $_GET['uploadError'] = $error;
        } else {
            $img = $_FILES['uploaded'];
        }
    }
    $email = $_POST['email'];
    $password2 = $_POST['password2'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $update = updateUser($USER['id'], $email, $firstname, $lastname, $password2, $img);
    $pdo = null;
    if ($update) {
        header("Location: ../index.php?page=login&update=success");
    } else {
        $_GET['message'] = "Update Error";
    }
    return null;
}
//--------------------------------------------------DELETE EVENT
if (isset($_POST['deleteEvent'])) {
    if (isset($_COOKIE['user'])) {
        $USER = json_decode($_COOKIE['user'], true);
    } else {
        header("Location: index.php");
    }
    $eventID = $_POST['id'];
    $done = deleteEvent($eventID, $USER['id']);
    if ($done) {
        header("Location:../?page=events&message=DELETED");
    } else {
        header("Location:../?page=events&message=ERROR DELETING");
    }
}
//-------------------------------------------------DELETE USER
if (isset($_POST['deleteUser'])) {
    if (isset($_COOKIE['user'])) {
        $USER = json_decode($_COOKIE['user'], true);
    } else {
        header("Location: index.php");
    }
    $userID = $USER['id'];
    $password = $_POST['password'];
    $done = deleteUser($userID, $password);
    if ($done) {
        setcookie('user', null, -1, '/');
        unset($_COOKIE['user']);
        header("Location: ../index.php?message=UserDeleted");
    } else {
        header("Location: ../index.php?message=ErrorDeleting");
    }
}

//-------------------------------SUBSCRIBE / UNSUBSCRIBE ON EVENT
if (isset($_POST['subscribe'])) {
    $eventID = $_POST['eventID'];
    $userID = $_POST['subscribe'];
    $subID = addToEvent($eventID, $userID);
    header("Location:../?page=event&id=$eventID");
}

if (isset($_POST['unsubscribe'])) {
    $eventID = $_POST['eventID'];
    $userID = $_POST['unsubscribe'];
    $unsubID = unsubscribeEvent($eventID, $userID);
    echo $unsubID;
    header("Location:../?page=event&id=$eventID");
}

//-----------------------------------SHOW EVENT UPDATE FORM
if (isset($_POST['manage'])) {
    $eventID = $_POST['eventID'];
    header("Location:../?page=updateEvent&id=$eventID");
}
