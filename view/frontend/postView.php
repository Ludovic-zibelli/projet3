

<?php ob_start(); ?>

<body>


	

	<div class ="container">
		<div class="row">
			<div class="blog-main col-md-12">
				<div class="blog-post">
				<h2 class="blog-post-title">Chapitre: <?php echo $post['chapitre']; ?></h2>
				<p class="blog-post-meta">Publier le <?php echo $post['creation_date_fr']; ?></p>
				<div class="container">
					<div class="row">
						<div class="col-lg-10">
							<blockquote><?php echo nl2br($post['content']); ?></blockquote>
						</div>
						<div class="col-lg-2">
							<?php if($post['pictures']){ $pictures = $post['pictures']; }else{ $pictures = 'defaut.jpg'; } ?>
							<a href="/public/images/upload/<?php echo $pictures; ?>"><img src="/public/images/upload/<?php echo $pictures; ?>" alt="<?php echo $post['title']?>"></a>
						</div>	
					</div>
				</div>
			 </div>
				<hr>
			</div>
		</div>
	</div>	
<?php $title = $post['title'].'-Billet simple pour l\'Alaska '; ?>
<?php $h_1 = $post['title']; ?>

<div class="container">
	<h3 class="blog-post-title">Commentaire du billet <strong><?php echo htmlspecialchars($post['title']); ?></strong> du chapitre <?php echo htmlspecialchars($post['chapitre']); ?></h3>
	<div class="row">
		
		<div class="col-lg-1"></div>
		<div class="comment col-lg-10">
			<?php
			while($comments = $comment->fetch())
			{

			?>
				<div class ="list-group">
					<div href="#" class="list-group-item list-group-item-action">
		    					<div class="d-flex w-100 justify-content-between">
		      					<h4 class="mb-1">De <strong><?= htmlspecialchars($comments['author']) ?></strong></h4>
		      					<small>Le <?= htmlspecialchars($comments['comment_date_fr']) ?></small>
		    					</div>
		    					<p class="mb-1"><?= htmlspecialchars($comments['comment']) ?></p>
		    					<div class="container">
		    						<div class="row">
		    						<div class="col-sm-10"></div>
		    					<small class="pull-right col-sm-2"><a class="btn btn-danger btn-sm" href="
		    						/1-<?php echo htmlspecialchars($comments['id']);?>-<?php echo htmlspecialchars($post['id']);?>.html"><i class="fas fa-exclamation-circle">  Signaler</i></a></small>
    						</div>
    					</div>
  					</div>
  				</div>

			<?php
			}
			?>
			<hr>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="card card border-danger mb-1 col-sm-12">
	            <div class="card-header text-center">
							<h2 >Ajouter un commentaire</h2>
						</div>
						<div class="card-body">
							<form action="/addComment-<?= $post['id'] ?>.html" method="post">
					
							<div class="form-group row">
								<label for="author" class="col-sm-2 col-form-label">Auteur :</label>
							<div class="col-sm-10">
								<input type="text" name="author" id="author" class="form-control"/>
							</div>
							</div>
							<div class="form-group row">
								<label for="comment" class="col-sm-2 col-form-label">Commentaire :</label>
							<div class="col-sm-10">
								<textarea id="comment" name="comment" class="form-control"></textarea>
							</div>
							</div>	
							<div class="form-group row">
    							<div class="col-sm-3">
      							<button type="submit" class="btn btn-primary btn-lg" data-toggle="tooltip" data-placement="top" title="Envoyer un commentaire">Envoyer</button>
   							</div>
 							</div>	
					</form>
				</div>
			</div>
		</div>
	</div>

		
		
	<?php $content = ob_get_clean(); ?>
	<?php require('view/frontend/template.php'); ?>


	</body>
</html>