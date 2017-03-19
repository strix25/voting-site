<?php ob_start(); ?>
<?php $title = "Glasovanje"; ?>
<div class="vsebinadva">
<p> Dobrodošli na naši spletni strani!</p>
</div>


<?php $content = ob_get_clean(); 
require "template/layout.html.php";
?>
