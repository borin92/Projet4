<?php $title = htmlspecialchars($post['title']); ?>
<?php if (!isset($_SESSION)) {
    session_start();
} ?>


<!-- /////////////// SI IL Y A UNE SESSION ///////////////  -->
<?php if (!empty($_SESSION)){?>

    <!-- /////////////// AFFICHAGE DES POSTS ET DES COMMENTAIRE EN USER ///////////////  -->
    <?php if ($_SESSION['statu']=='user'){ ?>
        <?php ob_start(); ?>
        <h1>Billet simple pour l Alaska!</h1>
        <p><a href="index.php">Retour à la liste des billets</a></p>
        <div>
            <ul>
                <?php $n = 1;              
                while ($data = $posts->fetch()){ ?>
                    <li><a  href="index.php?action=post&amp;id=<?= $data['id']?>">Episode <?= $n?> </a></li>
                    <?php $n++;
                }?>
            </ul>
        </div>
        <div class="news">
            <h3>
                <?= htmlspecialchars($post['title']) ?>
                <em>le <?= $post['creation_date_fr'] ?></em>
            </h3>
            
            <p>
                <?= nl2br(htmlspecialchars($post['content'])) ?>
            </p>
        </div>
        <h2>Commentaires</h2>
        <?php while ($comment = $comments->fetch()) { ?>
            <div class="container">
                <div class="row">
                    <div class="divFlag">
                        <a href="index.php?action=reportPost&amp;id=<?= $comment['id']?>" title="Signaler"><i class="fas fa-flag-checkered"></i></a>
                    </div>
                    <div class="col-lg-8 col-md-7"> 
                        <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?></p>
                        <p><?= nl2br(htmlspecialchars($comment['comments'])) ?></p>
                    </div>
                </div>
            </div>
        <?php } ?>
        <form action="index.php?action=addComment&amp;id= <?= $post['id'] ?>" method="post">
                <div>
                    <label for="comment">Commentaire</label><br />
                    <textarea id="comment" name="comment" style="width: 60%"></textarea>
                  
                </div>
                <div>
                    <input type="submit" />
                </div>
            </form>    
        
        
        <?php $posts->closeCursor(); ?>
        <?php $content = ob_get_clean(); ?>
    <?php } ?>
    <!-- /////////////// AFFICHAGE DES POSTS ET DES COMMENTAIRE EN USER ///////////////  -->


    <!-- /////////////// AFFICHAGE DES POSTS ET DES COMMENTAIRE EN ADMIN ///////////////  -->
    <?php if ($_SESSION['statu']=='admin'){?>
        <?php ob_start(); ?>
            <h1>Billet simple pour l Alaska!</h1>
            <p><a href="index.php">Retour à la liste des billets</a></p>
            <div>
                <ul>
                    <?php $n = 1;              
                    while ($data = $posts->fetch()){ ?>
                        <li><a  href="index.php?action=post&amp;id=<?= $data['id']?>">Episode <?= $n?> </a></li>
                        <?php $n++;
                    }?>
                </ul>
            </div>
            <div class="news">
                <h3>
                    <?= htmlspecialchars($post['title']) ?>
                    <em>le <?= $post[3]; ?></em>
                </h3> 
                <p>


                <form action="index.php?action=updatePost&amp;id= <?= $post['id'] ?>" method="post">
                    <div>
                    <label for="content">modifier le post</label><br />
                    <textarea id="content" name="content"rows="20" style="width: 100%">
                        <?= $post['content']?>
                    </textarea>
                    </div>
                    <div>
                        <input type="submit"/>
                    </div>
                </form>

            </div>
            <h2>Commentaires</h2>
            <?php while ($comment = $comments->fetch()) { ?>
                <?php if ($comment['report'] == 0) { ?> 
                    <div class="container">
                    <div class="row">
                        <div class="divFlag">
                            <a  class="btn btn-danger" href="index.php?action=deleteComment&amp;id=<?= $comment['id']?>&amp;postId=<?= $post['id']?>" title="supprimer"><i class="fas fa-ban"></i></a>
                        </div>
                        <div class="col-lg-8 col-md-7"> 
                            <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?></p>
                            <p><?= nl2br(htmlspecialchars($comment['comments'])) ?></p>
                        </div>
                    </div>
                </div>
               <?php } ?>

               <?php if ($comment['report'] == 1) { ?>
                    <div class="container">
                    <div class="row" style="border:1px red solid;">
                        <div class="divFlag">
                            <a  class="btn btn-danger" href="index.php?action=deleteComment&amp;id=<?= $comment['id']?>&amp;postId=<?= $post['id']?>" title="supprimer"><i class="fas fa-ban"></i></a>
                            <a class="btn btn-success" href="index.php?action=valideComment&amp;id=<?= $comment['id']?>&amp;postId=<?= $post['id']?>" title="supprimer" ><i class="far fa-check-circle"></i></a>
                        </div>
                        <div class="col-lg-8 col-md-7">
                            <p style="color: red;">(CE COMMENTAIRE A ETE SIGNALEZ)</p>
                            <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?></p>
                            <p><?= nl2br(htmlspecialchars($comment['comments'])) ?></p>
                        </div>
                    </div>
                </div>
               <?php } ?>  
            <?php } ?>
            <form action="index.php?action=addComment&amp;id= <?= $post['id'] ?>" method="post">
                <div>
                    <label for="comment">Commentaire</label><br />
                    <textarea id="comment" name="comment" style="width: 60%"></textarea>
                  
                </div>
                <div>
                    <input type="submit" />
                </div>
            </form>
             <?php $posts->closeCursor(); ?>
        <?php $content = ob_get_clean(); ?>  
    <?php }?> 
    <!-- /////////////// AFFICHAGE DES POSTS ET DES COMMENTAIRE EN amin ///////////////  -->
    <?php require('template.php'); ?>


<?php }?>
<!-- /////////////// SI IL Y A UNE SESSION ///////////////  -->


<!-- /////////////// SI IL Y A PAS DE SESSION ///////////////  -->
<?php if (empty($_SESSION)){?>
        <h1>Billet simple pour l Alaska!</h1>
        <p><a href="index.php">Retour à la liste des billets</a></p>
        <div>
            <ul>
                <?php $n = 1;              
                while ($data = $posts->fetch()){ ?>
                    <li><a  href="index.php?action=post&amp;id=<?= $data['id']?>">Episode <?= $n?> </a></li>
                    <?php $n++;
                }?>
            </ul>
        </div>
        <div class="news">
            <h3>
                <?= htmlspecialchars($post['title']) ?>
                <em>le <?= $post['creation_date_fr'] ?></em>
            </h3>
            
            <p>
                <?= nl2br(htmlspecialchars($post['content'])) ?>
            </p>
        </div>
        <h2>Commentaires</h2>
        <?php while ($comment = $comments->fetch()) { ?>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-7"> 
                        <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?></p>
                        <p><?= nl2br(htmlspecialchars($comment['comments'])) ?></p>
                    </div>
                </div>
            </div>
        <?php } ?>
         <p>Pour poster des commentaires ou signalez un contenue <a href="index.php?action=inscription&amp;">connectez vous ici</a> </p>
        <?php $posts->closeCursor(); ?>
    <?php $content = ob_get_clean(); ?>
    <?php require('template.php'); ?>
<?php }?>
<!-- /////////////// SI IL Y A PAS DE SESSION ///////////////  -->



