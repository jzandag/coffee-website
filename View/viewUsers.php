<?php
    session_start();
    
    if(!isset($_SESSION['username'])){
		header("Location: http://localhost/smart-coffee/index.php?error=notlogged");
	
		exit();
    }else if($_SESSION['role'] != 'admin'){
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
    <?php include('../View/include.php');?>

    <script src="../js/viewusers.js"></script>

    <link rel="stylesheet" href="../css/dashboard.css" />

</head>
<body>
	<?php include('../View/navbar.php'); ?>
    
    <!-- Page heading-->
    <div class="page-header">
		<div class="container-fluid" style="margin-top:75px;">
		  
		</div>
    </div>

    <!--show users-->
    <div class="col-md-12">
	<div class="panel panel-default">
	    <div class="panel-heading" >
		<div class="pull-right" style="margin-top:1%">
		    <a href="userProfile.php" data-toggle="tooltip" class="btn btn-primary btn-flat" data-original-title="Add New User"><i class="fa fa-plus"></i></a>
		    <button data-toggle="tooltip" class="btn btn-default btn-flat" value="Reload Page" onClick="document.location.reload(true)" data-original-title="Refresh"><i class="fa fa-refresh"></i></button>
		</div>
			<h1><i class="fa fa-users"></i> Users
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
			
			</h1>
	    </div>
	    <div class="panel-body">
		<!-- users list-->
		<table class="table table-hover table-striped table-responsive" style="margin-top: 1px;">
		    <thead>
			<tr>
			    <th>User ID</th>
			    <th>Username</th>
			    <th>Email</th>
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
