<?php 
	require_once("./include/util_config.php");
	
	if(isset($_POST['submit']))
	{
		if($fixmycity->RegisterUser())
		{
			//$fixmycity->RedirectToURL("login.php");
			print_r ("culo");
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
				<div class="inner col-4">
					<div class="container">
						<div class="row">
							<div class="col-12">
								<form role="form" class="form_register" method="post">
									<h2  style="text-align:center;">Registrazione</h2>
									<hr>
									<div class="form-group" style="color:red;">
												<?php
													print_r ($fixmycity->getErrorMessage());
												?>
										</div>
									<div class="row">
										<div class="col-xs-12 col-sm-6 col-md-6">
											<div class="form-group">
												<input type="text" name="name" id="name" class="form-control input-lg" placeholder="Nome" tabindex="1">
											</div>
										</div>
										<div class="col-xs-12 col-sm-6 col-md-6">
											<div class="form-group">
												<input type="text" name="surname" id="surname" class="form-control input-lg" placeholder="Cognome" tabindex="2">
											</div>
										</div>
									</div>
									<div class="form-group">
										<input type="text" name="username" id="username" class="form-control input-lg" placeholder="Username" tabindex="3">
									</div>
									<div class="form-group">
										<input type="email" name="email" id="email" class="form-control input-lg" placeholder="Indirizzo Email" tabindex="4">
									</div>
									<div class="row">
										<div class="col-xs-12 col-sm-6 col-md-6">
											<div class="form-group">
												<input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="5">
											</div>
										</div>
										<div class="col-xs-12 col-sm-6 col-md-6">
											<div class="form-group">
												<input type="password" name="c_password" id="c_password" class="form-control input-lg" placeholder="Conferma Password" tabindex="6">
											</div>
										</div>
									</div>
									<div class="form-group">
													<select name="gender" class="form-control input-lg" tabindex="7">
														<option value="0" selected disabled>Sesso</option>
														<option value="1">Maschio</option>
														<option value="2">Femmina</option>
													</select>
									</div>
									<div class="row">
										<div class="col-12">
											<span class="button-checkbox">
												<input type="checkbox" name="contract" id="contract" class="hidden" value="1" tabindex="8">
											</span>
											 Cliccando <strong class="label label-primary">Registrati</strong>, acconsenti ai <a href="#" data-toggle="modal" data-target="#t_and_c_m">Termini e Condizioni</a> imposte da questo sito, incluso l'utilizzo dei Cookie.
										</div>
									</div>
									<hr>
									<div class="row">
										<div class="col-xs-12 col-md-6 offset-3"><input type="submit" value="Register" name="submit" class="btn btn-primary btn-block btn-xs" tabindex="9"></div>
									</div>
								</form>
							</div>
						</div>
						<!-- Modal -->
						<div class="modal fade" id="t_and_c_m" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										<h4 class="modal-title" id="myModalLabel">Termini e Condizioni</h4>
									</div>
									<div class="modal-body">
										<p>Ambarabacicìcocò. Tralallero trallalà</p>
										</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-primary" data-dismiss="modal">I Agree</button>
									</div>
								</div><!-- /.modal-content -->
							</div><!-- /.modal-dialog -->
						</div><!-- /.modal -->
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