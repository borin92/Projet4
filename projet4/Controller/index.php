<?php
require_once('../Controller/controllers.php');


if (isset($_GET['action'])) {

    if ($_GET['action'] == "listPosts") {
        listPosts();

    }
    elseif ($_GET['action'] == "post") {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            post();

        }
        else {
            echo 'Erreur : aucun identifiant de billet envoyé';
        }
    }
    else if ($_GET["action"] == "addComment") {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            if (!empty($_POST['comment'])) {
                addComment($_GET["id"], $_POST["comment"]);
            }
            else {
                echo 'Erreur : tous les champs ne sont pas remplis !';
            }
        }
        else {
            echo 'Erreur : aucun identifiant de billet envoyé';
        } 
    }
    elseif ($_GET['action'] == "inscription") {
        login();
        # code...
    }
    else if($_GET['action'] == "newUser"){
        $errors = array();
        if (empty($_POST['username']) || !preg_match('/^[a-z0-9_]+$/' , $_POST['username'])) {
           $errors['username'] = "votre pseudo n'est pas valide";
           
        }
        if (empty($_POST['email']) || !filter_var($_POST['email'] , FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "votre email est invalide";
        }
        if (empty($_POST['password']) ||!preg_match('/^[a-z0-9_]+$/' , $_POST['password'])) {
            $errors['password'] = "votre password est invalide";
        }
        if (!empty($errors)) {
            failAddUser($errors);
        }
        else {
            newUser($_POST['username'],$_POST['password'],$_POST['email']);
        }
    }
    elseif ($_GET['action'] == "login") {
        $errors = array();
        checkUser($_POST['username']);
    }
    elseif ($_GET['action'] == "deletPost" && isset($_GET['id'])) {
        dPost($_GET['id']);
    }
    elseif ($_GET['action'] == "addPost") {
        addPost($_POST['addPostContent'],$_POST['addPostContentTitle']);
    }
    elseif($_GET['action'] == "reportPost") {
         
        if (isset($_GET['id'])) {
            reportPost($_GET['id'],$_GET['postId']);
        }       
    }  
    elseif($_GET['action'] == "deleteComment") {
        if (isset($_GET['id'])) {
            deleteComment($_GET['id'],$_GET['postId']);
        }       
    }
    elseif($_GET['action'] == "valideComment") {       
        if (isset($_GET['id'])) {

            valideComment($_GET['id'],$_GET['postId']);
        }       
    }
    elseif($_GET['action'] == "updatePost") {   
       if (isset($_GET['id'])) {

            updatePost($_GET['id'],$_POST['content']);
        }   
    }
    elseif ($_GET['action'] == "logOut") {
        session_start();
        $_SESSION = array();
        session_destroy();
        listPosts();
    }
    else{
        listPosts();
    }
}
else{
    listPosts();
}