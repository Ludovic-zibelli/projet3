<?php 
//session_start();
if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
{
    header('location: /index.php?action=online');
    
}
?>
<?php $title='Connexion' ?>
<?php $h_1='Connexion' ?>

<?php ob_start(); ?>
	
		
		
		

			<div class="container-fluid user">
				<div class="row">
					<div class=" col-lg-12 text-center">
						<?php if(isset($_GET['msg'])){ echo $_GET['msg'] ; }?><?php if(isset($_GET['error'])){echo '<strong class="msg_error">'.$_GET['error'].'</strong>';}  ?>
					</div>
				</div>
				<div class="row">
				<div class="col-lg-4"></div>
				<form action="/connexion.html" method="POST" class="form-signin col-lg-4" style="float: none;">
							<fieldset>
							<label for="user" class="col-form-label list-inline-item">Identifiant : </label>
							<input type="text" name="user" class="form-control" placeholder="Identifiant">
							<label for="pass" class="col-form-label list-inline-item">Mot de passe : </label>
							<input type="password" name="pass" class="form-control" placeholder="Mot de passe"><br>
							<input type="submit" name="connexion" value="Connexion" class="btn btn-lg btn-primary btn-block">
							<div class="text-center"><a class="col-form-label list-inline-item" href="/view/frontend/recuperation.php">Mot de passe oublié ?</a></div>
							</fieldset>
				</form>
				
				</div>
			</div>
			
        <?php $content = ob_get_clean(); ?>
        <?php require('template.php'); ?>

 