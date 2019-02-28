<?php 

require_once('model/postManager.php');
require_once('model/commentManager.php');
require_once('model/userManager.php');
session_start();

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
	
	if(!empty($_FILES['image']['name']))
	{
		$addPict = new openclassrooms\blog\model\postManager();
		$upload = $addPict->uploadPicture();
		
		$PostManager = new openclassrooms\blog\model\postManager();
		$updateComment = $PostManager->updatePost($id, $title, $content, $chapitre, $upload);
	}
	else
	{

		$PostManager = new openclassrooms\blog\model\postManager();
		$updateComment = $PostManager->updatePostPict($id, $title, $content, $chapitre);
	}

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

function addPost($title,$content,$chapitre,$online)
{

	if(!empty($_FILES['image']['name']))
	{
		$addPict = new openclassrooms\blog\model\postManager();
		$upload = $addPict->uploadPicture();

		$addPost = new openclassrooms\blog\model\postManager();
		$add = $addPost->addPost($title,$content,$chapitre,$online,$upload);
	}
	else
	{
		$upload_1 = 'defaut.jpg';	
		$addPost = new openclassrooms\blog\model\postManager();
		$add = $addPost->addPost($title,$content,$chapitre,$online,$upload_1);

	}

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
			$signalStatus = new \openclassrooms\blog\model\commentManager();
			$signaler = $signalStatus->getCommentSignal();

			require('view/backend/viewAdmin.php');
		}


}

function connexion($pseudo, $pass)
{

	$userManager = new openclassrooms\blog\model\userManager();
	$user = $userManager->getUser($pseudo);
	$signalStatus = new \openclassrooms\blog\model\commentManager();
	$signaler = $signalStatus->getCommentSignal();

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

function recupMail()
{
	$recup_mail = htmlspecialchars($_POST['recup_mail']);
	if(filter_var($recup_mail,FILTER_VALIDATE_EMAIL))
	{
		$control_mail = new \openclassrooms\blog\model\userManager();
		$resultat_recup = $control_mail->controlMail($recup_mail);
		if($resultat_recup)
		{
			$pseudo = $resultat_recup['pseudo'];
			$_SESSION['mail_recup'] = $recup_mail;
			$recup_code = "";
			for ($i=0; $i < 8; $i++) 
			{ 
				$recup_code .= mt_rand(0,9);
			}
			$recup_email = new \openclassrooms\blog\model\userManager();
			$return_recup = $recup_email->recupMail($recup_mail);
			if($return_recup == 1)
			{
				$update_mail = new \openclassrooms\blog\model\userManager();
				$update_email = $update_mail->editRecup($recup_code,$recup_mail);

			}
			else
			{
				$inser_code = new \openclassrooms\blog\model\userManager();
				$inserCode = $inser_code->inserRecup($recup_mail,$recup_code);

			}
				 $header="MIME-Version: 1.0\r\n";
		         $header.='From:"Blog de Jean Forteroche"<projet3@ludoviczibelli.fr>'."\n";
		         $header.='Content-Type:text/html; charset="utf-8"'."\n";
		         $header.='Content-Transfer-Encoding: 8bit';
		         $message = '
		         <html>
		         <head>
		           <title>Récupération de mot de passe</title>
		           <meta charset="utf-8" />
		         </head>
		         <body>
		           <font color="#303030";>
		             <div align="center">
		               <table width="600px">
		                 <tr>
		                   <td>
		                     
		                     <div align="center">Bonjour <b>'.$pseudo.'</b>,</div>
		                     Voici votre code de récupération: <b>'.$recup_code.'</b>
		                     A bientôt sur <a href="http://projet3.ludoviczibelli.fr">Le blog </a> !
		                     
		                   </td>
		                 </tr>
		                 <tr>
		                   <td align="center">
		                     <font size="2">
		                       Ceci est un email automatique, merci de ne pas y répondre
		                     </font>
		                   </td>
		                 </tr>
		               </table>
		             </div>
		           </font>
		         </body>
		         </html>
		         ';
		         mail($recup_mail, "Récupération de mot de passe", $message, $header);
		          $msg ="E-Mail envoyer";
		         header('Location:view/frontend/recuperation.php?section=code');
		        
		}
		else
		{
			$error = "Adresse mail invalide";
		}
	}
	else
	{
		$error = "Veuillez entrer votre mail";
	}

}

function verifCode()
{
	$mail_recup = $_SESSION['mail_recup'];
	$verif_codeB = htmlspecialchars($_POST['verif_code']);
	$verif_code = new \openclassrooms\blog\model\userManager();
	$control_code = $verif_code->verifCode($mail_recup,$verif_codeB);

	if($control_code == 1)
	{
		$up_req = new \openclassrooms\blog\model\userManager();
		$upreq = $up_req->confirmCode($_SESSION['mail_recup']);
		 header('Location: view/frontend/recuperation.php?section=changmdp');
	}
	else
	{
		$error = "Code invalide";
	}
}




