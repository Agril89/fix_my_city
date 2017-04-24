<?php 
	require_once("./include/util_config.php");
	if(isset($_POST['logout']))
	{
		$fixmycity->LogOut();
		$fixmycity->RedirectToURL("login.php");
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>FixMyCity</title>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="icon" href="img/favicon.ico" type="text/css">
		<link rel="stylesheet" href="css/style.css" type="text/css">
		<link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
		<link rel="stylesheet" href="css/bootstrap.css"type="text/css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js" type="text/javascript"></script>
		<script src="js/bootstrap.min.js" type="text/javascript"></script>
		<script src="js/function.js" type="text/javascript"></script>
	</head>
	<body class="bg">
		<?php include 'template/header.php';?>
		
		<div class="outer">
			<div class="middle">
				<div class="inner main container">
					<div class="text-center">
						<img src="img/logo-main.png" alt="logo">
						<h2>Controlla, discuti, o segnala i problemi della tua città</h2>
					</div>
					<div class="container">
						<div class="row">
							<div class="col-6 offset-3">
								<form class="input-group">
									<input type="text" class="form-control input-lg" placeholder="Cerca" />
									<span class="input-group-btn">
										<button class="btn btn-info btn-lg" type="button">
											<i class="fa fa-search"></i>
										</button>
									</span>
								</form>
							</div>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		
		<?php include 'template/footer.php';?>
		
		<script type="text/javascript">
			jQuery(document).ready(function($){
				$("a.attiva-nav").click(function() {
					$("nav").slideToggle();
					$(this).toggleClass("active");
				});
				
			$(window).resize(function() {
			var windowsize = $(window).width();
			if (windowsize > 600) {
			$('nav').css('display', '');
			}
			});
			
			});
			</script>
			</body>
			</html>			