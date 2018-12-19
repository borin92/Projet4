<?php

require_once('../Model/postModel.php');
require_once('../Model/commentModel.php');
require_once('../Model/userModel.php');
require_once('../Model/adminModel.php');

function listPosts()
{
    $postManager = new PostManager();
    $commentManager = new CommentManager(); //instanciation de PostManager
    $posts = $postManager->getPosts(); //init post
    $comRep = $commentManager->getRep();
    require('../View/homeView.php');
}
function valideReport($postId)
{
    require('../View/flagView.php');   
    listPosts();
}
function post()
{
	$postManager = new PostManager();
    $commentManager = new CommentManager();
    $post = $postManager->getPost($_GET['id']);
    $posts = $postManager->getPosts();
    $comments = $commentManager->getComments($_GET['id']);
    require('../View/postView.php');
}

function addComment($postId, $comment)
{
    $commentManager = new CommentManager();
    $affectedLines = $commentManager->postComment($postId, $comment);
    header('Location: index.php?action=post&id=' . $postId);
}
function failAddUser($errors)
{
    require_once('../View/fAddUser.php');
}
function newUser($username,$password,$email)
{  
    $loginManager = new LoginManager();
    $user = $loginManager->addUser($username,$password,$email);
    listPosts(); 
}
function login()
{
    require('../View/inscription.php');
}
function checkUser($username){
    $loginManager = new LoginManager();
    $user = $loginManager->verifiedUser($username);
    if ($user == 1) {
        require('../View/logView.php');
        listPosts();
    }
}
function dPost($postId)
{
    $adminManager = new AdminManager();
    $user = $adminManager->deletePost($postId);
    listPosts();
}


function addPost($addPostContent,$addPostContentTitle){
    $adminManager = new AdminManager();
    $post = $adminManager->addPost($addPostContent,$addPostContentTitle);
    listPosts();
}

function reportPost($id,$postId)       
{
    $commentManager = new CommentManager();
    $affectedLines = $commentManager->reportPost($id);  
    valideReport($postId);
    //header('Location: index.php?action=post&id=' . $postid);
   
}

function deleteComment($id,$postId){
    
    $adminManager = new AdminManager();
    $post = $adminManager->deleteComment($id);
    header('Location: index.php?action=post&id=' . $postId);
}
function valideComment($id,$postId){

    $adminManager = new AdminManager();
    $post = $adminManager->valideComment($id);
    header('Location: index.php?action=post&id=' . $postId);
}
function updatePost($postId,$content)
{
    $adminManager = new AdminManager();
    $postUpdate = $adminManager->updatePost($postId,$content);
    header('Location: index.php?action=post&id=' . $postId);
}



