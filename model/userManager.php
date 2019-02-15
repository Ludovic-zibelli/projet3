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
}