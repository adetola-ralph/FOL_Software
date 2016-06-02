<?php
//echo($_SERVER["PHP_SELF"]);

$auth = true;

if(!isset($_SESSION["auth"]))
{
	$auth = false;
}

// echo("<!DOCTYPE html>);
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title></title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href='../style/style.css' rel='stylesheet' type='text/css' />
		<link href="../style/bootstrap.min.css"  rel='stylesheet' type='text/css' />
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
		<link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.6/lumen/bootstrap.min.css" rel="stylesheet">
		
		<!--[if lt IE 9]>
		  <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
		<![endif]-->
		
		<script src='../js/jquery-1.12.0.min.js' type='text/javascript'></script>
		<script src='../js/js.js' type='text/javascript'></script>
		<script src='../js/postcodes.min.js' type='text/javascript'></script>
		<script src="../js/bootstrap.min.js" type='text/javascript'></script>
		<script type="text/javascript" src="../js/modenizr.js"></script>
	</head>
	
	<body>
		<nav class = "navbar navbar-default navbar-fixed-top" role = "navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-ba"></span>
					</button>
					<a class="navbar-brand" href="../index.php"> 
                        <img src="../images/logo.svg" alt="logo" height="70" width="70"/>
                   </a> 
					<a class="navbar-brand" href="../index.php"> 
                        FOL Counselling Team
                   </a> 
				</div>
				<div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<?php if($auth){echo('<li><a type="button" class="" href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a></li>');}?>
					</ul>
				</div>
			</div>
		</nav>
		<div class="container">
			<header>
			</header>
			<div class="page-header">
				<h2><?php echo($page_title); ?></h2>      
			</div>