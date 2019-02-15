<?php 
//session_start();
if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
{
    header('location: /projet3/index.php?action=online');
    
}
?>
<?php $title='Connexion' ?>
<?php $h_1='Connexion' ?>

<?php ob_start(); ?>
	<body class="text-center">
		
		
		

			<div class="container-fluid user">
				
				<div class="row">
				<div class="col-lg-4"></div>
				<form action="/projet3/index.php?action=connexion" method="POST" class="form-signin col-lg-4" style="float: none;">
							
							<label for="user" class="sr-only">Identifiant : </label>
							<input type="text" name="user" class="form-control" placeholder="Identifiant"><br>
							<label for="pass" class="sr-only">Mot de passe : </label>
							<input type="password" name="pass" class="form-control" placeholder="Mot de passe"><br>
							
							
							<input type="submit" name="connexion" value="Connexion" class="btn btn-lg btn-primary btn-block">
						
					
					
				</form>

				</div>
			</div>
			<div class="message_erreur"><p><?php if(isset($_GET['message_erreur'])){echo $_GET['message_erreur']; } ?></p></div>
        <?php $content = ob_get_clean(); ?>
        <?php require('template.php'); ?>

      </body>
</html>