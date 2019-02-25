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
$title='Ajouter un billet'; 
$h_1='Ajouter un billet'; 

ob_start(); ?>
	<body>
		
	<div class="container">
		<div class="row">
				<div class="col-lg-0"></div>
				<form enctype="multipart/form-data" action="/projet3/index.php?action=addPost" method="POST" class="form-horizontal col-lg-12">
					<div class="form-group row list-inline">
						<label for="title" class="col-form-label list-inline-item">Titre : </label>
						<input type="text" name="title" class="form-control list-inline-item">
					</div>	
					<div class="form-group row list-inline">
						<label for="content" class="col-form-label list-inline-item">Text : </label>
						<textarea name="content" id="content" class="form-control list-inline-item" cols="30" rows="30"></textarea>
					</div>

					<div class="form-group row list-inline">
						<label for="fichier_a_uploader" class="col-form-label list-inline-item" title="Recherchez le fichier à uploader !">Ajouter une photo :</label>
						<input type="hidden" name="MAX_FILE_SIZE" value="10000000"  />
            			<input name="image" type="file" id="image_uploade" class="form-control list-inline-item"/>
					</div>

					<div class="form-group row list-inline">
						<label for="chapitre" class="col-form-label list-inline-item">Numero du chapitre : </label>
						<input type="number" name="chapitre" class="form-control list-inline-item">
					</div>
					<div class="form-group row list-inline">
						<label for="online" class="col-form-label list-inline-item"> Mettre en ligne :  </label>
						<input type="checkbox" name="online" value="1" class="list-inline-item">
					</div>
					<div class="form-group row list-inline">
						<input type="submit" name="envoyer" value="Envoyer" class="btn btn-primary">
						<input type="submit" name="reset" value="Reset" class="btn btn-primary">
					</div>
					
					</form>
			</div>
		</div>
	</div>

		<?php $content = ob_get_clean(); ?>
        <?php require('template.php'); ?>

      </body>
</html>