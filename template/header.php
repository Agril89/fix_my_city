<header>
	<nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
		<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<a class="navbar-brand"><img style="max-width:150px; margin-top: -7px;" src="img/logo_white.png" alt="logo"></a>
		<div class="collapse navbar-collapse" id="navbarCollapse">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item <!--active-->"> 
					<a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="map.php">Maps</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="about_us.php">About Us</a>
				</li>
				<li class="nav-item">
					<a class="nav-link disabled" href="#">How it work</a>
				</li>
			</ul>
			<?php 
				session_start();
				if(isset($_SESSION['username']) || ($fixmycity->AutoLogin())) {
					echo '<form class="form-inline mt-2 mt-md-0" name="form_login" method="post" action="">
						<p style="color: rgba(255, 255, 255, 0.5); margin-right: 10px; line-height: 40px; margin-bottom: 0;"> Benvenuto <a href="#">' .$_SESSION['name'] . '</a></p>
						<input class="btn btn-outline-success my-2 my-sm-0" name="logout" type="submit" value="Logout">			
					</form>';
				}
				else {
					echo '<form class="form-inline mt-2 mt-md-0" name="form_login" method="post" action="login.php">
						<input class="btn btn-outline-success my-2 my-sm-0" type="submit" value="Login">			
						<a class="nav-link" href="register.php">Registrati</a>
					</form>';
				}
			?>
		</div>	
	</nav>
	</header>