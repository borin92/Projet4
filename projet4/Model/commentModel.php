<?php

//recupere les commentaires lié au post
class CommentManager
{
	public function getComments($postId)
	{
	    $db = $this->dbConnect();
	    $comments = $db->prepare('SELECT id, author, comments, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\')  AS comment_date_fr, report FROM commentaires WHERE post_id = ? ORDER BY comment_date DESC');
	    $comments->execute(array($postId));

	    return $comments;
	}
	public function postComment($postId,$comment)
    {
        session_start();
        $author = $_SESSION['username'];
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO commentaires(post_id, author, comments, comment_date,report) VALUES (?, ?, ?,NOW(),0)');

        $affectedLines = $comments->execute(array($postId, $author, $comment));

        return $affectedLines;
    }

    public function reportPost($id)
    {
        $db = $this->dbConnect();
        $comments = $db ->prepare('UPDATE commentaires SET report = 1 WHERE id=?');
        $comments -> execute(array($id));
        
        var_dump($id);
    }


	//connection a la bdd
  	private function dbConnect()
    {
        $db = new PDO('mysql:host=localhost;dbname=p4;charset=utf8', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        return $db;
    }

}
