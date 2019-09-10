	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-main">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="../View/dashboard.php#"><i class="fa fa-coffee" aria-hidden="true"></i> <?php echo $_SESSION['role'].$_SESSION['id'] ;?></a>
			</div>
			<div class="collapse navbar-collapse" id="navbar-collapse-main">
				<ul class="nav navbar-nav navbar-right">
					<li><a class="active" href="../View/dashboard.php"><i class="fa fa-home"></i> Home</a></li>
					<li><a href="../View/aboutUs.php"><i class="fa fa-info-circle"></i> About</a></li>	
					<?php
					if(isset($_SESSION['role'])){
						if($_SESSION['role'] == 'admin'){
							echo '<li><a href="../View/viewUsers.php"><i class="fa fa-gear"></i> System Configuration</a></li>';
						}
						else if($_SESSION['role'] == 'user' || $_SESSION['role'] == 'machine'){
							echo '<li><a href="../View/myProfile.php?id='.$_SESSION['id'].'"><i class="fa fa-gear"></i> My Profile</a></li>';
						}
					}
					?>
					<li><a href="../includes/logout.inc.php"><i class="fa fa-sign-out"></i> LOGOUT</a></li>
				</ul>
			</div>
		</div>
	</nav>

	<div id="notif-template" class="hide">
		<div class="alert new alert-default fade in alert-dismissible" role="alert">
			<span class="notif-message desc-message font-weight-bold">This is alert message</span><br/>
			<span class="notif-message info-message">This is alert message</span>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	</div> 

	<div id="notif-alert" class="row ml-auto pull-right" style="right: 15px !important;">
		<div class="alert-group"></div>
	</div>
