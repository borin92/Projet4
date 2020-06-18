<?php $title = 'Billet simple pour l Alaska'; ?>

<?php ob_start(); ?>
<div class="container">
	<div class="row">
		
		<div class="col-sm" id='test'>
			<h2 class="h2Inscription">Inscription</h2>
			<form action="newUser" method="post">
				<div>
					<label>pseudo</label>
					<input type="text" name="username" class="input" required/>
				</div>

				<div>
					<label>email</label>
					<input type="text" name="email" class="input" required/>
				</div>
				<div>
					<label>mot de passe</label>
					<input type="password" name="password" class="input" required/>
				</div>
						<br>
						<input type="submit" class="btn btn-primary btn-md">
				</form>
		</div>
		<hr>
		<div class="col-sm" >
			<p id="click">déjà inscrit ?</p>
			<div class="login col-sm" id="login" >
				<h2 class="h2Inscription">Connectez vous ici</h2>
				<form action="login" method="post">
				<div>
					<label>pseudo</label>
					<input type="text" name="username" class="input" required/>
				</div>
				<div>
					<label>mot de passe</label>
					<input type="password" name="password" class="input" required/>
				</div>
					<br>
					<input type="submit" class="btn btn-primary btn-md">
				</form>
			</div>
			<script>
				var a;
				a = document.getElementById("click");
				a.addEventListener("click",function(){
					document.getElementById('test').style.display="none";
					document.getElementById('login').style.display="contents";
					a.style.display = "none"; 
				})
			</script>
		</div>
	</div>	
</div>







<?php $content = ob_get_clean(); ?>
<?php require_once('template.php'); ?>