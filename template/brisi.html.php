<?php ob_start()?>
<?php $title = "brisi"; ?>


<?php
    izbrisi($_GET['id']);
	$content=ob_get_clean();

    

	require "template/layout.html.php";

 ?>