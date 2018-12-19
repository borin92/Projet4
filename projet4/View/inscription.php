<?php $title = 'Billet simple pour l Alaska'; ?>

<?php ob_start(); ?>
<div class="container">
	<div class="row">
		
		<div class="col-sm" id='test'>
			<h2>Inscription</h2>
			<form action="index.php?action=newUser" method="post">
				<div>
					<label for="username">psudo</label>
					<input type="text" name="username" class="input" required/>
				</div>

				<div>
					<label for="email">email</label>
					<input type="text" name="email" class="input" required/>
				</div>
				<div>
					<label for="password">mdp</label>
					<input type="password" name="password" class="input" required/>
				</div>
						<input type="submit">
				</form>
		</div>
		<hr>
		<div class="col-sm" >
			<p id="click">deja inscrit ?</p>
			<div class="login col-sm" id="login" >
				<p>connecter vous ici</p>
				<form action="index.php?action=login" method="post">
				<div>
					<label for="username">psudo</label>
					<input type="text" name="username" class="input" required/>
				</div>
				<div>
					<label for="password">mdp</label>
					<input type="password" name="password" class="input" required/>
				</div>
					<input type="submit">
				</form>
			</div>
			<script>
				var a;
				a = document.getElementById("click");
				a.addEventListener("click",function(){
					document.getElementById('test').style.display="none";
					document.getElementById('login').style.display="contents";
				})
			</script>
		</div>
	</div>	
</div>







<?php $content = ob_get_clean(); ?>
<?php require_once('template.php'); ?>