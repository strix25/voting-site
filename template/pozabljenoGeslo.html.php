<?php ob_start()?>
<?php $title = "pozabljenoGeslo"; ?>

<form method="post">
<div class="form-group">
<label for="inputEmail">E-pošta</label>
<input type="email" class="form-control" id="inputEmail" placeholder="Vpišite elektronsko pošto" name="email">
</div>
<button type="submit" class="btn btn-default" name="gumb">OK</button>
</form>
	<?php echo pozabljenoGeslo(); ?>
<?php
    
	$content=ob_get_clean();

    

	require "template/layout.html.php";

 ?>