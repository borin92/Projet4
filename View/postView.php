<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>
<h1>Billet simple pour l Alaska!</h1>
<p><a href="index.php">Retour à la liste des billets</a></p>
<div>
    <ul>
        <li><a  href="index.php?action=post&amp;id=<?= 1?>">Episode 1 </a></li>
        <li><a  href="index.php?action=post&amp;id=<?= 2?>">Episode 2 </a></li>
        <li><a  href="index.php?action=post&amp;id=<?= 3?>">Episode 3</a></li>
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

<?php
while ($comment = $comments->fetch())
{
?>
    <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?></p>
    <p><?= nl2br(htmlspecialchars($comment['comments'])) ?></p>


<?php
}
?>
	
	<form action="index.php?action=addComment&amp;id= <?= $post['id'] ?>" method="post">
		<?php echo $post['id'] ?>
	    <div>
	        <label for="author">Auteur</label><br />
	        <input type="text" id="author" name="author" />
	    </div>
	    <div>
	        <label for="comment">Commentaire</label><br />
	        <textarea id="comment" name="comment"></textarea>
	      
	    </div>
	    <div>
	        <input type="submit" />
	    </div>
	</form>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
