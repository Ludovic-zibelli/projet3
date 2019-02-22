<?php 

//session_start();
if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
{
    $welcom = 'Bonjour ' . $_SESSION['pseudo'].'</br>';
    
}
else
{
    header('location: /projet3/index.php');
}
$title='Gestion du blog'; 
$h_1='Gestion du blog | ' . $welcom; 

ob_start(); ?>
	<body>
		

		
		<?php
        while ($data_signal = $signaler->fetch())
        {
            if($data_signal['signaler'])
            {
        ?>
                <main class="container">
                    <div class="row">
                        <div class="col-md-12 blog-main">
                            <div class="card card border-danger mb-3">
                                <div class="card-header">
                                    <div class="container">
                                    <div class="row">
                                    <div class="col-md-6 title_admin"><h4>Le commentaire de <?php echo $data_signal['author']; ?> a était signalé !</h4></div>

                                    <ul class="nav justify-content-end col-md-6">
                                            <li class="nav-item"><a class ="nav-link btn btn-primary btn-sm" href="/projet3/index.php?action=delComment&id=<?php echo $data_signal['id']; ?>&postId=<?php echo $data_signal['post_id'];?> "onclick="return confirm('Voulez-vous vraiment supprimer ce commentaire ?');"> Supprimer </a></li>
                                            <li class="nav-item"><a class ="nav-link btn btn-primary btn-sm" href="index.php?action=signal&id=<?php echo htmlspecialchars($data_signal['id']);?>&postid=<?php echo htmlspecialchars($data_signal['post_id']);?>">Designaler</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="card-text"><?php echo $data_signal['comment'];?> </p>
                        </div>
                        <div class="card-footer text-center">
                            <p class="card-meta">Commentaire emis le : <?php echo $data_signal['comment_date_fr']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </main>


        <?php
            }

        }


		while ($data = $posts->fetch())
	    {

                //Nombre de commentaire par billet 
                $nbr_ligne = new openclassrooms\blog\model\commentManager();
                $nbr_comments = $nbr_ligne->compteurComment($data['id']);

        if($data['online'] == 0)
        {

	        ?>
        <main class="container">
	        <div class="row">
	            <div class="col-md-12 blog-main">
                    <div class="card card border-danger mb-3">
	                    <div class="card-header">
                                <div class="container">
                                <div class="row">
                                        <div class="col-md-4 title_admin"><h3><?php echo ($data['title']); ?></h3></div>

                                
                                        <ul class="nav justify-content-end col-md-8">
                                            <li class="nav-item"><a class ="nav-link btn btn-primary btn-sm " role="button" aria-pressed="true" href="index.php?action=update&id=<?php echo $data['id']; ?>"><i class="fas fa-comment"> Commentaire </i>  <span class="badge badge-light"><?php echo ($nbr_comments); ?></span></a></li>
                                            <li class="nav-item"><a class ="nav-link btn btn-primary btn-sm active" role="button" aria-pressed="true" href="index.php?action=editPost&id=<?php echo $data['id']; ?>"><i class="fas fa-edit"> Modifier</i></a></li>
                                            <li class="nav-item"><a class ="nav-link btn btn-primary btn-sm active" role="button" aria-pressed="true" href="index.php?action=postDel&id=<?php echo $data['id']; ?>"onclick="return confirm('Voulez-vous vraiment supprimer ce billet ?');"><i class="fas fa-eraser"> Supprimer</i></a></li>
                                            <li class="nav-item"><a class ="nav-link btn btn-primary btn-sm active" role="button" aria-pressed="true" href="index.php?action=postOnline&online=1&id=<?php echo ($data['id']); ?>"><i class="fas fa-link"> Mettre en ligne</i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                            <h3 class="card-title">Chapitre : <?php echo ($data['chapitre']); ?></h3>
                            <p class="card-text"><?php echo nl2br($data['content']);?> </p>
	                	</div>
                        <div class="card-footer text-center">Billet mise en ligne le le <?php echo $data['creation_date_fr']; ?>. | Dernier modification le <?php echo ($data['modification_date_fr']); ?>. | Le billet est <i class="fas fa-eye-slash"> Hors-ligne</i>.</div>
                    </div>
	            </div>
            </div>
        </main>
	         
        <?php
    		}
    	
    	?>
    	      	
    	<?php
    	

        if($data['online'] == 1)
        {

                //Nombre de commentaire par billet 
                $nbr_ligne = new openclassrooms\blog\model\commentManager();
                $nbr_comments = $nbr_ligne->compteurComment($data['id']);

        ?>
            <main class="container">
                <div class="row">
                    <div class="col-md-12 blog-main">
                       <div class="card">
                        <div class="card-header">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6 title_admin"><h3><?php echo ($data['title']); ?> </h3></div>

                                    <ul class="nav justify-content-end col-md-6">
                                        <li class="nav-item"><a class ="nav-link btn btn-primary btn-sm " role="button" aria-pressed="true" data-toggle="tooltip" data-placement="top" title="Gestion des commentaires du billet" href="index.php?action=update&id=<?php echo $data['id']; ?>"><i class="fas fa-comment"> Commentaire </i>  <span class="badge badge-light"><?php echo ($nbr_comments); ?></span></a></li>
                                        <li class="nav-item"><a class ="nav-link btn btn-primary btn-sm " role="button" aria-pressed="true" data-toggle="tooltip" data-placement="top" title="Modifier le billet" href="index.php?action=editPost&id=<?php echo $data['id']; ?>"><i class="fas fa-edit"> Modifier</i></a></li>
                                        <li class="nav-item"><a class ="nav-link btn btn-primary btn-sm" role="button" aria-pressed="true" data-toggle="tooltip" data-placement="top" title="Supprimer le billet" href="index.php?action=postDel&id=<?php echo $data['id']; ?>"onclick="return confirm('Voulez-vous vraiment supprimer ce billet ?');"><i class="fas fa-eraser"> Supprimer</i></a></li>

                                            </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                            <h3 class="card-title">Chapitre : <?php echo ($data['chapitre']); ?></h3>
                            <p class="card-text"><?php echo nl2br($data['content']);?> </p>
                        </div>
                        <div class="card-footer text-center">Billet mise en ligne le <?php echo $data['creation_date_fr']; ?>. | Dernier modification le <?php echo($data['modification_date_fr']); ?>. | Le billet est <i class="fas fa-eye"> En ligne</i>.</div>
                    </div>
                </div>
            </div>
        </main>
        <?php    
        }
        
        }
        $posts->closeCursor();
        ?>

		<?php $content = ob_get_clean(); ?>
        <?php require('template.php'); ?>

      </body>
</html>
