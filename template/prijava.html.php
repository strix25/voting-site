<?php ob_start();$Prijava = Prijava();?>
<?php $title = "Prijava"; ?>
<h2>Prijava</h2>
	<form method="post">
  <div class="form-group">
    <label for="inputUsername">Uporabniško ime</label>
    <input type="text" class="form-control" id="username" placeholder="Vpišite uporabniško ime" name="username" required>
  </div>
  <div class="form-group">
    <label for="inputPassword1">Geslo</label>
    <input type="password" class="form-control" id="password1" placeholder="Geslo" name="password" required>
  </div>
  <input type="checkbox" name='SaveLogin' value='SaveLogin'>Zapomni si me<br>
  <button type="submit" class="btn btn-default" name="login">Potrdi</button>
</form>
	
<?php
    echo "<p><a href='index.php?stran=pozabljenoGeslo'>Pozabljeno geslo</a></p>";
    echo prijava();
	$content=ob_get_clean();

    if(isset($_COOKIE['user']) or isset($_SESSION["user"]) ){header('Location:index.php'); }

	require "template/layout.html.php";

 ?>