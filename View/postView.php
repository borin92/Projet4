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
                <p><a href="Homepage">Retour à la liste des billets</a></p>
                <div>
                    <ul>
                        <?php $n = 1;              
                        while ($data = $posts->fetch()){ ?>
                            <li><a  href="post/<?= $data['id']?>">Episode <?= $n?> </a></li>
                            <?php $n++;
                        }?>
                    </ul>
                </div>
                <div class="news">
                    <h3>
                        <?= $post['title'] ?>
                        <em>le <?= $post['creation_date_fr'] ?></em>
                    </h3>
                    
                    <p>
                        <?= nl2br($post['content']) ?>
                    </p>
                </div>
                <h2 id="com">Commentaires</h2>
                <?php while ($comment = $comments->fetch()) { ?>
                <div class="webkit container">
                    <button type="button" id="mymodal" class=" btn btn-outline-secondary btn-lg" data-toggle="modal" data-target="#myModalSup"  >
                        <i class="fas fa-flag-checkered"></i>
                    </button>

                    <!-- Modal supprimer -->
                    <div class="modal fade" id="myModalSup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content modalContent">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
                          </div>
                          <div class="modal-body">
                            <p>Etes vous sûr de vouloir signaler ce commentaire, il sera remonté à l'administrateur pour être modéré, continuer ?</p>
                          </div>
                          <div class="modal-footer">
                            
                            <button class="boutonCheck btn-success"><a href="reportPost/<?= $comment['id']?>/<?= $post['id']?>" title="Signaler">Oui signaler !</a></button>
                            <button class="boutonCheck btn-danger" data-dismiss="modal">Non sort moi de la !</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-8 col-md-7 com"> 
                        <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?></p>
                        <p><?= nl2br(htmlspecialchars($comment['comments'])) ?></p>
                    </div>
                </div>
                <?php } ?>
                <form action="addComment<?= $post['id'] ?>" method="post">
              

                        <div>
                            <label for="comment">Commentaire</label><br />
                            <textarea id="comment" name="comment" style="width: 60%"></textarea> 
                        </div>
                        <div>
                            <input type="submit" class="btn btn-primary btn-md" />
                        </div>
                    </form>    
                
        
        <?php $posts->closeCursor(); ?>
        <?php $content = ob_get_clean(); ?>
    <?php } ?>
    <!-- /////////////// AFFICHAGE DES POSTS ET DES COMMENTAIRE EN USER ///////////////  -->


    <!-- /////////////// AFFICHAGE DES POSTS ET DES COMMENTAIRE EN ADMIN ///////////////  -->
    <?php if ($_SESSION['statu']=='admin'){?>
        <?php ob_start(); ?>
        <div class="container">
            <h1>Billet simple pour l'Alaska!</h1>
            <p><a href="Homepage">Retour à la liste des billets</a></p>
            <div>
                <ul>
                    <?php $n = 1;              
                    while ($data = $posts->fetch()){ ?>
                        <li><a  href="post/<?= $data['id']?>">Episode <?= $n?> </a></li>
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


                <form action="updatePost/<?= $post['id'] ?>" method="post">
                    <div>
                    <label for="content">modifier le post</label><br />
                    <textarea id="content" name="content"rows="30" style="width: 100%" >
                        <?= $post['content']?>
                    </textarea>
                    <script src="js/ckeditor/ckeditor.js"></script>
                    <script>
                       CKEDITOR.replace('content', {height: 500});
                    </script>
                    </div>
                    <div>
                        <input type="submit" class="btn btn-primary btn-md" />
                    </div>
                </form>

            </div>
            <h2 id="com">Commentaires</h2>
            <?php while ($comment = $comments->fetch()) { ?>
                <?php if ($comment['report'] == 0) { ?> 
                    <div class="container">
                    <div class="row">
                         <button type="button" id="mymodal" class="boutonNonRep btn btn-danger btn-lg" data-toggle="modal" data-target="#myModalSup"  >
                            <i class="fas fa-ban"></i> 
                        </button>

                        <!-- Modal supprimer -->
                        <div class="modal fade" id="myModalSup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content modalContent">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
                              </div>
                              <div class="modal-body">
                                <p>Etes vous sûr de vouloir supprimer ce commentaire ?</p>
                              </div>
                              <div class="modal-footer">
                                <button class="boutonCheck btn-success"><a href="deleteComment/<?= $comment['id']?>/<?= $post['id']?>">Oui, je veux le supprimer</a></button>
                                <button class="boutonCheck btn-danger "><a href="valideComment/<?= $comment['id']?>/<?= $post['id']?>">Non, je voulais cliquer</br> sur valider</a></button>
                              </div>
                            </div>
                          </div>
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
                    <div class="adminReport row " style="border:1px red solid;">
                        <button type="button" id="mymodal" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#myModalSup"  >
                            <i class="fas fa-ban"></i> 
                        </button>
                        <button type="button" id="mymodal" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModalVal"  >
                            <i class="fas fa-check-circle"></i> 
                        </button>

                        <!-- Modal supprimer -->
                        <div class="modal fade" id="myModalSup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content modalContent">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
                              </div>
                              <div class="modal-body">
                                <p>Etes vous sûr de vouloir supprimer ce commentaire ?</p>
                              </div>
                              <div class="modal-footer">
                                <button class="boutonCheck btn-success"><a href="deleteComment/<?= $comment['id']?>/<?= $post['id']?>">Oui, je veux le supprimer</a></button>
                                <button class="boutonCheck btn-danger "><a href="valideComment/<?= $comment['id']?>/<?= $post['id']?>">Non, je voulais cliquer</br> sur valider</a></button>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- Modal Valider -->
                        <div class="modal fade" id="myModalVal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content modalContent">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
                              </div>
                              <div class="modal-body">
                                <p>Vous êtes sur le point d'approuver un commentaire signalé, continuer ?</p>
                              </div>
                              <div class="modal-footer">

                                <button class="boutonCheck btn-success "><a href="valideComment/<?= $comment['id']?>/<?= $post['id']?>">Oui, je veux le valider</a></button>
                                <button class="boutonCheck btn-danger "><a href="deleteComment/<?= $comment['id']?>/<?= $post['id']?>">Non, je voulais cliquer </br> sur supprimer</a></button>
                              </div>
                            </div>
                          </div>
                        </div>         
                        <div class="col-lg-8 col-md-7">
                            <p style="color: red;">(CE COMMENTAIRE A ETE SIGNALE)</p>
                            <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?></p>
                            <p><?= nl2br(htmlspecialchars($comment['comments'])) ?></p>
                        </div>
                    </div>
                </div>

               <?php } ?>  
            <?php } ?>
            <form action="addComment/<?= $post['id'] ?>" method="post">
                <div>
                    <label for="comment">Commentaire</label><br />
                    <textarea id="comment" name="comment" style="width: 60%"></textarea>                
                </div>
                <div>
                    <input type="submit" class="btn btn-primary btn-md" />
                </div>
            </form>
        </div>
            
             <?php $posts->closeCursor(); ?>
        <?php $content = ob_get_clean(); ?>  
    <?php }?> 
    <!-- /////////////// AFFICHAGE DES POSTS ET DES COMMENTAIRE EN amin ///////////////  -->
    <?php require('template.php'); ?>


<?php }?>
<!-- /////////////// SI IL Y A UNE SESSION ///////////////  -->


<!-- /////////////// SI IL Y A PAS DE SESSION ///////////////  -->
<?php if (empty($_SESSION)){?>
    <?php ob_start(); ?>
        <h1>Billet simple pour l Alaska!</h1>
        <p><a href="Homepage">Retour à la liste des billets</a></p>
        <div>
            <ul>
                <?php $n = 1;              
                while ($data = $posts->fetch()){ ?>
                    <li><a  href="post/<?= $data['id']?>">Episode <?= $n?> </a></li>
                    <?php $n++;
                }?>
            </ul>
        </div>
        <div class="news">
            <h3>
                <?= $post['title'] ?>
                <em>le <?= $post['creation_date_fr'] ?></em>
            </h3>
            
            
                <?= nl2br(htmlspecialchars_decode($post['content'])) ?>
       
        </div>
        <h2 id="com">Commentaires</h2>
        <?php while ($comment = $comments->fetch()) { ?>
            <div class="container" >
                <div class="row">
                    <div class="col-lg-8 col-md-7"> 
                        <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?></p>
                        <p><?= nl2br(htmlspecialchars($comment['comments'])) ?></p>
                    </div>
                </div>
            </div>
        <?php } ?>
         <p>Pour poster des commentaires ou signaler un contenu <a href="inscription" >connectez vous ici</a> </p>
        <?php $posts->closeCursor(); ?>
    <?php $content = ob_get_clean(); ?>
    
<?php }?>
<?php require_once('template.php'); ?>
<!-- /////////////// SI IL Y A PAS DE SESSION ///////////////  -->



