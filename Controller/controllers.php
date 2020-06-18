<?php

require_once('Model/postModel.php');
require_once('Model/commentModel.php');
require_once('Model/userModel.php');
require_once('Model/adminModel.php');

function listPosts()
{
    $postManager = new PostManager();
    $commentManager = new CommentManager(); 
    $posts = $postManager->getPosts();
    $comRep = $commentManager->getRep();

    require('View/homeView.php');
}
function valideReport($postId)
{
    require('View/flagView.php');   
    listPosts();
}
function post()
{
	$postManager = new PostManager();
    $commentManager = new CommentManager();
    $post = $postManager->getPost($_GET['id']);
    $posts = $postManager->getPosts();
    $comments = $commentManager->getComments($_GET['id']);
    require('View/postView.php');
}

function addComment($postId, $comment)
{
    $commentManager = new CommentManager();
    $affectedLines = $commentManager->postComment($postId, $comment);
    $postManager = new PostManager();
    $commentManager = new CommentManager();
    $post = $postManager->getPost($postId);
    $posts = $postManager->getPosts();
    $comments = $commentManager->getComments($postId);
    require('View/postView.php');
}
function failAddUser($errors)
{
    require_once('View/fAddUser.php');
}
function newUser($username,$password,$email)
{  
    $loginManager = new LoginManager();
    $user = $loginManager->addUser($username,$password,$email);
    listPosts(); 
}
function login()
{
    require('View/inscription.php');
}
function checkUser($username){
    $loginManager = new LoginManager();
    $user = $loginManager->verifiedUser($username);
    if ($user == 1) {
        require('View/logView.php');
        listPosts();
    }
    if ($user == 0) {
        require_once('View/failConnect.php');
        require_once('View/inscription.php');
    }
}
function dPost($postId)
{
    session_start();
    if (isset($_SESSION)) {
        if ($_SESSION['statu'] != "admin") {
            require('View/erreur.php');
        }
        else{
            $adminManager = new AdminManager();
            $user = $adminManager->deletePost($postId);
            $postManager = new PostManager();
            $commentManager = new CommentManager(); 
            $posts = $postManager->getPosts();
            $comRep = $commentManager->getRep();
            require('View/homeView.php');
            
        }
    }
    else
    {
        require('View/erreur.php');       
    }
}


function addPost($addPostContent,$addPostContentTitle){

    session_start();
    if (isset($_SESSION)) {
        if ($_SESSION['statu'] != "admin") {
            require('View/erreur.php');
        }
        else{
            $adminManager = new AdminManager();
            $post = $adminManager->addPost($addPostContent,$addPostContentTitle);
            listPosts();
        }
    }
    else
    {
        require('View/erreur.php');       
    }
}

function reportPost($id,$postId)       
{
    $commentManager = new CommentManager();
    $affectedLines = $commentManager->reportPost($id);  
    valideReport($postId);
    //header('Location: index.php?action=post&id=' . $postid);
   
}

function deleteComment($id,$postId){

    session_start();
    if (isset($_SESSION)) {
        if ($_SESSION['statu'] != "admin") {
            require('View/erreur.php');
        }
        else{
            $adminManager = new AdminManager();
            $post = $adminManager->deleteComment($id);
            $postManager = new PostManager();
            $commentManager = new CommentManager();
            $post = $postManager->getPost($postId);
            $posts = $postManager->getPosts();
            $comments = $commentManager->getComments($postId);
            require('View/postView.php');
        }
    }
    else
    {
        require('View/erreur.php');       
    }
}
function valideComment($id,$postId){


    session_start();
    if (isset($_SESSION)) {
        if ($_SESSION['statu'] != "admin") {
            require('View/erreur.php');
        }
        else{
            $adminManager = new AdminManager();
            $post = $adminManager->valideComment($id);
            $postManager = new PostManager();
            $commentManager = new CommentManager();
            $post = $postManager->getPost($postId);
            $posts = $postManager->getPosts();
            $comments = $commentManager->getComments($postId);
            require('View/postView.php');
        }
    }
    else
    {
        require('View/erreur.php');       
    }
}
function updatePost($postId,$content)
{


    session_start();
    if (isset($_SESSION)) {
        if ($_SESSION['statu'] != "admin") {
            require('View/erreur.php');
        }
        else{
            $adminManager = new AdminManager();
            $postUpdate = $adminManager->updatePost($postId,$content);
            $postManager = new PostManager();
            $commentManager = new CommentManager();
            $post = $postManager->getPost($postId);
            $posts = $postManager->getPosts();
            $comments = $commentManager->getComments($postId);
            require('View/postView.php');  
        }
    }
    else
    {
        require('View/erreur.php');       
    }
}



