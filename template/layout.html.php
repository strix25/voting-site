<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="shortcut icon" href="izgled/favicon.ico" type="image/x-icon"/>
  <title> <?php echo $title ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="template/slog.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
</head>
<body>
	<div id="top"><?php if(isset($_SESSION["user"])){echo "Pozdravljen " . $_SESSION["user"];}else{
			echo"Če se želite prijaviti kliknite <a href='index.php?stran=prijava'>tukaj</a>";} ?></div>
     
    
<div class="container">
	
  <div class="jumbotron">
	
    <h1>Spletna stran za glasovanje</h1>
    <p>Glasujte za vašo najljubšo glasbeno skupino!</p> 
<ul class="nav nav-pills">

  <?php 
              if(isset($_SESSION["user"]))
              {
                echo'<li><a href="index.php?stran=odjava">odjava</a></li>';
                echo'<li><a href="index.php?stran=profil">profil</a></li>';
                echo'<li><a href="index.php?stran=glasovanje">glasovanje</a></li>';
                 echo'<li><a href="index.php">domov</a></li>';
              }
              else
              {
                echo'<li><a href="index.php?stran=prijava">prijava</a></li>';
                echo'<li><a href="index.php?stran=registracija">registracija</a></li>';
              }
              ?>
              
</ul>
  </div>
  </div>
<div class="container vsebina">
<?php echo $content;
?>
</div>
</body>
</html>
