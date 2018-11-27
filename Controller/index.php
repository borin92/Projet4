<?php
require_once('../Controller/controllers.php');


if (isset($_GET['action'])) {


    if ($_GET['action'] == 'listPosts') {
        listPosts();

    }
    elseif ($_GET['action'] == 'post') {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            post();

        }
        else {
            echo 'Erreur : aucun identifiant de billet envoyé';
        }
    }
    else if ($_GET['action'] == 'addComment') {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                addComment($_GET['id'], $_POST['author'], $_POST['comment']);
            }
            else {
                echo 'Erreur : tous les champs ne sont pas remplis !';
            }
        }
        else {
            echo 'Erreur : aucun identifiant de billet envoyé';
        } 
    }
    elseif ($_GET['action'] == 'login') {
        login();
        # code...
    }
    else if($_GET['action'] == 'newUser'){
        $errors = array();
        if (empty($_POST['username']) || !preg_match('/^[a-z0-9_]+$/' , $_POST['username'])) {
           $errors['username'] = "votre pseudo n'est pas valide";
           echo "string";
        }
        if (empty($_POST['email']) || !filter_var($_POST['email'] , FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "votre email est invalid";
        }
        if (empty(($_POST['password']) || $_POST['password'] != $_POST['password_confirm '])) {
            $errors['password'] = "votre password est invalid";
            # code...
        }
        else {
            newUser($_POST['username'],$_POST['password'],$_POST['email']);
        }
        var_dump($errors);  
    }
    else{
        listPosts();
    }
}
