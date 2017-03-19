<?php ob_start()?>
<?php $title = "Profil"; ?>
<?php
echo "<h2>urejanje profila</h2>";
?>
<div class="row">
<div class="col-md-6">
<?php
echo "<ul class='nav nav-pills nav-stacked'>";
echo "<li><a href='index.php?stran=odjava'>Odjava</a></li>";
echo "<li><a href='index.php?stran=spremeniGeslo'>Sprememba gesla</a></li>";
echo "</ul>";
?>
</div>
<div class="col-md-6">
<p class="user"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></p>
Izberite opcijo z levega menija in si spremenite geslo ali pa se odjavite iz sistema.
</div>
</div>
	
<?php
    
	$content=ob_get_clean();

    

	require "template/layout.html.php";

 ?>