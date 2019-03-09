<?php 

namespace openclassrooms\blog\model;

require_once('model/Manager.php');

class PostManager extends Manager
{
	//Appel de toute les billets 
	public function getPosts()
	{
		$db = $this-> dbConnect();
		$req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr,DATE_FORMAT(modification_date,\'%d/%m/%Y à %Hh%imin%ss\') AS modification_date_fr, online, chapitre, pictures FROM posts ORDER BY chapitre DESC');
		return $req;
	}



	//Appel d'un billet avec l'id en argument 
	public function getPost($postId)
	{
		$db = $this-> dbConnect();
		$req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date,\'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr, DATE_FORMAT(modification_date,\'%d/%m/%Y à %Hh%imin%ss\') AS modification_date_fr, chapitre, pictures FROM posts WHERE id= ?');
		$req->execute(array($postId));
		$post = $req->fetch();

		return $post;
	}

	//Modification d'un billet
	public function updatePost($id, $title, $content,$chapitre,$pictures)
	{
		$db = $this-> dbConnect();
		$req = $db->prepare('UPDATE posts SET title = ?, content = ?,chapitre=?, modification_date = NOW(), pictures=? WHERE id = ? ');
		$req->execute(array($title, $content,$chapitre, $pictures, $id));
	}

	public function updatePostPict($id, $title, $content,$chapitre)
	{
		$db = $this-> dbConnect();
		$req = $db->prepare('UPDATE posts SET title = ?, content = ?,chapitre=?, modification_date = NOW() WHERE id = ? ');
		$req->execute(array($title, $content,$chapitre,$id));
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
	public function addPost($title, $content,$chapitre,$online,$picture)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('INSERT INTO posts(title, content, chapitre, creation_date , modification_date, online, pictures) VALUES (?,?,?,NOW(),NOW(),?,?)');
		$affectLine = $req->execute(array($title,$content,$chapitre,$online,$picture));
		return $affectLine;
	}


	public function uploadPicture()
	{


			$maxsize = 100000;

			$image = $_FILES['image']['name'];
			$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
			//1. strrchr renvoie l'extension avec le point (« . »).
			//2. substr(chaine,1) ignore le premier caractère de chaine.
			//3. strtolower met l'extension en minuscules.
			$extension_upload = strtolower(  substr(  strrchr($_FILES['image']['name'], '.')  ,1)  );
			if ( in_array($extension_upload,$extensions_valides) )
			{
				
				if ($_FILES['image']['size'] > $maxsize) 
					{
						$erreur = "Le fichier est trop gros";
					}
					else
					{
						$nom = "public/images/upload/{$_FILES['image']['name']}";
						$resultat = move_uploaded_file($_FILES['image']['tmp_name'],$nom);
						if ($resultat) 
						{
							return $image;
						}
					}
			}
		
		
			
		}	

}