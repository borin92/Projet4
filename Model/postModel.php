<?php


class PostManager
{
	//recuper les posts
 	public function getPosts()
	{
	    $db = $this->dbConnect();
	    $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM  billets ORDER BY creation_date DESC LIMIT 0, 5');
	    return $req;
	}

	//recupere un post en particulier
	public function getPost($postId)
	{

	    $db = $this->dbConnect();
	   
	    $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM billets WHERE id = ?');
	    $req->execute(array($postId));
	    $post = $req->fetch();

	    return $post;
	}
	//connection a la bdd
	private function dbConnect()
	{
	    try
	    {
	        $db = new PDO('mysql:host=db720814814.db.1and1.com;dbname=db720814814;charset=utf8', 'dbo720814814', '92ippon92',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	        return $db;
	    }
	    catch(Exception $e)
	    {
	        die('Erreur : '.$e->getMessage());
	    }
	}
}
