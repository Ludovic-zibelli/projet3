<?php 
session_start();
if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
{
    $welcom = 'Bonjour ' . $_SESSION['pseudo'].'</br>';
    
}
else
{
    header('location: /projet3/index.php');
}
 
ob_start();
?>
	<body>
		
		

       
		<?php
            if(isset($signalcomment))
            {
            ?>
             <h2>Commentaire signaler !</h2>
            <?php
                while ($commentSignal = $signalcomment->fetch())
                {

                  
                ?>
                        <div class="comments">
                        <p><strong><?= htmlspecialchars($commentSignal['author']) ?> Le <?= htmlspecialchars($commentSignal['comment_date_fr']) ?></strong><em></em><em><a href="/projet3/index.php?action=delComment&id=<?php echo $commentSignal['id']; ?>&postId=<?php echo $commentSignal['post_id'];?> "onclick="return confirm('Voulez-vous vraiment supprimer ce commentaire ?');"> (Supprimer) </a></em><em><?php if($commentSignal['signaler'] == 1){echo '<strong>Commentaire signaler</strong>';}else{echo 'Commentaire non signaler'; }?></em><em><a href="index.php?action=signal&id=<?php echo htmlspecialchars($commentSignal['id']);?>&postid=<?php echo htmlspecialchars($commentSignal['post_id']);?>">Designaler</a></em></p>
                        <p><?= htmlspecialchars($commentSignal['comment']) ?></p>
                    </div>

                <?php
                }
            }
        
        ?>
        <h2>Commentaire non signaler</h2>
        <?php
                while ($comments = $comment->fetch())
                {  
                    if($comments['signaler'] == 0)
                    {
                ?>
                        <div class="comments">
                        <p><strong><?= htmlspecialchars($comments['author']) ?> Le <?= htmlspecialchars($comments['comment_date_fr']) ?></strong><em></em><em><a href="/projet3/index.php?action=delComment&id=<?php echo $comments['id']; ?>&postId=<?php echo $comments['post_id'];?> "onclick="return confirm('Voulez-vous vraiment supprimer ce commentaire ?');"> (Supprimer) </a></em>
                        <p><?= htmlspecialchars($comments['comment']) ?></p>
                    </div>

                <?php
                    }        
                }
                
        $title='Gestion des commentaires';
        $h_1='Gestion des commentaires';
        $comment->closeCursor();
		 

        ?>

		<?php $content = ob_get_clean(); ?>
        <?php require('template.php'); ?>

      </body>
</html>