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
	<?php include 'template/head.php';?>
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