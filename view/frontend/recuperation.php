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
		<div class="text-center"><?php if(isset($msg)){ echo $msg ; }?><?php if(isset($_GET['error'])){echo $_GET['error'];}  ?></div>
		<div class="container-fluid user">
			<div class="row">
				<div class="col-lg-4"></div>
				<?php 
					if(isset($_GET['section']) && $_GET['section'] == 'code'){
						?>
					<form action="/projet3/index.php?action=code" method="POST" class="form-signin col-lg-4" style="float: none;">
							<fieldset>
							<label for="mail" class="col-form-label list-inline-item">Entrez le code que vous avez reçu par mail : </label>
							<input type="text" name="verif_code" class="form-control" placeholder="Code de recuperation"><br />
							<input type="submit" name="submit_code" value="Envoyer" class="btn btn-lg btn-primary btn-block">
							</fieldset>
					</form>

					
					<?php
					}
					elseif(isset($_GET['section']) && $_GET['section'] == 'changmdp')
					{
					?>
					<form action="/projet3/index.php?action=changmdp" method="POST" class="form-signin col-lg-4" style="float: none;">
							<fieldset>
							<label for="mail" class="col-form-label list-inline-item">Nouveau mot de passe : </label>
							<input type="password" name="pass_1" class="form-control"><br />
							<input type="password" name="pass_2" class="form-control"><br />
							<input type="submit" name="submit_pass" value="Envoyer" class="btn btn-lg btn-primary btn-block">
							</fieldset>
					</form>
					<?php 
					}
					else
					{
					?>	
					<form action="/projet3/index.php?action=recup" method="POST" class="form-signin col-lg-4" style="float: none;">
							<fieldset>
							<label for="mail" class="col-form-label list-inline-item">Indiquez votre adresse Mail : </label>
							<input type="email" name="recup_mail" class="form-control" placeholder="Indiquez votre mail"><br />
							<input type="submit" name="recup_submit" value="Connexion" class="btn btn-lg btn-primary btn-block">
							</fieldset>
					</form>
					
					<?php 
					}
					?>
					

				
				</div>
			</div>

        <?php $content = ob_get_clean(); ?>
        <?php require('template.php'); ?>

      </body>
</html>