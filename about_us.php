<?php 
	require_once("./include/util_config.php");
	if(isset($_POST['logout']))
	{
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
				<div class="inner main container">
					<div class="container">
						<div class="row">
							<div class="col-12">
								<h1>Da chi nasce tutto questo...</h1>
								<p>Eccoci qui! Siamo due ragazzi del terzo anni di Informatica eeeee... boh, dobbiamo ancora pensare a cosa scrivere, per ora accontentatevi! xD</p>
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