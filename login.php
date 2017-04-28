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
	<?php include 'template/head.php';?>
	<body class="bg">
		<?php include 'template/header.php';?>
		
		<div class="outer">
			<div class="middle">
				<div class="inner col-3">
					<div class="container">
						<div class="row">
							<div class="col-12">
								<form role="form" class="form_register" method="post">
									<h2 style="text-align:center;">Login</h2>
									<hr>
									<div class="form-group" style="color:red;">
										<?php
											echo $fixmycity->getErrorMessage();
										?>
									</div>
									<div class="form-group">
										<input type="text" name="user" id="username" class="form-control input-lg" placeholder="Username" tabindex="1">
									</div>
									<div class="form-group">
										<input type="password" name="pass" id="password" class="form-control input-lg" placeholder="Password" tabindex="2">
									</div>
									<div>
										<input type="checkbox" name="remember" id="remember" tabindex="3"/>
										<label for="remember-me">Ricordami</label>
									</div>
									<hr>
									<div class="row">
										<div class="col-xs-12 col-md-6 offset-3"><input type="submit" value="Login" name="login" class="btn btn-primary btn-block btn-xs" tabindex="4"></div>
									</div>
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