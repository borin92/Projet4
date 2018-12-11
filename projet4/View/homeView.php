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
    //affichage bonjour + username si session == true
    if (isset($_SESSION['username']))
    {
    ?>
        <h3>Bonjour <?= $_SESSION['username']?></h3>
    <?php
    }
    ?>

    <?php   
    if ($_SESSION['statu']=='user')
        //si session = user
    {
    ?>
    <?php
        while ($data = $posts->fetch())
        {

        ?>       
            <h2 class="post-title">
            <a href="index.php?action=post&amp;id=<?= $data['id'] ?>"><?= htmlspecialchars($data['title']) ?></a>               
            <em>le <?= $data['creation_date_fr'] ?></em>
            </h2>

            <h3 class="post-subtitle" style="font-weight: 100">
            <?= nl2br(htmlspecialchars($data['content_resume'])) ?>
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
        <form action="index.php?action=addPost" method="post">         
            <div>
                <label for="addPostContent">ajouter le contenue d l'article ici </label><br/>
                <textarea class="addPostContent" name="addPostContent"></textarea><br/>
                <label for="addPostContentResume">ajouter le resumé ici </label><br/>
                <textarea class="addPostContentResume" name="addPostContentResume"></textarea>
                <label for="addPostTitle">ajouter le titre ici </label><br/>
                <textarea class="addPostContentTitle" name="addPostContentTitle"></textarea>
              
            </div>
            <div>
                <input type="submit">
            </div>
        </form>
        <?php
            while ($data = $posts->fetch())
            {
                $n =1;
                $postId =  $data['id'];  
            ?>        
                <p>salut je suis admin</p>
                <h2 class="post-title">
                    <div>
                        <a href="index.php?action=deletPost&amp;id=<?=  $postId?>">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                       
                    </div>
                    <a href="index.php?action=post&amp;id=<?= $data['id'] ?>"><?= htmlspecialchars($data['title']) ?></a>
                    
                    <em>le <?= $data['creation_date_fr'] ?></em>
                </h2>

                <h3 class="post-subtitle" style="font-weight: 100">
                    <?= nl2br(htmlspecialchars($data['content_resume'])) ?>
                    <br />
                    <em><a href="index.php?action=post&amp;id=<?= $data['id'] ?>">Commentaires</a></em>
                    
                </h3>
                <hr>
            <?php
        $n++;
        }
        $posts->closeCursor();
    ?>
    <?php
    }
?>
<?php
}
?>

<?php   
if (empty($_SESSION))
    //si session = user
{
?>
<?php
    while ($data = $posts->fetch())
    {
    ?>
        <h2 class="post-title">
        <a href="index.php?action=post&amp;id=<?= $data['id'] ?>"><?= htmlspecialchars($data['title']) ?></a>               
        <em>le <?= $data['creation_date_fr'] ?></em>
        </h2>

        <h3 class="post-subtitle" style="font-weight: 100">
        <?= nl2br(htmlspecialchars($data['content_resume'])) ?>
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
?>

<?php $content = ob_get_clean(); ?>
<?php require_once('template.php'); ?>

