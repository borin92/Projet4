<?php $title = 'Billet simple pour l Alaska'; ?>

<?php ob_start(); ?>
<p>vous n'avez pas remplis les champ corrctements</p>
<div class="alert alert-danger">
    <?php foreach ($errors as $error): ?>
        
        <li><?=$error; ?></li>
    <?php endforeach; ?>
    <form action="index.php?action=newUser" method="post">
    <div>
        <label for="username">psudo</label>
        <input type="text" name="username" required/>
    </div>

    <div>
        <label for="email">email</label>
        <input type="text" name="email" required/>
    </div>
    <div>
        <label for="password">mdp</label>
        <input type="password" name="password" required/>
    </div>
    <input type="submit">
    
</form>
</div>
<?php $content = ob_get_clean(); ?>
<?php require_once('template.php'); ?>

