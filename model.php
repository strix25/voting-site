<?php
session_start();

function open_database_connection()
{
$link=new mysqli("localhost","damjan","damjan123","glasovanje");
$link->query("SET NAMES 'utf8'");
return $link;
}
function close_database_connection($link)
{
mysqli_close($link);
}
//funkcija za registracijo

function Registracija()
{
$status = "";
if (isset($_POST['register']))
  {
	
		$username = $_POST['username'];
		$password1 = $_POST['password1'];
		$password2 = $_POST['password2'];
       
	if (empty($username) || empty($password1) || empty($password2))
		{
		$status = "Niste izpolnili vseh polj";
		} else 
				{

	if ($password1 != $password2) 
					{
		$status = "Gesli se ne ujemata";
		
					}else if (strlen ($password1)<8)
						{
							echo "geslo mora biti vsaj 8 znakov";
						} else {
						$link=open_database_connection(); //povežemo se z bazo
						$sql="SELECT username FROM user  WHERE username='$username'";
						$usernamecheck =mysqli_query($link,$sql);
						$row_cnt = mysqli_num_rows($usernamecheck);
						close_database_connection($link); //zapremo povezavo z bazo
					      if($row_cnt!=0)					      
									{
										echo"Ime že obstaja ;D";
									}else{
										$link=open_database_connection(); //povežemo se z bazo
										$geslo = sha1($password1); //sifriramo geslo
										//nadaljujemo z registracijo
											
											$sql="INSERT INTO user (username, password, register) VALUES ('$username','$geslo', now())";
												if (!mysqli_query($link,$sql))
														{
															echo("Error description: " . mysqli_error($link));
														} else {
															$status = "Registracija je uspela";
															close_database_connection($link); //zapremo povezavo z bazo
																}
	 
										}
							  }
												
				}
												return $status;
  }
}

function Prijava() {
	$status = "";
	


	if (isset($_POST['login']))
	{	
		if(!empty($_POST['username']) && !empty($_POST['password']))
		{	
			$username = $_POST['username'];
			$password = sha1($_POST['password']);

			$link=open_database_connection(); 

			$UsernameCheck = $link->query("SELECT username FROM user WHERE username = '$username' ");
	        
	        $row_cnt = mysqli_num_rows($UsernameCheck);

	        if($row_cnt != 0)
	        {
				$result = $link->query("SELECT * FROM user WHERE username = '$username' ");
				//(mysqli_error($DB));

				while($row = $result->fetch_assoc())
				{ 
					$wrong_password = $row['wrong_password'];

					$wrong_password2 = $wrong_password + 1; 

					if($wrong_password >= 3)
					{
						$wrong_password2 = 3;
						$status = "<p class='bg-danger'>Žal je vaš račun zaklenjen</p>";
					}

					if($row['password'] == $password)
					{
						if($wrong_password < 3)
						{
							$_SESSION["user"] = $username;

							if(isset($_POST['SaveLogin']))
							{
								setcookie("user", $username, time() + 3600);
							}
							$last_login = date('Y-m-d H:i:s');
							$link->query("UPDATE user SET last_login = '$last_login' WHERE username = '$username'");
							$link->query("UPDATE user SET wrong_password = '0' WHERE username = '$username'");
						}
					} 
					else //Wrong password
					{
						$status = "<p class='bg-danger'>Uporabniško ime ali geslo je napačno poskusite znova</p>";

						$link->query("UPDATE user SET wrong_password = '$wrong_password2' WHERE username = '$username'");
						
					} 
					
				}

	        	close_database_connection($link); 

			}else {$status = "<p class='bg-danger'>Uporabniško ime ali geslo je napačno poskusite znova</p>";} //Wrong username


		}else {$status = "<p class='bg-danger'>Vsa polja morajo biti izpolnjena</p>";}
	}

	return $status;
}

	



	function spremembaGesla(){
	$status = "";
		if (isset($_POST['gumb'])){
			$trenutnoGeslo = $_POST['passwordTrenutno'];
			$geslo1 = $_POST['passwordNovo1'];
			$geslo2 = $_POST['passwordNovo2'];
			$username = $_SESSION['user'];
				if ($trenutnoGeslo == "" || $geslo1 == "" || $geslo2 == ""){
					$status = "Niste izpolnili vseh polj";
					} else {
						if ($geslo1 != $geslo2){
						$status = "Novi gesli se ne ujemata";
							} else {
							//1. v bazi preverimo ali je trenutno geslo pravilno
							$link=open_database_connection(); //povežemo se z bazo
							$geslo = sha1($trenutnoGeslo);
							$sql="SELECT password FROM user WHERE password='$geslo' AND username='$username'";
							if (!mysqli_query($link,$sql))
							{
							echo("Error description: " . mysqli_error($link));
							}
							$result = mysqli_query($link,$sql);
							$vrstice = mysqli_num_rows($result);
							if ($vrstice == 0){
							$status = "Trenutno geslo ni pravilno";
							} else {
							$novoGeslo = sha1($geslo1);
							$sql="UPDATE user SET password='$novoGeslo' WHERE username='$username'";
							if (!mysqli_query($link,$sql))
							{
							echo("Error description: " . mysqli_error($link));
							}
							$status = "Geslo je bilo posodobljeno.";
							}
							close_database_connection($link); //zapremo povezavo z bazo
							}
							}
							}
							return $status;
							}



	function pozabljenoGeslo(){
	$status = "";

		if (isset($_POST['gumb'])){
			    $email = $_POST['email'];
				if ($email == ""){
					$status = "Niste izpolnili vseh polj";
					} 
						 else {
							$link=open_database_connection(); //povežemo se z bazo
							
							$sql="SELECT email FROM user WHERE email='$email'";
							if (!mysqli_query($link,$sql))
							{
							echo("Error description: " . mysqli_error($link));
							}
							$result = mysqli_query($link,$sql);
							$vrstice = mysqli_num_rows($result);
							if ($vrstice == 0){
							$status = "Ta email ne obstaja!";
							} else {
                              $posodobljenogeslo = mt_rand(100000,999999); 
                              $posodobljenogeslo = sha1($posodobljenogeslo);


							
							$sql="UPDATE user SET password='$posodobljenogeslo' where email='$email'";
							if (!mysqli_query($link,$sql))
							{
							echo("Error description: " . mysqli_error($link));
							}
							$status = $posodobljenogeslo;
							}
							close_database_connection($link); //zapremo povezavo z bazo
							}
							
							
							}


							return $status;
							}





									 function dodajVic(){
										$status = "";
										if (isset($_POST['gumb'])){
											$naslov = $_POST['naslov'];
											
											$vsebina = $_POST['vsebina'];
									if ($naslov == "" ||  $vsebina == ""){
										$status = "Niste izpolnili vseh polj";
									} else {
									$link=open_database_connection(); //povežemo se z bazo
									//dobimo id uporabnika
									$upime = $_SESSION['user'];
									$sql="SELECT id FROM user WHERE username='$upime'";
									if (!mysqli_query($link,$sql))
									{
										echo("Error description: " . mysqli_error($link));
									}
										$result = mysqli_query($link,$sql);
										$row=mysqli_fetch_row($result);
										$id_uporabnik = $row[0];
										
									//vpis v tabelo novica0
									$sql1="INSERT INTO vic (naslov, vsebina, datum, iduser) VALUES ('$naslov', '$vsebina', now(), '$id_uporabnik')";
									if (!mysqli_query($link,$sql1))
									{
										echo("Error description: " . mysqli_error($link));
									}
									close_database_connection($link); //zapremo povezavo z bazo
									$status = "Vic je bil dodan.";
									}
									}
									return $status;
									}




			function zadnjeNovice(){
						$link=open_database_connection(); //povežemo se z bazo
						$sql="SELECT naslov, vsebina, id FROM vic ORDER BY datum DESC LIMIT 0,3";
							if (!mysqli_query($link,$sql))
							{
								echo("Error description: " . mysqli_error($link));
							}
								$result = mysqli_query($link,$sql);
								$novice = array();
									while($row=mysqli_fetch_row($result))
									{
										array_push($novice, $row);
									}
									close_database_connection($link); //zapremo povezavo z bazo
									return $novice;
								}


							function novica($id){
							$link=open_database_connection(); //povežemo se z bazo
							$sql="SELECT * FROM vic WHERE id='$id'";
							if (!mysqli_query($link,$sql))
							{
							echo("Error description: " . mysqli_error($link));
							}
							$result = mysqli_query($link,$sql);
							$row=mysqli_fetch_row($result);
							close_database_connection($link); //zapremo povezavo z bazo
							return $row;
}

							function vsenovice(){
						$link=open_database_connection(); //povežemo se z bazo
						$sql="SELECT naslov, vsebina, id FROM vic ORDER BY datum DESC";
							if (!mysqli_query($link,$sql))
							{
								echo("Error description: " . mysqli_error($link));
							}
								$result = mysqli_query($link,$sql);
								$novice = array();
									while($row=mysqli_fetch_row($result))
									{
										array_push($novice, $row);
									}
									close_database_connection($link); //zapremo povezavo z bazo
									return $novice;
								}







							function kategorije(){
								$link=open_database_connection(); //povežemo se z bazo
								$sql="SELECT imekategorije, id FROM kategorija";
							if (!mysqli_query($link,$sql))
							{
								echo("Error description: " . mysqli_error($link));
							}
								$result = mysqli_query($link,$sql);
								$kategorije = array();
									while($row=mysqli_fetch_row($result))
									{
										array_push($kategorije, $row);
									}
									close_database_connection($link); //zapremo povezavo z bazo
									return $kategorije;
								}

					

function urediNovica($id){
	$status = "";
	if (isset($_POST['gumb'])){
		$naslov = $_POST['naslov'];
		$vsebina = $_POST['vsebina'];
		if (empty($naslov) ||  empty($vsebina)){
			$status =  "Niste izpolnili vseh polj";
		} else {
			$link=open_database_connection(); //povežemo se z bazo
			
			$sql="UPDATE vic SET naslov='$naslov',urejeno = now(), vsebina='$vsebina' WHERE id='$id'";
			if (!mysqli_query($link,$sql))
			{
				echo("Error description: " . mysqli_error($link));
			}
			$result=mysqli_query($link,$sql);
			$status = "Novica je bila uspešno posodobljena";
	
			close_database_connection($link); //zapremo povezavo z bazo
		}
		
	}
	return $status;
}
 function izbrisi($id)
 {
	 $link=open_database_connection(); //povežemo se z bazo
			
			$sql="DELETE FROM vic WHERE id='$id'";
			if (!mysqli_query($link,$sql))
			{
				echo("Error description: " . mysqli_error($link));
			}
			$result=mysqli_query($link,$sql);
	
			close_database_connection($link); //zapremo povezavo z bazo
		
}		



function glasovanje(){
  
  
$con = mysqli_connect("localhost","damjan","damjan123","glasovanje");


if(isset($_POST['ACDC'])){
	
	$vote_ACDC = "update skupine set ACDC=ACDC+1";
	
	$run_ACDC = mysqli_query($con, $vote_ACDC);
	
	if($run_ACDC){
	
	echo "<h2 align='center'>Vaš glas je bil oddan skupini AC/DC!</h2>"; 
	echo "<h2 align='center'><a href='index.php?stran=glasovanje&results'>Poglej rezultate</a></h2>";
	
	
	}

}

if(isset($_POST['Nirvana'])){
	
	$vote_Nirvana = "update skupine set Nirvana=Nirvana+1";
	
	$run_Nirvana = mysqli_query($con, $vote_Nirvana);
	
	if($run_Nirvana){
	
	echo "<h2 align='center'>Vaš glas je bil oddan skupini Nirvana!</h2>"; 
	echo "<h2 align='center'><a href='index.php?stran=glasovanje&results'>Poglej rezultate</a></h2>";
	
	}
}

if(isset($_POST['red_hot'])){
	
	$vote_red_hot = "update skupine set red_hot=red_hot+1";
	
	$run_red_hot = mysqli_query($con, $vote_red_hot);
	
	if($run_red_hot){
	echo "<h2 align='center'>Vaš glas je bil oddan skupini Red Hot Chili Peppers!</h2>"; 
	echo "<h2 align='center'><a href='index.php?stran=glasovanje&results'>Poglej rezultate</a></h2>";
	}
}

if(isset($_GET['results'])){

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
	<div style='background:lightgreen; padding:10px; text-align:center;'>
		 
		<center>
		<h2>Trenutno stanje glasovanja:</h2>
		
		<p style='background:orange; color:white; padding:10px; width:500px;'>
		
		<b>AC/DC:</b> $ACDC ($per_ACDC)
		
		</p>
		
		<p style='background:orange; color:white; padding:10px; width:500px;'>
		
		<b>ABBA:</b> $Nirvana ($per_Nirvana)
		
		</p>
		
		<p style='background:orange; color:white; padding:10px; width:500px;'>
		
		<b>Red Hot Chili Peppers:</b> $red_hot ($per_red_hot)
		
		</p>
		</center>
	
	</div>
	
	
	";

}







}	


function checkDelete(){
    return confirm('Are you sure?');
}
?>

