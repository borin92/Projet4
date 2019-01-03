<?php $title = 'Billet simple pour l Alaska'; ?>

<?php ob_start(); ?>
<?php if (!isset($_SESSION)) {
    session_start();
} ?>

<?php
if (!empty($_SESSION))
//session start si c'est pas deja fais
{?>

   
  

    <?php   
    if ($_SESSION['statu']=='user')
        //si session = user
    {
    ?>
    <h3 class="bonjour">Bonjour <?= $_SESSION['username']?></h3>
    <?php
        while ($data = $posts->fetch())
        {

        ?>       
            <h2 class="post-title">
            <a href="index.php?action=post&amp;id=<?= $data['id'] ?>"><?= htmlspecialchars($data['title']) ?>               
                <em>le <?= $data['creation_date_fr'] ?></em>
                </h2>
                <h3 class="post-subtitle" style="font-weight: 100">
                <?php 
                    $rest = substr($data['content'],0,100);
                ?>
                <?= nl2br($rest) ?>
                ...
            </a>
            <br />
            <em><a href="index.php?action=post&amp;id=<?= $data['id'] ?>">Commentaires</a></em>
            </h3>
            <hr>
        <?php
        }
        $posts->closeCursor();
    ?>
    <?php
    }
    if ($_SESSION['statu'] =='admin')
        
        //si session =admin         
    {
    ?>
    <div class="contAdm">
        <div class="col-sm-6">
            <div class="">
                <div class="post-preview">           
                    <form action="index.php?action=addPost" method="post">         
                        <div>
                            <label for="addPostTitle"><strong><em>Ajoutez le titre ici</em></strong> </label><br/>
                            <textarea class="addPostContentTitle" name="addPostContentTitle"></textarea><br/>
                            <label for="addPostContent"><strong><em>Ajoutez le contenu de l'article ici</em> </strong></label>
                            <textarea  name="addPostContent" id="addPostContent" rows="10" cols="80"></textarea><br/>
                            <script>
                                CKEDITOR.replace( 'addPostContent' );
                            </script>      
                        </div>
                        <div>
                            <input type="submit" class="btn btn-primary">
                        </div>
                    </form>
                    <?php while ($data = $posts->fetch())
                        {
                            $n =1;
                            $postId =  $data['id'];  
                        ?>        
                        <h2 class="post-title">
                        <div>
                            <!-- Modal supprimer -->
                            <div class="modal fade" id="myModalSup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content modalContent">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
                                  </div>
                                  <div class="modal-body">
                                    <p>Etes vous sûr de vouloir supprimer ce billet ?</p>
                                  </div>
                                  <div class="modal-footer">
                                    <button class="boutonCheck btn-success btn-md"><a href="index.php?action=deletPost&amp;id=<?=  $postId?>" title="Signaler">Oui supprimer !</a></button>
                                    <button class="boutonCheck btn-danger btn-md" data-dismiss="modal">Non sors moi de là!</button>
                                  </div>
                                </div>
                              </div>
                            </div>   
                        </div>
                        <a href="index.php?action=post&amp;id=<?= $data['id'] ?>"><?= $data['title'] ?>
                    
                        <em>le <?= $data['creation_date_fr'] ?></em>
                        </h2>

                        <h3 class="post-subtitle" style="font-weight: 100">
                        <?php 
                            $rest = substr(strip_tags($data['content']),0,200);
                        ?>
                        <?= nl2br($rest); echo "..."; ?>
                        <br />
                        <em><a href="index.php?action=post&amp;id=<?= $data['id'] ?>">Commentaires</a></em>   
                        </h3></a>
                            <button type="button" id="mymodal" class=" btn btn-outline-danger btn-md" data-toggle="modal" data-target="#myModalSup"  >
                            <i class="fas fa-trash-alt"></i>
                            </button>
                        <hr>
                <?php $n++; } $posts->closeCursor(); ?>
                </div>       
            </div>
        </div>
        <div class="col-sm-6 ">
            <div class="col-lg-6 col-md-6 mx-auto">
                <div class="post-preview ">
                    <?php $i = 0;?>
                        
                    <div class="alert alert-success" role="alert">
                        <h4 class="alert-heading">Dernieres nouvelles!</h4>
                        <p>Voici les commentaires signalés</p>
                        <hr>
                        <p class="mb-0">Cliquez directement sur le nom de l'épisode pour acceder aux commentaires</p>
                    </div>
                    <?php while ($rep = $comRep -> fetch()) { ?>
                        <?php if($rep['post_id'] == $i){ ?>
                            <div class="alert alert-danger">
                            <a href="index.php?action=post&amp;id=<?= $rep['post_id'] ?>">
                                <p><?php echo ($rep['author']);?> a dit:&nbsp;&nbsp;</p>
                                <p><?php echo ($rep['comments']); ?></p>
                            </a>
                            </div>     
                            <?php } else { ?>
                            <div >
                                <hr> 
                                <h4><?php echo "au post numero #" . $rep['post_id']; ?> </h4>
                                <div style="display: flex;" class="alert alert-danger">
                                <a class="flex" href="index.php?action=post&amp;id=<?= $rep['post_id'] ?>">
                                    <p><?php echo ($rep['author']);?> a dit:&nbsp;&nbsp;</p>
                                    <p><?php echo ( $rep['comments']);?></p>
                                    <?php $i = $rep['post_id'];?>
                                </a>
                                </div>
                            </div>
                       <?php } ?>
                    <?php  }  ?>
                    <hr>
                <?php  $posts->closeCursor(); ?>
                </div>       
            </div>
        </div>
    </div>
<?php } ?>
<?php } ?>

<?php   
if (empty($_SESSION))
   
{
?>
<?php
    while ($data = $posts->fetch())
    {
    ?>
        <h2 class="post-title">
        <a href="index.php?action=post&amp;id=<?= $data['id'] ?>"><?= htmlspecialchars($data['title']) ?>               
        <em>le <?= $data['creation_date_fr'] ?></em>
        </h2>

        <h3 class="post-subtitle" style="font-weight: 100">
        <?php 
            $rest = substr($data['content'],0,100);
        ?>
        <?= nl2br(strip_tags($rest));?>
        ...
        <br /></a>
        <em><a href="index.php?action=post&amp;id=<?= $data['id'] ?>#com">Commentaires</a></em>
        </h3>
        <hr>
    <?php
    }
    $posts->closeCursor();
    ?>
<?php
}
?>

<?php $content = ob_get_clean(); ?>
<?php require_once('template.php'); ?>

