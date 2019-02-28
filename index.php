<?php 

require('controleur/frontend.php');

if(isset($_GET['action']))
{
	if($_GET['action'] == 'listPost')
	{
		listPost();
	}
	elseif ($_GET['action'] == 'post') 
	{
		if(isset($_GET['id']) && $_GET['id'] > 0)
		{
			post();
		}
		else
		{
			echo 'Erreur : aucun identifiant message envoyer !';
		}
		
	}
	elseif ($_GET['action'] == 'signalComment')
	{
		if(isset($_GET['id']) && $_GET['id'] >0 )
		{
			signalComment($_GET['id'],$_GET['sign'],$_GET['postid']);
		}
		else
		{
			echo 'Erreur :  aucun identifiant commentaire a etait envoyer !';
		}
	}
	elseif ($_GET['action'] == 'signal')
	{
		if(isset($_GET['id']) && $_GET['id'] > 0)
		{
			signal($_GET['id'], $_GET['postid']);
		}
		else
		{
			echo 'Erreur : aucun identifiant commentaire a etait envoyer ! ';
		}
	}
	elseif ($_GET['action'] == 'editPost') 
	{
		if(isset($_GET['id']) && $_GET['id'] > 0)
		{
			editPost($_GET['id']);
		}
		else
		{
			echo 'Erreur : aucun identifiant message envoyer !';
		}
	}
	elseif ($_GET['action'] == 'updatePost') 
	{
		if(isset($_GET['id']) && $_GET['id'] > 0)
		{
			if(!empty($_POST['title']) && !empty($_POST['content']))
			{
				updatePost($_GET['id'],$_POST['title'],$_POST['content'],$_POST['chapitre']);
			}
			else
			{
				echo 'Erreur : tous les champs ne sont pas remplis !';
			}
		}
		else
		{
			echo 'Erreur : aucun identifiant message envoyer !';
		}
	}

	elseif ($_GET['action'] == 'postDel') 
	{
		if(isset($_GET['id']) && $_GET['id'] > 0)
		{
		delPost($_GET['id']);
		}
	}

	elseif ($_GET['action'] == 'addPost')
	{
		
			if(isset($_POST['online']))
			{
				addPost($_POST['title'], $_POST['content'],$_POST['chapitre'],$_POST['online']);
			}
			else
			{
				addPost($_POST['title'], $_POST['content'],$_POST['chapitre'], 0);
			}



	}

	elseif ($_GET['action'] == 'addComment') 
	{
		if(isset($_GET['id']) && $_GET['id'] > 0)
		{
			if(!empty($_POST['author']) && !empty($_POST['comment']))
			{
				addComment($_GET['id'], $_POST['author'], $_POST['comment']);
			}
			else
			{
				echo 'Erreur : tous les champs ne sont pas remplis !';
			}
		}
		else
		{
			echo 'Erreur : aucun identifiant message envoyer !';
		}	
	}
	elseif ($_GET['action'] == 'update')
	{
		if(isset($_GET['id']) && $_GET['id'] > 0)
		{
			listeComment($_GET['id']);
		}
		else
		{
			echo 'Erreur : aucun identifiant commentaire envoyer';
		}

	}
	elseif ($_GET['action'] == 'updateComment')
	{
		if(isset($_GET['id']) && $_GET['id'] > 0)
		{
			if(!empty($_POST['comment']))
			{
				updateComment($_POST['comment'], $_GET['id'], $_POST['postId']);
			}
			else
			{
				echo 'Erreur : tous mes champs ne sont pas remplis !';
			}
		}
		else
		{
			echo 'Erreur : aucun identifiant de commentaire et envoyer !';
		}
	}
	elseif ($_GET['action'] == 'connexion') 
	{

		if(!empty($_POST['user']) && !empty($_POST['pass']) )
		{
			connexion($_POST['user'], $_POST['pass']);
		}
		else
		{
			echo "Erreur : tous les champs sont pas remplis !";
		}

		
	}

	elseif ($_GET['action'] == 'recup') 
	{
		if(isset($_POST['recup_mail'],$_POST['recup_submit']))
		{
			if(!empty($_POST['recup_mail']))
			{
				recupMail();
			}
		}
	}

	elseif ($_GET['action'] == 'code')
	{
		if(isset($_POST['verif_code']))
		{
			verifCode();

		}
	}

	elseif ($_GET['action'] == 'online')
	{

		online();
		
	}


	elseif ($_GET['action'] == 'delComment') 
	{

	  delComment($_GET['id'],$_GET['postId']);
	}

	elseif ($_GET['action'] == 'postOnline') 
	{
		postOnline($_GET['online'], $_GET['id']);
	}
}
else
{
	

	listPost();
}