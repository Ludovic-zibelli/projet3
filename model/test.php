<?php 

try
{
	$bdd = new PDO('mysql:host=db775665650.hosting-data.io;dbname=db775665650;charset=utf8', 'dbo775665650', 'Projet3%');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

$pseudo ='marion';
$req = $bdd->prepare('SELECT * FROM user WHERE pseudo = :pseudo');
$req->execute(array(
	'pseudo' => $pseudo ));
$resultat = $req->fetch();

echo $resultat['password'];

$old_pass = $resultat['password'];
$pass_hache = password_hash($old_pass, PASSWORD_DEFAULT);
$id = $resultat['id'];
echo $pass_hache;

$req =$bdd->prepare('UPDATE user SET password = ? WHERE id = ? ');
$req->execute(array($pass_hache, $id));

echo 'mot de passe modifier';