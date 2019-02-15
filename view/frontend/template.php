
<?php
session_start();
if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
{
    $welcom = 'Bonjour ' . $_SESSION['pseudo'].'</br>';
    $lien = '<a class="navbar-brand" href="index.php?action=online">Bonjour  '. $_SESSION['pseudo'].'</a>';
    $statu = '<a class="navbar-brand" href="view/backend/deconexion.php">Deconexion</a>';
    
}
else
{
    $lien = '<p class="navbar-brand" >Bonjour</p>';
    $statu = '<a class="navbar-brand" href="view/frontend/userView.php">Connexion</a>';
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <link href="/projet3/public/css/bootstrap.min.css" rel="stylesheet">
        <link href="/projet3/public/css/style.css" rel="stylesheet" /> 
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <script type="text/javascript" src="/projet3/public/js/ckeditor/ckeditor.js"></script>
    </head>
    <header class="blog-header py-3 text-center container-fluid">
        <div class="row">
        <div class="col-lg-3"></div>
    	<div class="col-lg-6"><h1>Billet simple pour l'Alaska</h1>
        <p class="title_blog">Blog de Jean Forteroche</p>
        </div>
        <div class="col-lg-3"></div>
        </div>
    	
    </header>


    <div class="navbar navbar-inverse">
        <div class="container-fluid navbar-expand-lg navbar-light bg-light border">
        
        <div class="navbar-header">
            <a href="#" class="navbar-brand"><h3><?= $h_1 ?></h3></a>
        </div>
        <ul class=" nav nav-bar lien">
            <li class="active"><a class="navbar-brand" href="/projet3/index.php"><i class="fas fa-home"> Accueil</i></a></li>
            <li><?php echo $statu; ?></li>
            <li><?php echo $lien; ?></li>
        </ul>

        
        </div>
    </div>

    <body class="">
        <?= $content ?>
    </body>

    <footer>
        <div class="container">
            <div class="row">
    	       <div class="col-lg-4"></div>
    	       <div class="col-lg-4"><h3 class="text-center"> ZIBELLI Ludovic</h3></div>
    	       <div class="col-lg-4"></div>
    		</div>
    	</div>
    </footer>
</html>