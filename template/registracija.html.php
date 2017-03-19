<?php ob_start()?>
<?php $title = "Registracija"; ?>
<h2>Registracija</h2>
	<form method="post">
	<div class="form-group">
		<label for="inputUsername">Uporabniško ime</label>
		<input type="text" class="form-control" id="inputUsername" placeholder="Vpišite uporabniško ime" name="username">
	</div>
	<div class="form-group">
		<label for="inputPassword1">Geslo</label>
		<input type="password" class="form-control" id="inputPassword1" placeholder="Geslo" name="password1">
	</div>
	<div class="form-group">
		<label for="inputPassword2">Ponovite geslo</label>
		<input type="password" class="form-control" id="inputPassword2" placeholder="Ponovite geslo" name="password2">
	</div>

	<button type="submit" class="btn btn-default" name="register">Registracija</button>
	</form>
	
<?php
    echo registracija();
	$content=ob_get_clean();

	require "template/layout.html.php";

 ?>

    
