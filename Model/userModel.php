<?php


class LoginManager
{
	public function addUser($username,$password,$email)
	{
	    $db = $this->dbConnect();
	    $req = $db->prepare('INSERT INTO user(username ,password,email,password_confirm) VALUES (?,?,?,?)');

	    $password = password_hash($_POST['password'],PASSWORD_BCRYPT);
	    $user = $req->execute(array($_POST['username'],$password,$_POST['email'],$password));	
	   	//$user = $req->execute();
	    //var_dump($user);
	    print_r($password);
	    return $user;
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


