<?php 

namespace openclassrooms\blog\model;

require_once('model/Manager.php');

class commentManager extends Manager
{
	public function getComments($postId)
	{
		$db = $this->dbConnect();
		$comments = $db->prepare('SELECT id, author, comment,post_id, DATE_FORMAT(creation_date , \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr, signaler FROM comments WHERE post_id = ? ORDER BY creation_date  DESC' );
		$comments ->execute(array($postId));
		return $comments; 
	} 

	public function getCommentSignal()
	{
		$db = $this-> dbConnect();
		$req = $db->query('SELECT id, author, comment,post_id, DATE_FORMAT(creation_date , \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr, signaler FROM comments');
		return $req;
	}

	public function postComments($postId, $author, $comment)
	{
		$db = $this->dbConnect();
		$comments = $db-> prepare('INSERT INTO comments(post_id, author, comment, creation_date , modification_date, online, signaler) VALUES (?, ?, ?, NOW(), NOW(), 1, 0) ');
		$affectLine = $comments->execute(array($postId, $author, $comment));
		return $affectLine;
	}

	public function getComment($postId)
	{
		$db = $this->dbConnect();
		$comment = $db->prepare('SELECT id, author, comment, DATE_FORMAT(creation_date , \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE id = ?');
		$comment->execute(array($postId));
		$comments = $comment->fetch();
		return $comments;
	}

	public function updateComment($comment, $id)
	{
		$db = $this->dbConnect();
		$req =$db->prepare('UPDATE comments SET comment = ?, comment_date = NOW() WHERE id = ? ');
		$req->execute(array($comment, $id));

		return $req;
	}

	public function delComment($id)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('DELETE FROM comments WHERE id= ?');
		$ret = $req->execute(array($id));
		return $ret;

	}

	public function signalComment($id,$sing)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('UPDATE comments SET signaler =? WHERE id=?');
		$req->execute(array($sing,$id));
		return $req;
	}

	public function signalStatus($post_id)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id, author, comment,post_id, DATE_FORMAT(creation_date , \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr, signaler FROM comments WHERE signaler = ? AND post_id= ?');
		$req->execute(array(1,$post_id));
		$commentsStatus = $req;
		return $commentsStatus;

	}

	public function compteurComment($post_id)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT * FROM comments WHERE post_id = ?');
		$req -> execute(array($post_id));
		$nbr_ligne = $req->rowCount();
		return $nbr_ligne;
	}
}