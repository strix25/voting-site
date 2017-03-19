<?php
	include 'model.php';
	
			if(isset($_COOKIE['user']))
			{
				$username = $_COOKIE['user'];
				$_SESSION["user"] = $username;
			}

				if (isset($_GET['stran']))
				{
					if ($_GET['stran']=="prijava")
				{
					include 'template/prijava.html.php';
				} 
					else if ($_GET['stran']=="registracija")
					{	
						include 'template/registracija.html.php';
					}
						else if ($_GET['stran']=="odjava")
						{	
							session_destroy();
							if(isset($_COOKIE['user']))
							{
							setcookie("user", $username, time() - 3600);
							}
								header('Location: index.php');
						}
						      else if ($_GET['stran']=="profil") 
						         {
						  			include 'template/profil.html.php';
						         }
						         	else if ($_GET['stran']=="spremeniGeslo") 	
						         	{
										include 'template/spremembagesla.html.php';
									}
										else if ($_GET['stran']=="pozabljenoGeslo")
										{
										include 'template/pozabljenoGeslo.html.php';
										}else if ($_GET['stran'] == "admin"){
											
											include 'template/admin.html.php';
											
																			}
												else if ($_GET['stran'] == "dodajVic"){
													include 'template/dodajVic.html.php';
																							}
															else if ($_GET['stran'] == "glasovanje"){
																include 'template/glasovanje.html.php';
																							}
																		else if ($_GET['stran'] == "vsivici"){
																				include 'template/vsiVici.html.php';
																							}
																		else if ($_GET['stran'] == "seznamNovic"){
																				include 'template/seznamNovic.html.php';
																							}
																		else if ($_GET['stran'] == "uredi" && (isset($_GET['id']))){
																				include 'template/uredi.html.php';
																							}
																		else if ($_GET['stran'] == "brisi" && (isset($_GET['id']))){
																				include 'template/brisi.html.php';
																							}
														else
														{	
															include 'template/error.html.php';
														}
											} 
														else 
														{	
														include 'template/index.html.php';
														}
?>
