<?php 

namespace openclassrooms\blog\model;

require_once('model/Manager.php');

class PostManager extends Manager
{
	//Appel de toute les billets 
	public function getPosts()
	{
		$db = $this-> dbConnect();
		$req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr,DATE_FORMAT(modification_date,\'%d/%m/%Y à %Hh%imin%ss\') AS modification_date_fr, online, chapitre FROM posts ORDER BY creation_date DESC LIMIT 0, 5');
		return $req;
	}

	//Appel d'un billet avec l'id en argument 
	public function getPost($postId)
	{
		$db = $this-> dbConnect();
		$req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date,\'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr, DATE_FORMAT(modification_date,\'%d/%m/%Y à %Hh%imin%ss\') AS modification_date_fr, chapitre FROM posts WHERE id= ?');
		$req->execute(array($postId));
		$post = $req->fetch();

		return $post;
	}

	//Modification d'un billet
	public function updatePost($id, $title, $content,$chapitre)
	{
		$db = $this-> dbConnect();
		$req = $db->prepare('UPDATE posts SET title = ?, content = ?,chapitre=?, modification_date = NOW() WHERE id = ? ');
		$req->execute(array($title, $content,$chapitre, $id));
	}

	public function postOnline($online, $id)
	{
		$db = $this-> dbConnect();
		$req = $db->prepare('UPDATE posts SET online = ? WHERE id = ? ');
		$req->execute(array($online, $id));
		//return $req ;
	}

	//Suppression d'un billet 
	public function delPost($id)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('DELETE FROM posts WHERE id= ?');
		$ret = $req->execute(array($id));
		return $ret;
	}

	//Ajouter un billet
	public function addPost($title, $content,$chapitre,$online)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('INSERT INTO posts(title, content, chapitre, creation_date , modification_date, online) VALUES (?,?,?,NOW(),NOW(),?)');
		$affectLine = $req->execute(array($title,$content,$chapitre,$online));
		return $affectLine;
	}

}