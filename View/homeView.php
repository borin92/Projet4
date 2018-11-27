<?php $title = 'Billet simple pour l Alaska'; ?>

<?php ob_start(); ?>


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
<?php $content = ob_get_clean(); ?>
<?php require_once('template.php'); ?>

