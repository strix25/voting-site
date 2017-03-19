<?php ob_start(); ?>
<?php $title = "Glasovanje"; ?>
<div style="border-radius: 25px;background-color:rgba(255,255,255,0.5);
  color:white;  color:white; text-align:center; width:100%; padding:10px;"></div>
<?php 
$con = mysqli_connect("localhost","damjan","damjan123","glasovanje");

if(!empty($_COOKIE["glasovanje"])){
	
	?>
	<div class="container">
	<?php

	$get_votes = "select * from skupine";
	
	$run_votes = mysqli_query($con, $get_votes); 
	
	$row_votes = mysqli_fetch_array($run_votes); 
	
	$ACDC = $row_votes['ACDC'];
	$Nirvana = $row_votes['Nirvana'];
	$red_hot = $row_votes['red_hot']; 
	
	$count = $ACDC+$Nirvana+$red_hot; 
	
	$per_ACDC = round($ACDC*100/$count) . "%";
	$per_Nirvana = round($Nirvana*100/$count) . "%";
	$per_red_hot = round($red_hot*100/$count) . "%";
	
	echo "
	<div style='background: rgba(0, 0, 0, 0.7); padding:10px; text-align:center;margin-right:30px;'>
		 
		<center>
		<h2>Trenutno stanje glasovanja:</h2>
		
		<p style='background:#707070; color:black; padding:10px; width:500px;'>
		
		<b>AC/DC:</b> $ACDC ($per_ACDC)
		
		</p>
		
		<p style='background:#707070; color:black; padding:10px; width:500px;'>
		
		<b>Nirvana:</b> $Nirvana ($per_Nirvana)
		
		</p>
		
		<p style='background:#707070; color:black; padding:10px; width:500px;'>
		
		<b>Red Hot Chili Peppers:</b> $red_hot ($per_red_hot)
		
		</p>

		<h3>Hvala za glasovanje!</h3>
		</center>
	
	</div>
	
	
	";


}else{
	
	?>

<div class="kocka"><h1>Za katero skupino želite glasovati?</h2></div>

<div class="container">

<form action="index.php?stran=glasovanje" method="post" align="center">  
	
	<input type="submit" class="tipka" name="ACDC" value="Glasuj za AC/DC"/> 
	
	<input type="submit" class="tipka" name="Nirvana" value="Glasuj za Nirvana"/> 
	
	
	<input type="submit" class="tipka" name="red_hot" value="Glasuj za Red Hot Chili Peppers"/> 
	<!--
qzOaPQaNkmU
hTWKbfoikeg
o7MhpFF1vv0
	 -->

</form>
<iframe width="365" height="315"
src="http://www.youtube.com/embed/4gDch1p4c_M?">
</iframe>

<iframe width="365" height="315"
src="http://www.youtube.com/embed/vabnZ9-ex7o?">
</iframe>

<iframe width="365" height="315"
src="http://www.youtube.com/embed/mzJj5-lubeM?">
</iframe>

	<?php

if(isset($_POST['ACDC'])){
	$vote_ACDC = "update skupine set ACDC=ACDC+1";
	
	$run_ACDC = mysqli_query($con, $vote_ACDC);
	
	if($run_ACDC){
	
	echo "<h2 align='center'>Vaš glas je bil oddan skupini AC/DC!</h2>"; 
	echo "<h2 align='center'><a href='index.php?stran=glasovanje&results'>Poglej rezultate</a></h2>";
			setcookie("glasovanje", true, time() + (86400 * 30), "/");	
	}

}

if(isset($_POST['Nirvana'])){
			$vote_Nirvana = "update skupine set Nirvana=Nirvana+1";
	
	$run_Nirvana = mysqli_query($con, $vote_Nirvana);
	
	if($run_Nirvana){
	
	echo "<h2 align='center'>Vaš glas je bil oddan skupini Nirvana!</h2>"; 
	echo "<h2 align='center'><a href='index.php?stran=glasovanje&results'>Poglej rezultate</a></h2>";
	
		setcookie("glasovanje", true, time() + (86400 * 30), "/");
	}
}

if(isset($_POST['red_hot'])){
	$vote_red_hot = "update skupine set red_hot=red_hot+1";
	
	$run_red_hot = mysqli_query($con, $vote_red_hot);
	
	if($run_red_hot){
	echo "<h2 align='center'>Vaš glas je bil oddan skupini Red Hot Chili Peppers!</h2>"; 
	echo "<h2 align='center'><a href='index.php?stran=glasovanje&results'>Poglej rezultate</a></h2>";
			setcookie("glasovanje", true, time() + (86400 * 30), "/");
	}
}
}
?>


</div>

<div style="border-radius: 25px;background-color:rgba(255,255,255,0.5);
  color:white;  color:white; text-align:center; width:100%; padding:10px;"></div>



<?php
    
	$content=ob_get_clean();

    

	require "template/layout.html.php";

 ?>