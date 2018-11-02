<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
	<a class="navbar-brand" href="<?php echo HOST;?>admin"><img alt="" src="<?php echo HOST;?>/assets/img/logo.png"/></a>
	<div class="collapse navbar-collapse" id="navbarResponsive">
		<ul class="navbar-nav navbar-sidenav" id="navbarAccordion">
			<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
				<a class="nav-link" href="admin">
					<span class="nav-link-text">Dashboard</span>
				</a>
			</li>
			<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Example Pages">
				<a  class="nav-link" href="services_admin" >
					<span class="nav-link-text">Services</span>
				</a>
			</li>					
		</ul>
		<ul class="navbar-nav sidenav-toggler">
			<li class="nav-item">
				<a class="nav-link text-center" id="sidenavToggler">
				</a>
			</li>
		</ul>
		<ul class="navbar-nav ml-auto">
			<li class="nav-item">
				<div class="nav-link mr-lg-2">
					<?php echo $_SESSION['username']?>
				</div>
			</li>
			<li class="nav-item">
				<a class="nav-link" data-toggle="modal" data-target="#exampleModal">
					Logout
				</a>
			</li>
		</ul>
	</div>
</nav>