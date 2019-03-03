<?php 
session_start();
if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
{
    $welcom = 'Bonjour ' . $_SESSION['pseudo'].'</br>';
    
}
else
{
    header('location: /index.php');
}
 
ob_start();
?>
	<body>
		 
            <?php
            while($comments = $comment->fetch())
            {

            ?>
        <div class="container-fluid">
           <div class="row">
              <div class="col-lg-1"></div>
                <div class="comment col-lg-10">
                  <div class ="list-group">
                    <div href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">De <strong><?= htmlspecialchars($comments['author']) ?></strong></h5>
                                <small>Le <?= htmlspecialchars($comments['comment_date_fr']) ?></small>
                                </div>
                                <p class="mb-1"><?= htmlspecialchars($comments['comment']) ?></p>
                                <div class="container">
                                    <div class="row">
                                    <div class="col-sm-8"></div>
                                    <div class="col-sm-4">
                                        <ul class="nav justify-content-end">
                                        <li><a class ="nav-link btn btn-primary btn-sm" href="/index.php?action=delComment&id=<?php echo $comments['id']; ?>&postId=<?php echo $comments['post_id'];?> "onclick="return confirm('Voulez-vous vraiment supprimer ce commentaire ?');"> Supprimer </a></li>
                                        <li><a class ="nav-link btn btn-primary btn-sm" href="index.php?action=signal&id=<?php echo htmlspecialchars($comments['id']);?>&postid=<?php echo htmlspecialchars($comments['post_id']);?>">Designaler</a></li>
                                        </ul>
                                    </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
            </div>
        </div>
    </div>

                <?php
                          
                }
                
        $title='Gestion des commentaires';
        $h_1='Gestion des commentaires';
        $comment->closeCursor();
		 

        
         ?>
		<?php $content = ob_get_clean(); ?>
        <?php require('template.php'); ?>

      </body>
</html>