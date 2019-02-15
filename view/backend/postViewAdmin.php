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
		
	<div class="container">
		<div class="row">
		<div class="col-lg-12">	
		<form action="index.php?action=updatePost&id=<?php echo $post['id']; ?>" method="POST">
			<div class="form-group row">
				<label for = "title" class="col-form-label">Titre du billet : </label>
				<input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($post['title']) ; ?>">
			</div>
			<div class="form-group row">
				<label for="chapitre" class="col-form-label">Numero de Chapitre : </label>
				<input class="form-control" type="text" name="chapitre" name="chapitre" value="<?php echo htmlspecialchars($post['chapitre']);?>">
			</div>	
			<div class="form-group row">
				<label for="content" class="col-form-label"> Billet : </label>
				<textarea class="form-control" for="content" name="content" rows="20"><?php echo htmlspecialchars($post['content']); ?></textarea>
			</div>
			<input type="submit" name="update" value="Modifier">
		</form>
		</div>
		</div>
	</div>

		
		

		<?php
		
        $title='Modifier le billet';
        $h_1='Modifier le billet';
        
		 

        ?>
        <?php $content = ob_get_clean(); ?>
        <?php require('template.php'); ?>

      </body>
</html>