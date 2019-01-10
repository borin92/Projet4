<?php $title = 'Billet simple pour l"Alaska'; ?>

<?php ob_start(); ?>
<p>Vous n'avez pas rempli les champs corrctement</p>
<div class="alert alert-danger">
    <?php foreach ($errors as $error): ?>
        
        <li><?=$error; ?></li>
    <?php endforeach; ?>
    <form action="newUser" method="post" class="formFail">
    <div>
        <label for="username">pseudo</label>
        <input type="text" name="username" required/>
    </div>

    <div>
        <label for="email">email</label>
        <input type="text" name="email" required/>
    </div>
    <div>
        <label for="password">mot de passe</label>
        <input type="password" name="password" required/>
    </div>
</br>
    <input type="submit" class="btn btn-primary md">
    
</form>
</div>
<?php $content = ob_get_clean(); ?>
<?php require_once('template.php'); ?>

