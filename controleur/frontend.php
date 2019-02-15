<?php 

require_once('model/postManager.php');
require_once('model/commentManager.php');
require_once('model/userManager.php');


//Function Post
function listPost()
{
	$PostManager = new \openclassrooms\blog\model\postManager();
	$posts = $PostManager->getPosts();

	require('view/frontend/listePostView.php');
}

function post()
{
	$PostManager = new openclassrooms\blog\model\postManager();
	$commentManager = new openclassrooms\blog\model\commentManager();

	$post = $PostManager->getPost($_GET['id']);
	$comment = $commentManager->getComments($_GET['id']);

	require('view/frontend/postView.php');
}

function editPost($postId)
{
	$PostManager = new openclassrooms\blog\model\postManager();
	$post = $PostManager->getPost($postId);

	require('view/backend/postViewAdmin.php');
}

function updatePost($id, $title, $content,$chapitre)
{
	$PostManager = new openclassrooms\blog\model\postManager();
	$updateComment = $PostManager->updatePost($id, $title, $content, $chapitre);

	if($updateComment === false)
	{
		die('Impossible de modifier le billet !');
	}
	else
	{
		header('Location: index.php?action=online&update=1');
	}
}

function delPost($id)
{
	$delPost = new openclassrooms\blog\model\postManager();
	$del = $delPost->delPost($id);

	if($del === false)
	{

		die('Impossible de supprimer le commentaire !');
	}
	else
	{
		header('Location: index.php?action=online');

	}
}

function addPost($title, $content,$chapitre,$online)
{
	$addPost = new openclassrooms\blog\model\postManager();
	$add = $addPost->addPost($title,$content,$chapitre,$online);

	if($add === false)
	{
		die('Impossible d\'ajouter un billet');
	}
	else
	{
		header('Location: index.php?action=online');
	}
}

function postOnline($online, $id)
{
	$postOnline = new openclassrooms\blog\model\postManager();
	$online = $postOnline->postOnline($online, $id);

	if($online === false)
	{
		die('Impossible de mettre le billet en ligne');
	}
	else
	{
		header('Location: index.php?action=online');
	}
}

//Function comment 
function addComment($postId, $author, $comment)
{
	$commentManager = new openclassrooms\blog\model\commentManager();
	$affectLine = $commentManager->postComments($postId, $author, $comment);

	if($affectLine === false)
	{
		echo $affectLine;
		die('Impossible d\' ajouter de commentaire !');
	}
	else
	{
		header('Location: index.php?action=post&id='. $postId);
	}
}

function listeComment($id)
{
	$commentManager = new openclassrooms\blog\model\commentManager();
	$comment = $commentManager->getComments($id);
	$signalStatus = new openclassrooms\blog\model\commentManager();
	$signalcomment = $signalStatus->signalStatus($id);
	require ('view/backend/commentViewAdmin.php');
	//rajouter function signaleStatut
}

function updateComment($comment, $id, $postId)
{
	$commentManager = new openclassrooms\blog\model\commentManager();
	$newComment = $commentManager->updateComment($comment, $id, $postId);

	if($newComment == false)
	{

		die('Impossible de modifier le commentaire !');
	}
	else
	{
		header('Location: index.php?action=post&id='.$postId);

	}
}

function delComment($id, $postId)
{
	$delComment = new openclassrooms\blog\model\commentManager();
	$del = $delComment->delComment($id);

	if($del == false)
	{

		die('Impossible de supprimer le commentaire !');
	}
	else
	{
		header('Location: index.php?action=update&id='.$postId);

	}
}

function signalComment($id, $sing, $postId)
{
	$signalComment = new openclassrooms\blog\model\commentManager();
	$sign = $signalComment->signalComment($id,$sing);

	if($sign === false)
	{
		die('Impossible de signaler le commentaire');
	}
	else
	{
		header('Location: index.php?action=post&id='.$postId);
	}
}

function signal($id, $postId)
{
	$signalComment = new openclassrooms\blog\model\commentManager();
	$sign = $signalComment->signalComment($id,0);

	if($sign === false)
	{
		die('Impossible de signaler le commentaire');
	}
	else
	{
		header('Location: index.php?action=update&id='.$postId);	
	}
}

//User connexion 
function online()
{
		session_start();
		if(isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
		{
			$PostManager = new \openclassrooms\blog\model\postManager();
			$posts = $PostManager->getPosts();

			require('view/backend/viewAdmin.php');
		}


}

function connexion($pseudo, $pass)
{

	$userManager = new openclassrooms\blog\model\userManager();
	$user = $userManager->getUser($pseudo);

	if($user)
	{

		$isPasswordCorrect = password_verify($pass, $user['password']);
		if($isPasswordCorrect)
		{
			session_start();
			$_SESSION['id'] = $user['id'];
	        $_SESSION['pseudo'] = $user['fr_name'];
	        
	        $PostManager = new \openclassrooms\blog\model\postManager();
			$posts = $PostManager->getPosts();
			require('view/backend/viewAdmin.php');
	        
	   		//setcookie('pseudo', $user['pseudo'] , time() + 365*24*3600, null, null, false, true);
			//setcookie('pass', $user['password'], time() + 365*24*3600, null, null, false, true);
	       
		}
		else
		{
			header('location: view/frontend/userView.php?message_erreur= Identifiant ou mot de passe incoreccte');
		}
	
	}
	else 
	{
		
		header('location: view/frontend/userView.php?message_erreur= Identifiant ou mot de passe incoreccte');
		
		
	}
}






