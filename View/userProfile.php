<?php
	session_start();

	if(!isset($_SESSION['username'])){
		header("Location: http://localhost/coffee-website/index.php?error=notlogged");
	
		exit();
	}else if($_SESSION['username'] != 'admin'){
		header("Location: ../View/dashboard.php?error=unauthorized");
		exit();
		  
    }
    
    if(isset($_GET['id'])){
		require "../includes/dbh.inc.php";
		$editUsername = '';
		$editEmail = '';
		$editPassword = '';
		
		$sql = "SELECT email,username FROM users WHERE id=?";
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt,$sql)){
			header("Location: ../View/viewUsers.php?error=sqlerror");
			exit();
		}else{
			mysqli_stmt_bind_param($stmt,"s",$_GET['id']);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt,$email,$username);
			//mysqli_stmt_store_result($stmt);
			/*$result = mysqli_stmt_get_result($stmt);
			while($row = mysqli_fetch_assoc($result) ){
				$editEmail = $row['email'];
				$editUsername = $row['username'];
			}*/
			while(mysqli_stmt_fetch($stmt)){
				$editEmail = $email;
				echo '<script>alert('.$editEmail.');console.log(\'igot here\');</script>';
				$editUsername = $username;
			}
		}
		mysqli_stmt_close($stmt);
	    mysqli_close($conn);
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<title>Users</title>

	<script src="../js/common.js"></script>
	<script src="../js/jquery-3.3.1.min.js"></script>
	<script src="../js/bootstrap/bootstrap.min.js"></script>
	<!-- <script src="../js/homepage.js"></script> -->
	<script src="../js/viewusers.js"></script>
	<script src="../js/bootstrapValidator.min.js"></script>
	
	
	<link rel="stylesheet" href="../css/bootstrap/bootstrap.min.css">
	<link rel="stylesheet" href="../css/font-awesome.min.css">
 	<link rel="stylesheet" href="../css/viewusers.css" />
 	<link rel="stylesheet" href="../css/bootstrapValidator.min.css">

 	<link rel="shortcut icon" href="../images/hot-coffee-icon.png" />
</head>
<body>
	<!-- navigation bar-->
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-main">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="../View/dashboard.php#"><i class="fa fa-coffee" aria-hidden="true"></i> Project Coffee</a>
			</div>
			<div class="collapse navbar-collapse" id="navbar-collapse-main">
				<ul class="nav navbar-nav navbar-right">
					<li><a class="active" href="../View/dashboard.php"><i class="fa fa-home"></i> Home</a></li>
					<li><a href="#"><i class="fa fa-info-circle"></i> About</a></li>	
					<?php
					if(isset($_SESSION['username'])){
						if($_SESSION['username'] == 'admin'){
							echo '<li><a href="../View/viewUsers.php"><i class="fa fa-gear"></i> System Configuration</a></li>';
						}

					}
					?>
					<li><a href="../includes/logout.inc.php"><i class="fa fa-sign-out"></i> LOGOUT</a></li>
				</ul>
			</div>
		</div>
	</nav>
    
    <!--Create user form -->
	<div class="">
		<form method="post" id="submit_form" action="../includes/signup.inc.php">
			<div class="page-header">
				<div class="container-fluid">
				
				</div>
			</div>
			<div class="">
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h1>User Profile</h1>
						</div>
						<div class="panel-body">
							<div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
								<label for="username" class="control-label"><b>Username:</b> </label>
								<input class="form-control type="text" name="username" autocomplete="off"
									<?php
										if(isset($_GET['id'])){
											echo 'value="'.$editUsername.'"';
										}
									?>
								/>
							</div>
							<div class="clearfix"></div>
							<div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
								<label for="email" class="control-label"><b>E-mail:</b> </label>
								<input class="form-control" type="text" name="email" autocomplete="off" 
									<?php
									if(isset($_GET['id'])){
										echo 'value="'.$editEmail.'"';
									}
								?>
								/>
							</div>
							<?php if(isset($_GET['id'])){
									echo '<input type="hidden" name="id" value="'.$_GET['id'].'">';
								}
							
							?>
							<div class="clearfix"></div>
							<div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
								<label for="password" class="control-label"><b>Password:</b> </label>
								<input class="form-control" type="password" name="password" autocomplete="off"/>
							</div>
							<div class="clearfix"></div>
							
							<?php
								if(isset($_GET['id'])){
									echo '<div class="form-group col-md-4 col-lg-6 col-xs-12 col-sm-12">
											<button type="submit" name="signup-submit" class="btn btn-primary btn-flat btn-submit col-lg-2 col-xs-12 col-sm-12">
												UPDATE</button>
										</div>
									';
									
								}else{
									echo '<div class="form-group col-md-4 col-lg-6 col-xs-12 col-sm-12">
											<button type="submit" name="signup-submit" class="btn btn-primary btn-flat btn-submit col-lg-2 col-xs-12 col-sm-12">
												SUBMIT</button>
										</div>
									';
								}
							?>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</body>
</html>
