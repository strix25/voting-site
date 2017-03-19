<?php ob_start()?>
<?php $title = "admin"; ?>

<h2><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Administracija</h2>
<hr>
<div class="row">
<div class="col-md-4">
<?php
echo "<ul class='nav nav-pills nav-stacked'>";
echo "<li><a href='index.php?stran=dodajVic'><span class='glyphicon glyphicon-plus-sign' aria-hidden='true'></span> Dodaj vic</a></li>";
echo "<li><a href='index.php?stran=seznamNovic'><span class='glyphicon glyphicon-plus-sign' aria-hidden='true'></span> Uredi/brisi novice</a></li>";
echo "</ul>";
?>
</div>
<div class="col-md-8">
<?php
if (isset($content1)){
echo $content1;
} else {
echo "<p>Izberite opcijo na levi strani</p>";
}
?>
</div>
</div>

<?php
    
	$content=ob_get_clean();

    

	require "template/layout.html.php";

 ?>