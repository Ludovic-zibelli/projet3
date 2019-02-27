<?php 
//session_start();
if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
{
    header('location: /projet3/index.php?action=online');
    
}
?>
<?php $title='Recuparation de mot passe'; ?>
<?php $h_1='Recuperation de mot de passe'; ?>

<?php ob_start(); ?>
	<body class="text-center">

		<div class="container-fluid user">
			<div class="row">
				<div class="col-lg-4"></div>
					<form action="/projet3/index.php?action=recup" method="POST" class="form-signin col-lg-4" style="float: none;">
							<fieldset>
							<label for="mail" class="col-form-label list-inline-item">Votre adresse Mail : </label>
							<input type="email" name="recup_mail" class="form-control" placeholder="Indiquez votre mail"><br />
							<input type="submit" name="recup_submit" value="Connexion" class="btn btn-lg btn-primary btn-block">
							<?php if(isset($error)){echo $error;}?>
							</fieldset>
					</form>
				
				</div>
			</div>

        <?php $content = ob_get_clean(); ?>
        <?php require('template.php'); ?>

      </body>
</html>