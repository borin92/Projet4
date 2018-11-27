<?php


class PostManager
{
	//recuper les posts
 	public function getPosts()
	{
	    $db = $this->dbConnect();
	    $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr, content_resume FROM       billets ORDER BY creation_date DESC LIMIT 0, 5');
	    return $req;
	}

	//recupere un post en particulier
	public function getPost($postId)
	{

	    $db = $this->dbConnect();
	   
	    $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\'), content_resume AS creation_date_fr, content_resume FROM billets WHERE id = ?');
	    $req->execute(array($postId));
	    $post = $req->fetch();

	    return $post;
	}
	//connection a la bdd
	private function dbConnect()
	{
	    try
	    {
	        $db = new PDO('mysql:host=localhost;dbname=p4;charset=utf8', 'root', '');
	        
	        return $db;
	    }
	    catch(Exception $e)
	    {
	        die('Erreur : '.$e->getMessage());
	    }
	}
}
