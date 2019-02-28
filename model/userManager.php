<?php 
namespace openclassrooms\blog\model;

require_once('model/Manager.php');




class userManager extends Manager
{

	

	public function getUser($pseudo)
	{
		$db = $this->dbConnect(); 
		$req = $db->prepare('SELECT * FROM user WHERE pseudo = :pseudo');
		$req->execute(array(
    	'pseudo' => $pseudo ));
    	$resultat = $req->fetch();

    	return $resultat;
   
	}

	public function controlMail($email)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id, pseudo FROM user WHERE email = ? ');
		$req->execute(array($email));
		$resultat_recup = $req->fetch();

		return $resultat_recup;
	}

	public function recupMail($email)
	{
		$db = $this->dbConnect(); 
		$req = $db->prepare('SELECT id FROM recuperation WHERE mail = ? ');
		$req->execute(array($email));
		$recupMail = $req->rowCount();

		return $recupMail;
	}

	public function editRecup($code,$mail)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('UPDATE recuperation SET code = ? WHERE mail = ?');
		$req->execute(array($code,$mail));
		$return_edit = $req;
		return $return_edit;
	}

	public function inserRecup($mail,$code)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('INSERT INTO recuperation(mail,code) VALUES (?,?)');
		$req->execute(array($mail,$code));
		$return_inser = $req;
		return $return_inser;

	}

	public function verifCode($mail,$code)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id FROM recuperation WHERE mail = ? AND code = ?');
		$req->execute(array($mail,$code));
		$code = $req->rowCount();

		return $code;
	}

	public function confirmCode($mail)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('UPDATE recuperation SET confirmation = 1 WHERE mail = ?');
		$req->execute(array($mail));
		
	}
}