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
	public function addPost($addPostContent,$addPostContentResume,$addPostContentTitle)
	{
		$db = $this->dbConnect();
		$title = $addPostContentTitle;
		$content = $addPostContent;
		$content_resume = $addPostContentResume;
		$req = $db->prepare('INSERT INTO billets(title, content, creation_date, content_resume) VALUES (?, ?, NOW(),?)');
		$req->execute(array($title,$content,$content_resume));		
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
	        $db = new PDO('mysql:host=localhost;dbname=p4;charset=utf8', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	        
	        return $db;
	    }
	    catch(Exception $e)
	    {
	        die('Erreur : '.$e->getMessage());
	    }
	}
}


