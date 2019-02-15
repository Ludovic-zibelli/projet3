<?php $title='Mon blog' ?>
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
                                <strong><h1 class="blog-post-title text-center"><?php echo ($data['title']); ?></h1></strong>
                                <h4 class="blog-post-title">Chapitre : <?php echo ($data['chapitre']); ?></h4>
                                <p class="blog-post-meta">le <?php echo $data['creation_date_fr']; ?></p>
                                <blockquote><?php echo nl2br($data['content']); ?></blockquote>
                                <em><a class="btn btn-success" href="index.php?action=post&id=<?php echo $data['id']; ?>">Commentaires  <span class="badge badge-light"><?php echo ($nbr_comments); ?></span></a></em>
                            <hr>
                            </div>
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