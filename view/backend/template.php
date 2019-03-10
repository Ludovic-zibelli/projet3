<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>

        <meta name="description" content="Blog du dernier ouvrage de Jean Forteroche qui n'est pas encore écrie... mais il sera publié sur ce site !" />
        <meta property="og:type" content="article" />
        <meta property="og:title" content="<?= $title ?>" />
        <meta property="og:url" content="https://www.pierrefay.fr/premier-sur-google/mettre-en-place-donnees-structurees-site.html" />
        <meta property="og:site_name" content="Billet simple pour l'Alaska" />
        <meta property="og:description" content="Blog du dernier ouvrage de Jean Forteroche qui n'est pas encore écrie... mais il sera publié sur ce site !" />

        <link href="/public/css/bootstrap.min.css" rel="stylesheet">
        <link href="/public/css/style.css" rel="stylesheet" /> 
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <script type="text/javascript" src="/public/js/tiny_mce/tiny_mce.js"></script>
        
        <script>
          tinymce.init({
            selector: 'textarea',
            height: 500,
            entity_encoding : "raw",

          });
        </script>
    </head>


<header class="blog-header py-3 text-center container-fluid">
        <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6"><a href="/index.php" class="navbar-brand titre"><h1>Billet simple pour l'Alaska</h1></a>
        <p class="title_blog">Blog de Jean Forteroche</p>
        </div>
        <div class="col-lg-3"></div>
        </div>
        
</header>
        
  

    <div class="navbar navbar-inverse nav_site bg-light">
        <div class="container-fluid navbar-expand-lg navbar-light bg-light">
        
        <div class="navbar-header">
            <a href="#" class="navbar-brand"><h3><?= $h_1 ?></h3></a>
        </div>
        <h3><ul class=" nav nav-bar lien">
            <li class="active"><a class="navbar-brand" href="/index.php"><i class="fas fa-home"> Accueil</i></a></li>
            <li><a class="navbar-brand" href="view/backend/addPostView.php">Ajouter un billet</a></li>
            <li><a class="navbar-brand" href="view/backend/deconexion.php">Déconnexion</a></li>
        </ul></h3>

        
        </div>
    </div>

    <body>
        <div  class="text-center"><a class="nav-link" href="/index.php?action=online">Retour a l'accueil de l'admin</a></div>
        
        <?= $content ?>
    </body>

    <footer>
        <div class="container">
            <div class="row">
               <div class="col-lg-4">
                    <ul class="nav flex-column text-align">
                        <li class="nav-item"><a href="#">Contact</a></li>
                        <li class="nav-item"><a href="#">Mentions légales</a></li>  
                    </ul> 
               </div>
               <div class="col-lg-4"><h4 class="text-center copyright"><i class="far fa-copyright"> Copyright Jean Forteroche 2019</i></h4></div>
               <div class="col-lg-4">
                    <div class="container  text-center">
                        <div class="row">
                            <h4 class="col-lg-12">Réseaux sociaux</h4></br>
                        </div>
                        <div class="row reseau">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-2"><a href="#"><img src="/public/images/facebook.png"></a></div>
                            <div class="col-lg-2"><a href="#"><img src="/public/images/twitter.png"></a></div>
                            <div class="col-lg-2"><a href="#"><img src="/public/images/Snapchat.png"></a></div>
                        </div> 
               </div>
            </div>
        </div>
    </footer>
</html>