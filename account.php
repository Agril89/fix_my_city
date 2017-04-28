<?php 
	require_once("./include/util_config.php");
	if(!isset($_SESSION)){ session_start(); }
	if(!isset($_SESSION['username']) || $_SESSION['username']==NULL && !($fixmycity->AutoLogin())){
		$fixmycity->RedirectToURL("login.php");
	}
	if(isset($_POST['logout']))	{
		$fixmycity->LogOut();
		$fixmycity->RedirectToURL("login.php");
	}

?>
<!doctype html>
<html>
	<?php include 'template/head.php';?>
	<body>
		<?php include 'template/header.php';?>
		
		<div class="outer" style="background-color:#5a5a5a">
			<div class="middle">
				<div class="inner col-8">
					<div class="container">
						<div class="row">
							<div class="col-12">
								<form role="form" class="form_register" method="post">
									<div style="text-align:center;">
										<h1>Benvenuto <?php echo $_SESSION['name'] ?> </h1>
										<h4>Questo &egrave; il tuo pannello Utente</h4>
									</div>
									<hr>
									<div class="form-group">
										<input type="text" name="name" id="name" class="form-control input-lg" placeholder="<?php echo $_SESSION['name'] ?>" readonly="readonly">
									</div>
									<div class="form-group">
										<input type="text" name="surname" id="surname" class="form-control input-lg" placeholder="<?php echo $_SESSION['surname'] ?>" readonly="readonly">
									</div>
									<div class="form-group">
										<input type="text" name="username" id="username" class="form-control input-lg" placeholder="<?php echo $_SESSION['username'] ?>" readonly="readonly">
									</div>
									<div class="form-group">
										<input type="email" name="email" id="email" class="form-control input-lg" placeholder="<?php echo $_SESSION['email'] ?>" readonly="readonly">
									</div>
									<div class="form-group">
										<input type="gender" name="gender" id="gender" class="form-control input-lg" placeholder="<?php echo $_SESSION['gender'] ?>" readonly="readonly">
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