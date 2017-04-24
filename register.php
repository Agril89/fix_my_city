<?php 
	require_once("./include/util_config.php");
	
	if(isset($_POST['submit']))
	{
		if($fixmycity->RegisterUser())
		{
			$fixmycity->RedirectToURL("login.php");
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
						<form class="form_register" method="post">
						<div class="header">Registration form</div>
						
						<fieldset>		
							<div style="color:red; padding-top:15px;">
								<?php
									print_r ($fixmycity->getErrorMessage());
								?>
							</div>
							<div>
								<p class="input">
									<input type="text" name="username" placeholder="Username">
								</p>
							</div>
							
							<div>
								<label class="input">
									<i class="icon-append icon-envelope-alt"></i>
									<input type="text" name="email" placeholder="Email address">
								</label>
							</div>
							
							<div>
								<label class="input">
									<i class="icon-append icon-lock"></i>
									<input type="password" name="password" placeholder="Password">
								</label>
							</div>
							
							<div>
								<label class="input">
									<i class="icon-append icon-lock"></i>
									<input type="password" name="c_password" placeholder="Confirm password">
								</label>
							</div>
						</fieldset>
						
						<fieldset>
							<div class="row">
								<div class="col">
									<label class="input">
										<input type="text" name="name" placeholder="First name">
									</label>
								</div>
								<div class="col">
									<label class="input">
										<input type="text" name="surname" placeholder="Last name">
									</label>
								</div>
							</div>
							
							<div>
								<label class="select">
									<select name="gender">
										<option value="0" selected disabled>Gender</option>
										<option value="1">Male</option>
										<option value="2">Female</option>
									</select>
									<i></i>
								</label>
							</div>
							
							<div>
								<label class=""><input type="checkbox" name="contract" value="yes"><i></i>I agree to the Terms of Service</label>
								
							</div>
						</fieldset>
						<div class="footer">
							<div>
								<button class="button" name="submit">Invia</button>
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