<?php

require('../Model/postModel.php');
require('../Model/commentModel.php');


function listPosts()
{
    $postManager = new PostManager(); //instanciation de PostManager
    $posts = $postManager->getPosts(); //init post

    require('../View/homeView.php');
}

function post()
{
	$postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);


    require('../View/postView.php');
}

function addComment($postId, $author, $comment)
{
    $commentManager = new CommentManager();
    $affectedLines = $commentManager->postComment($postId, $author, $comment);
    header('Location: index.php?action=post&id=' . $postId);

}

