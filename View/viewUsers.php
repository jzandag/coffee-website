<?php
    session_start();
    
    if(!isset($_SESSION['username'])){
		header("Location: http://localhost/smart-coffee/index.php?error=notlogged");
	
		exit();
    }else if($_SESSION['username'] != 'admin'){
	header("Location: ../View/dashboard.php?error=unauthorized");
	exit();
      
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
    <script src="../js/viewusers.js"></script>

    <link rel="stylesheet" href="../css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/viewusers.css" />

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
    
    <!-- Page heading-->
    <div class="page-header">
	<div class="container-fluid">
	  
	</div>
    </div>

    <!--show users-->
    <div class="col-md-12">
	<div class="panel panel-default">
	    <div class="panel-heading">
		<div class="pull-right" style="margin-top:1%">
		    <a href="userProfile.php" data-toggle="tooltip" class="btn btn-primary btn-flat" data-original-title="Add New User"><i class="fa fa-plus"></i></a>
		    <button data-toggle="tooltip" class="btn btn-default btn-flat" value="Reload Page" onClick="document.location.reload(true)" data-original-title="Refresh"><i class="fa fa-refresh"></i></button>
		</div>
		<h1>Users
		<!--<div class="input-group">
		    <div class="input-group-btn">
			<button type="button" class="btn btn-primary btn-flat dropdown-toggle" data-toggle="dropdown">
			<span class="fa fa-gear"> <i class="filesIcon fa fa-caret-down icon"></i></span></button>
			<ul class="dropdown-menu">
			    <li><a href="userProfile.php?id='.$row['id'].'"><i class="filesIcon fa fa-edit icon"></i> Edit</a></li>
			    <li><a href="#" data-href="../includes/deleteUser.inc.php?id='.$row['id'].'" data-toggle="modal" data-target="#confirm"><i class="filesIcon fa fa-eye icon"></i> Delete</a></li>
			</ul>
		    </div>
		    <!-- /btn-group
		</div> -->
		<a href="../includes/cup.php"><button data-toggle="tooltip" class="btn btn-default btn-danger btn-flat" value="Reload Page" data-original-title="Refresh"><i class="fa fa-refresh"></i>Test</button></a>
		&nbsp;<a href="../includes/clean.php"><button data-toggle="tooltip" class="btn btn-danger btn-flat" value="Reload Page" data-original-title="Refresh"><i class="fa fa-refresh"></i>Clean</button></a>
		</h1>
	    </div>
	    <div class="panel-body">
		<!-- users list-->
		<table class="table table-hover table-striped table-responsive" style="margin-top: 1px;">
		    <thead>
			<tr>
			    <th>
				User id
			    </th>
			    <th>
				Username
			    </th>
			    <th>
				Email
			    </th>
			    <th class="td-right">Action</th>
			</tr>
		    </thead>
		    <tbody>
			<?php
			    require "../includes/dbh.inc.php";

			    $sql = "SELECT * FROM users;";
			    $stmt = mysqli_stmt_init($conn);
			    if(!mysqli_stmt_prepare($stmt,$sql)){
				header("Location: ../View/viewUsers.php");
				exit();
			    }else{
				mysqli_stmt_execute($stmt);
				mysqli_stmt_store_result($stmt);
				$result = mysqli_query($conn, $sql);
				$resultcheck = mysqli_num_rows($result);
				if($resultcheck > 0){
				    $count = 1;
				    while($row = mysqli_fetch_assoc($result) ){
				    echo '<tr>
					<td>'.$count.'</td>
					<td>'.$row['username'].'</td>
					<td>';
						if(strlen($row['email']) > 8)
							echo substr($row['email'],0,7).'...';
						else
							echo $row['email'];
					echo '</td>
					<!--<td class="td-right">
					<a class="btn btn-primary btn-flat" data-toggle="tooltip" data-original-title="Edit" href="../View/userprofile.php?username='.$row['username'].'">
					<i class="filesIcon fa fa-edit icon"></i>
					</a>
					</td>-->
					<td>
					    <div class="input-group">
						<div class="input-group-btn">
						    <button type="button" class="btn btn-primary btn-flat dropdown-toggle" data-toggle="dropdown">
						    <span class="fa fa-gear"> <i class="filesIcon fa fa-caret-down icon"></i></span></button>
						    <ul class="dropdown-menu">
							<li><a href="userProfile.php?id='.$row['id'].'"><i class="filesIcon fa fa-edit icon"></i> Edit</a></li>
							<li><a href="#" data-href="../includes/deleteUser.inc.php?id='.$row['id'].'" data-toggle="modal" data-target="#confirm"><i class="filesIcon fa fa-eye icon"></i> Delete</a></li>
						    </ul>
						</div>
						<!-- /btn-group -->
					    </div>
					</td>
				    ';$count++;
				    }
				}else{
				    echo '<tr class="danger text-center">
					<td colspan="4">No records found.</td>
					</tr>';
				}
			    }
			    mysqli_stmt_close($stmt);
			    mysqli_close($conn);
			?>
		    </tbody>
		</table>
	    </div>
	</div>
    </div>

    <!-- confirm modal-->
    <div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
	    <div class="modal-content">
		<div class="modal-header">
		    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		    <h4 class="modal-title" id="myModalLabel">Confirm Message</h4>
		</div>
		<div id="modal-confirm-message" class="modal-body reminder-modal">

		</div>
		<div class="modal-footer" align="right">
		    <button type="button" class="btn btn-default confirm-no" data-dismiss="modal" style="width: 20%;">Close</button>
		    <a class="btn btn-primary btn-ok" style="width: 20%;">Confirm</a>
		</div>
	    </div>
	<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
    </div>
</body>
</html>
