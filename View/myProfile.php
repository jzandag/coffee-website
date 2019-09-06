<?php
session_start();

	if(!isset($_SESSION['username'])){
		header("Location: http://localhost/coffee-website/index.php?error=notlogged");
		
		exit();
	}else if($_SESSION['role'] != 'user'){
		header("Location: ../View/dashboard.php?error=unauthorized");
		exit();
	}
	else if(!isset($_GET['id'])){

	}

	//block of code for getting user info
	if(isset($_GET['id'])){
		require "../includes/dbh.inc.php";
		$editUsername = '';
		$editEmail = '';
		$editPassword = '';
		$editRole = '';
		
		$sql = "SELECT email,username,role FROM users WHERE id=?";
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt,$sql)){
			header("Location: ../View/viewUsers.php?error=sqlerror");
			exit();
		}else{
			mysqli_stmt_bind_param($stmt,"s",$_GET['id']);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt,$email,$username,$role);
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
				$editRole = $role;
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
	<?php include('../View/include.php');?>

	<!-- <script src="../js/homepage.js"></script> -->
	<script src="../js/viewusers.js"></script>
	
 	<link rel="stylesheet" href="../css/dashboard.css" />

 	<style type="text/css">
 		.form-control-feedback{
 			width: 63px !important;
 			line-height: 32px !important;
 		}

 	</style>
</head>
<body>
	<?php include('../View/navbar.php'); ?>
	<!--Create user form -->
	<div class="">
		<form method="post" id="submit_form" action="../includes/signup.inc.php">
			<div class="page-header" style="margin-top:75px;">
				<div class="container-fluid">
				
				</div>
			</div>
			<div class="">
				<div class="col-md-12" >
					<div class="panel panel-default" >
						<div class="panel-heading" >
							<h1 align="center"><i class="fa fa-user"></i> Hi <?php echo $_SESSION['username'].'!'; ?></h1>
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
								<label for="email" class="control-label"><b>Email:</b> </label>
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
							<!-- for type of user -->
							<div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
							    <label for="exampleFormControlSelect1">Role</label>
							    <select name="role" class="form-control" id="exampleFormControlSelect1">
							      <option value="user">User</option>
							      <option value="admin">Admin</option>
							      <option value="machine">Machine</option>
							    </select>
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
