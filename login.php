<?php
	require_once("./include/util_config.php");
	
	if(isset($_POST['login']))
	{
		if($fixmycity->Login())
		{
			$fixmycity->RedirectToURL("map.php");
		}
	}
	if(isset($_POST['logout']))
	{
		$fixmycity->LogOut();
		$fixmycity->RedirectToURL("login.php");
	}
	
	
?> 
<!doctype html>
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
				<div class="inner container">
					<form action="" class="form_register" method="post">
						<div class="header">Login form</div>
						
						<fieldset>		
							<div style="color:red; padding-top:15px;">
								<?php
									print_r ($fixmycity->getErrorMessage());
								?>
							</div>
							<div>
								<p class="input">
									<input type="text" name="user" placeholder="Username o E-Mail" value="<?php if(isset($_COOKIE["member_login"])) { echo $_COOKIE["member_login"]; } ?>" />
								</p>
							</div>
							
							<div>
								<label class="input">
									<i class="icon-append icon-lock"></i>
									<input type="password" name="pass" placeholder="Password" value="<?php if(isset($_COOKIE["member_password"])) { echo $_COOKIE["member_password"]; } ?>" />
								</label>
							</div>
							
							<div>
								<input type="checkbox" name="remember" id="remember"  <?php if(isset($_COOKIE["member_login"])) { ?> checked <?php } ?> />
								<label for="remember-me">Ricordami</label>
							</div>
							
						</fieldset>
						
						<div class="footer">
							<div>
								<input class="button" type="submit" name="login" value="Login">
							</div>
						</div>
					</form>
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