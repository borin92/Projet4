<?php


class AdminManager
{
	public function deletePost($postId)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('DELETE FROM billets WHERE id = ?');
		$req->execute(array($postId));				
		return $postId;
	}
	public function updatePost($postId,$content)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('UPDATE billets SET content = ? WHERE id=?');
		$req->execute(array($content,$postId));
		return $postId;

	}
	public function addPost($addPostContent,$addPostContentTitle)
	{
		$db = $this->dbConnect();
		$title = $addPostContentTitle;
		$content = $addPostContent;
		$req = $db->prepare('INSERT INTO billets(title, content, creation_date) VALUES (?, ?, NOW())');
		$req->execute(array($title,$content));		
		return $req;
	}
	public function deleteComment($id)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('DELETE FROM commentaires WHERE id = ?');
		$req->execute(array($id));
		return $req;
	}
	public function valideComment($id)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('UPDATE commentaires SET report = 0 WHERE id=?');
		$req->execute(array($id));
		return $req;
	}

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


