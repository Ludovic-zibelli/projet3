<?php $title='Blog de Jean Forteroche - Billet simple pour l\'Alaska' ?>
<?php $h_1='' ?>

<?php ob_start(); ?>
       
    <body>
        
        
        
        <?php
        while ($data = $posts->fetch())
        {
            if($data['online'] == 1)
            {    
                    //Nombre de commentaire par billet 
                    $nbr_ligne = new openclassrooms\blog\model\commentManager();
                    $nbr_comments = $nbr_ligne->compteurComment($data['id']);
            ?>
            <main class="container">
                <div class="row">
                    <div class="col-md-12 blog-main">
                        <div class="blog-post">
                            <strong><h2 class="blog-post-title text-center"><?php echo ($data['title']); ?></h2></strong>
                                <h3 class="blog-post-title">Chapitre : <?php echo ($data['chapitre']); ?></h3>
                                <p class="blog-post-meta">le <?php echo $data['creation_date_fr']; ?></p>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-10"> 
                                            <blockquote><?php echo substr($data['content'], 0, 300).'...'; ?><a href="index.php?action=post&id=<?php echo $data['id']; ?>">Lire la suite</a></blockquote>
                                            <em><a class="btn btn-success" href="/<?php echo $data['id']; ?>.html">Commentaires  <span class="badge badge-light"><?php echo ($nbr_comments); ?></span></a></em>
                                        </div>
                                    <div class="col-lg-2">
                                        <?php if($data['pictures']){ $pictures = $data['pictures']; }else{ $pictures = 'defaut.jpg'; } ?>
                                        <img class="img_blog" src="/public/images/upload/<?php echo $pictures; ?>" alt="<?php echo $data['title']; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>       
            </main>
            <?php

            }
        }
        $posts->closeCursor();
        ?>

        <?php $content = ob_get_clean(); ?>
        <?php require('view/frontend/template.php'); ?>
    </body>
</html>