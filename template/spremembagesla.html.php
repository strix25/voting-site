<?php ob_start()?>
<?php $title = "spremeniGeslo"; ?>
<?php
echo "<h2>Sprememba gesla</h2>";
echo "<p><a href='index.php?stran=profil'><- Nazaj na profil</a></p>";
?>
<form method="post">
<div class="form-group">
<label for="inputPasswordTrenutno">Trenutno geslo</label>
<input type="password" class="form-control" id="inputPasswordTrenutno" placeholder="Trenutno geslo" name="passwordTrenutno">
</div>
<div class="form-group">
<label for="inputPasswordNovo1">Novo geslo</label>
<input type="password" class="form-control" id="inputPasswordNovo1" placeholder="Novo geslo" name="passwordNovo1">
</div>
<div class="form-group">
<label for="inputPasswordNovo2">Ponovite novo geslo</label>
<input type="password" class="form-control" id="inputPasswordNovo2" placeholder="Ponovite novo geslo" name="passwordNovo2">
</div>
<button type="submit" class="btn btn-default" name="gumb">Spremeni</button>
</form>
<?php
    echo spremembaGesla();
	$content=ob_get_clean();

    

	require "template/layout.html.php";

 ?>