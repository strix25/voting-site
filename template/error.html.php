<?php ob_start()?>
<?php $title = "Ups"; ?>
<h2>Ne obstaja!</h2>

<p>Stran, ki jo iščete žal ne obstaja!</p>
<?php
$content=ob_get_clean();

require "template/layout.html.php";

 ?>
