<?php
require_once "model.php";
require_once "upload.php";
// require_once "dev.php";

// -----------------------------------------------REGISTER
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
        if ($id == 'DUPLICATE') {
            header("Location: ../index.php?page=login&msg=Ce mail est déja pris.");
            die;
        }
    } else {
        header("Location: ../index.php?page=login&msg=Mots de passe ne correspondent pas.");
        die;
    }
    if ($id > 0) {
        header("Location: ../index.php?page=login&msg=Vous etes enregistré. Veuillez vous logger.");
    }
}

//-----------------------------------------------------------------LOGIN
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $result = checkUserPass($email, $password);
    if ($result == 'NOTVALID') {
        header("Location: ../index.php?page=login&error=Email non Validé !");
    }
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
        set_cookie('token', $result['token'], 14);
        header("Location: ../index.php?page=profile&msg=Vous etes connecté.");
    }
}

function set_cookie($name, $value, $expDays)
{
    $set = setcookie($name, $value, time() + (86400 * (INT)$expDays), "/");
    return $set;
}

//-------------------------------------------------------------------------ADD EVENT
if (isset($_POST['addEvent'])) {
    $userID = checkConnect();
    if (!$userID) {
        header('Location: ../index.php');
    } else {
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
            header("Location:../index.php?msg=Evenment à été crée.");
        }
    }
}
//-------------------------------------------------------------------------UPDATE EVENT
if (isset($_POST['updateEvent'])) {
    $userID = checkConnect();
    if (!$userID) {
        header('Location: ../index.php');
    } else {
        $img = manageFileUpdate($_POST['img']);
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
            header("Location:../index.php?msg=Mise à Jour de l'evenment.");
        } else {
            $_GET['msg'] = 'Echcec mis à Jour';
        }
        return null;
    }
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
    $userID = checkConnect();
    if (!$userID) {
        header('Location: ../index.php');
    }
    $eventID = $_POST['id'];
    $active = activDeactivEvent($eventID, $userID);
    if (isset($_POST['table'])) {
        header("Location: ../?page=eventsTable&userID=$userID#main");
    } else {
        header("Location: ../?page=updateEvent&id=$eventID#main");
    }
}

//--------------------------------------------------DELETE EVENT
if (isset($_POST['deleteEvent'])) {
    $userID = checkConnect();
    if (!$userID) {
        header('Location: ../index.php');
    }
    $eventID = $_POST['id'];
    $done = deleteEvent($eventID, $userID);
    if ($done) {
        header("Location:../?page=events&msg=Votre evenment à été supprimé.");
    } else {
        header("Location:../?page=events&msg=Erreur Suppression.");
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
        setcookie('token', null, -1, '/');
        unset($_COOKIE['token']);
        unset($_COOKIE['id']);
        header("Location: ../index.php?msg=Votre compte à été supprimé.");
    } else {
        header("Location: ../index.php?msg=Erreur Suppression.");
    }
}

//-------------------------------SUBSCRIBE / UNSUBSCRIBE ON EVENT
if (isset($_POST['subscribe'])) {
    $eventID = $_POST['eventID'];
    $userID = $_POST['subscribe'];
    $subID = addToEvent($eventID, $userID);
    header("Location:../?page=event&id=$eventID#main");
}

if (isset($_POST['unsubscribe'])) {
    $eventID = $_POST['eventID'];
    $userID = $_POST['unsubscribe'];
    $unsubID = unsubscribeEvent($eventID, $userID);
    echo $unsubID;
    header("Location:../?page=event&id=$eventID#main");
}

//-----------------------------------SHOW EVENT UPDATE FORM
if (isset($_POST['manage'])) {
    $eventID = $_POST['eventID'];
    header("Location:../?page=updateEvent&id=$eventID#main");
}

//----------------------------------------------------------------------------ADMIN SECTION
if (isset($_GET['cmd'])) {
    $userID = checkConnect();
    if ($userID != 1) {
        header("Location: ../index.php");
    } else {
        $cmd = $_GET['cmd'];

        //--------------------------------------------------VALID MAIL
        if ($cmd == 'vaildMail') {
            $id = $_GET['user'];
            $done = validMail($id);
            if ($done) {
                header("Location: ../../?page=usersList#main");
            }
        }

//-------------------------------------INVALD MAIL
        if ($cmd == 'invalidMail') {
            $id = $_GET['user'];
            $done = invalidMail($id);
            if ($done) {
                header("Location: ../../?page=usersList#main");
            }
        }

//------------------------------ACTIVATE EVENT
        if ($cmd == 'activateEvent') {
            $id = $_GET['event'];
            $done = activateEvent($id);
            if ($done) {
                header("Location: ../../?page=eventList#main");
            }
        }

//---------------------------------DEACTIVATE EVENT
        if ($cmd == 'deactivateEvent') {
            $id = $_GET['event'];
            $done = deactivateEvent($id);
            if ($done) {
                header("Location: ../../?page=eventList#main");
            }
        }

//-------------------------------------------ACTIVATE USER
        if ($cmd == 'activateUser') {
            $id = $_GET['user'];
            $done = activateUser($id);
            if ($done) {
                header("Location: ../../?page=usersList#main");
            }
        }
//---------------------------------------------DEACTIVATE USER
        if ($cmd == 'deactivateUser') {
            $id = $_GET['user'];
            $done = deactivateUser($id);
            if ($done) {
                header("Location: ../../?page=usersList#main");
            } else {
                header("Location: ../idex.php&message=Erreur Desactivation ");
            }
        }

        //------------------------------------DELETE SUBSCRIPTION
        if ($cmd == 'DelSub') {
            $subID = $_GET['SubID'];
            $done = delSub($subID);
            if ($done) {
                header("Location: ../index.php?page=subsTable#main");
            }
        }

//-------------------------------------------END ADMIN GET ACTIONS
    }
}

//--------------------------------------ADMIN DELETE USER
if (isset($_POST['confirmDeleteUser'])) {
    $userID = checkConnect();
    if ($userID == 1) {
        $id = $_POST['userToDelete'];
        if (sudoDeleteUser($id)) {

            header("Location: ../?page=usersList&msg=Utilisateur $id Suprimé !");
        } else {
            header("Location: ../idex.php&msg=Erreur Suppression Utilisateur");
        }
    }
}
//-------------------------------------------ADMIN DELETE EVENT
if (isset($_POST['confirmDeleteEvent'])) {
    $userID = checkConnect();
    if ($userID == 1) {
        $id = $_POST['eventToDelete'];
        if (sudoDeleteEvent($id)) {
            header("Location: ../?page=eventList&message=Evenment $id Suprimé !");
        } else {
            header("Location: ../idex.php&message=Erreur Suppression Evenment");
        }
    }
}

//-------------------------------------------------UPADTE USER
if (isset($_POST['updateUser'])) {
    $userID = checkConnect();
    if (!$userID) {
        header('Location: ../index.php');
    } else {
        $img = $_POST['img'];
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
        if (!($password1 == $password2)) {
            header("Location: ../index.php?page=upadteProfile&error=Mots de pass ne corresponend pas");
        }
        $update = updateUser($userID, $email, $firstname, $lastname, $password2, $img);
        $pdo = null;
        if ($update) {
            header("Location: ../index.php?page=profile");
        } else {
            $_GET['error'] = "Update Error";
        }
        return null;
    }
}

//------------FILE MANAGMET
function manageFileUpdate($img)
{
    if (!empty($_FILES['fileToUpload']['name'])) {
        $error = imgFileUpload();
        if ($error == 0) {
            $_GET['uploadError'] = $error;
        } else {
            $img = $_FILES['uploaded'];
        }
    }
    return $img;
}
