<?php


class LoginManager
{
	public function addUser($username,$password,$email)
	{
	    $db = $this->dbConnect();
	    $userS = 'user';
	    $req = $db->prepare('INSERT INTO user(username ,password,email,statu) VALUES (?,?,?,?)');
	    $password = password_hash($_POST['password'],PASSWORD_BCRYPT);
	    $user = $req->execute(array($_POST['username'],$password,$_POST['email'],$userS));
  		session_start();
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['statu'] = $userS;   	
	   	//$user = $req->execute();
	    print_r($password);
	    return $user;
	}

	public function deletePost($postId)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('DELETE FROM billets WHERE id = ?');
		$req->execute(array($postId));	
		return $postId;
	}


	public function verifiedUser($username)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id,password,statu FROM user WHERE username = :username');
	    $req->execute(array('username' => $username));
		$user = $req->fetch();
		$isPasswordCorrect = password_verify($_POST['password'], $user['password']);
		if ($isPasswordCorrect == TRUE) {
	        session_start();
	        $_SESSION['id'] = $user['id'];
	        $_SESSION['username'] = $username;
	        $_SESSION['statu'] = $user['statu'];

			return 1;
		}
		else
		{
			return 0;
		}
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


