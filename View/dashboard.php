<?php
	session_start();

	if(!isset($_SESSION['username'])){
		header("Location: http://localhost/coffee-website/index.php?error=notlogged");
	
		exit();
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">


	<title>Homepage</title>
	<?php include('../View/include.php');?>
	
	<script src="../js/dashboard.js"></script>



	<link rel="stylesheet" href="../css/dashboard.css" />
 	<link rel="stylesheet" href="../css/radio.css" />
 	<!--<link rel="stylesheet" href="../css/common.css" /> -->
 	
 	<link rel="stylesheet" href="../css/modal.css" />

	

</head>
<body>
	<style type="text/css">
		.submit-btns{
			padding-top: 15px;
		}
	</style>
	<!-- navigation bar-->
<?php include('../View/navbar.php'); ?>
	

	<!-- confirm navigation bar  -->
	<!-- class padding if you want to put content -->
	<div class="padding">
		<div class="container-fluid">
			<div class="row">
				<div class="center" style="margin-top:25px">
					<div class="col-xs-12 col-sm-4" style="margin-bottom:5px">
					<a href="#" data-toggle="modal" data-target="#brewnow">
						<button class="btn btn-primary btn-block">Brew now</button></a>
					</div>
					<div class="col-xs-12 col-sm-4" style="margin-bottom:5px">
					<a href="#" data-toggle="modal" data-target="#schedbrew">
						<button class="btn btn-primary btn-block">Schedule</button></a>
					</div>
					<div class="col-xs-12 col-sm-4">
					<a href="#" data-toggle="modal" data-target="#roundspaceModal">
						<button class="btn btn-primary btn-block">Analytics</button></a>
					</div>	
				</div>
			</div>
			
			<div class="row" id="queueSection">
				<table class="table table-hover table-striped table-responsive" style="margin-top: 1px;">
					<thead>
						<tr>
						<?php
						if(isset($_SESSION['role'])){
							if($_SESSION['role'] == 'admin'){
								echo '<th>No.</th>
							<th>Application date</th>
							<th>Brew Date</th>
							<th>User</th>
							<th class="td-right">Status</th>';
							}
							else {
								echo '  <th>No.</th>
										<th>Application date</th>
										<th>Brew Date</th>
										<th class="td-right">Status</th>';
							}
						}
						?>
						</tr>
					</thead>
					<tbody id="tbody-brews">
						<tr><td colspan=5 class="success text-center" ><a href="#" class="text-bold text-italic"><i class="fa fa-spinner fa-spin"></i> loading . . . </td></tr>
					</tbody>
				 </table>
			</div>
			<div class="alert alert-success alert-dismissible fade"></div>
		</div>
	</div>
	
	<!-- Modals section -->
	<div class="modal fade" id="brewnow" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
					<h3 class="modal-title" id="lineModalLabel">Brew a coffee</h3>
				</div>
				<div class="modal-body">

					<!-- content goes here -->
					<form class="form-horizontal" id="execute_form" action="../includes/executebrew.inc.php" method="post" autocomplete="off">
					  	<input type="hidden" name="userid" value="<?php echo $_SESSION['id'];?>">

					  	<!-- Coffee level -->
						<label class="control-label" for="coffeeLevel">Coffee Level:</label><div class="clearfix"></div>
				  		<div class="btn-group" data-toggle="buttons">
				  			<label class="btn btn-bgcolor active">
				  				<input type="radio" name="coffeeLevel" value="1" id="option1" autocomplete="off" checked="checked">
				  				<span class="glyphicon glyphicon-ok" style="color:white"></span>
				  			</label>
				  			<label class="btn btn-bgcolor1">
				  				<input type="radio" name="coffeeLevel" value="2" id="option2" autocomplete="off">
				  				<span class="glyphicon glyphicon-ok" style="color:white"></span>
				  			</label>
				  			<label class="btn btn-bgcolor2">
				  				<input type="radio" name="coffeeLevel" value="3" id="option3" autocomplete="off">
				  				<span class="glyphicon glyphicon-ok" style="color:white"></span>
				  			</label>

				  		</div>
						
						<div class="clearfix"></div>
						
						<!-- Creamier level -->
						<label class="control-label" for="creamerLevel">Creamer Level:</label><div class="clearfix"></div>
						<div class="btn-group" data-toggle="buttons">
							<!--  -->
							<label class="btn btn-bgcolor2">
								<input type="radio" name="creamerLevel" value="0" id="option2" autocomplete="off">
								<span class="glyphicon glyphicon-ok" style="color:#800000"></span>
							</label>
							<label class="btn btn-bgccolor active">
								<input type="radio" name="creamerLevel" value="1" id="option2" autocomplete="off" checked="checked">
								<span class="glyphicon glyphicon-ok" style="color:#800000"></span>
							</label>
							<label class="btn btn-bgccolor1">
								<input type="radio" name="creamerLevel" value="2" id="option1" autocomplete="off">
								<span class="glyphicon glyphicon-ok" style="color:#800000"></span>
							</label>
							<label class="btn btn-bgccolor2">
								<input type="radio" name="creamerLevel" value="3" id="option2" autocomplete="off">
								<span class="glyphicon glyphicon-ok" style="color:#800000"></span>
							</label>
							<label class="btn btn-bgccolor3">
								<input type="radio" name="creamerLevel" value="4" id="option2" autocomplete="off">
								<span class="glyphicon glyphicon-ok" style="color:#800000"></span>
							</label>
						</div>
						
						<div class="clearfix"></div>
						
						<!-- Sugar level -->
						<label class="control-label" for="sugarLevel">Sugar Level:</label><div class="clearfix"></div>
						<div class="btn-group" data-toggle="buttons">
							<label class="btn btn-bgccolor3">
								<input type="radio" name="sugarLevel" value="0" id="option2" autocomplete="off">
								<span class="glyphicon glyphicon-ok" style="color:#8B4513"></span>
							</label>
							<label class="btn btn-bgcccolor active">
								<input type="radio" name="sugarLevel" value="1" id="option2" autocomplete="off" checked="checked">
								<span class="glyphicon glyphicon-ok" style="color:#8B4513"></span>
							</label>
							<label class="btn btn-bgcccolor1">
								<input type="radio" name="sugarLevel" value="2" id="option1" autocomplete="off">
								<span class="glyphicon glyphicon-ok" style="color:#8B4513"></span>
							</label>
							<label class="btn btn-bgcccolor2">
								<input type="radio" name="sugarLevel" value="3" id="option2" autocomplete="off">
								<span class="glyphicon glyphicon-ok" style="color:#8B4513"></span>
							</label>
							<label class="btn btn-bgcccolor3">
								<input type="radio" name="sugarLevel" value="4" id="option2" autocomplete="off">
								<span class="glyphicon glyphicon-ok" style="color:#8B4513"></span>
							</label>
						</div>
						
						<div class="clearfix"></div><div class="clearfix"></div>
						
						<div class="submit-btns">
							<!-- <button type="submit" class="btn btn-submit btn-primary btn-md btn-save">
								<i class="fa fa-save fa-fw"></i> Brew
							</button> -->
							<input type="submit" name="executebrew-submit" class="btn btn-warning btn-md btn-save" value=' Brew'>
							<button type="button" class="btn btn-default btn-close" data-dismiss="modal">Close</button>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					Take a break
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal fade" id="schedbrew" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>
					<h3 class="modal-title" id="lineModalLabel">Brew a coffee</h3>
				</div>
				<div class="modal-body">

						<!-- content goes here -->
					<form class="form-horizontal" id="submit_form" action="../includes/saveBrew.inc.php" method="post" autocomplete="off">
						 <input type="hidden" name="userid" value="<?php echo $_SESSION['id'];?>">

					  	<!-- Coffee level -->
						<label class="control-label" for="coffeeLevel">Coffee Level:</label><div class="clearfix"></div>
				  		<div class="btn-group" data-toggle="buttons">
				  			<label class="btn btn-bgcolor active">
				  				<input type="radio" name="coffeeLevel" value="1" id="option1" autocomplete="off" checked="checked">
				  				<span class="glyphicon glyphicon-ok" style="color:white"></span>
				  			</label>
				  			<label class="btn btn-bgcolor1">
				  				<input type="radio" name="coffeeLevel" value="2" id="option2" autocomplete="off">
				  				<span class="glyphicon glyphicon-ok" style="color:white"></span>
				  			</label>
				  			<label class="btn btn-bgcolor2">
				  				<input type="radio" name="coffeeLevel" value="3" id="option3" autocomplete="off">
				  				<span class="glyphicon glyphicon-ok" style="color:white"></span>
				  			</label>

				  		</div>
						
						<div class="clearfix"></div>
						
						<!-- Creamier level -->
						<label class="control-label" for="creamerLevel">Creamer Level:</label><div class="clearfix"></div>
						<div class="btn-group" data-toggle="buttons">
							<!--  -->
							<label class="btn btn-bgcolor2">
								<input type="radio" name="creamerLevel" value="0" id="option2" autocomplete="off">
								<span class="glyphicon glyphicon-ok" style="color:#800000"></span>
							</label>
							<label class="btn btn-bgccolor active">
								<input type="radio" name="creamerLevel" value="1" id="option2" autocomplete="off" checked="checked">
								<span class="glyphicon glyphicon-ok" style="color:#800000"></span>
							</label>
							<label class="btn btn-bgccolor1">
								<input type="radio" name="creamerLevel" value="2" id="option1" autocomplete="off">
								<span class="glyphicon glyphicon-ok" style="color:#800000"></span>
							</label>
							<label class="btn btn-bgccolor2">
								<input type="radio" name="creamerLevel" value="3" id="option2" autocomplete="off">
								<span class="glyphicon glyphicon-ok" style="color:#800000"></span>
							</label>
							<label class="btn btn-bgccolor3">
								<input type="radio" name="creamerLevel" value="4" id="option2" autocomplete="off">
								<span class="glyphicon glyphicon-ok" style="color:#800000"></span>
							</label>
						</div>
						
						<div class="clearfix"></div>
						
						<!-- Sugar level -->
						<label class="control-label" for="sugarLevel">Sugar Level:</label><div class="clearfix"></div>
						<div class="btn-group" data-toggle="buttons">
							<label class="btn btn-bgcolor2">
								<input type="radio" name="creamerLevel" value="0" id="option2" autocomplete="off">
								<span class="glyphicon glyphicon-ok" style="color:#800000"></span>
							</label>
							<label class="btn btn-bgcccolor active">
								<input type="radio" name="sugarLevel" value="1" id="option2" autocomplete="off" checked="checked">
								<span class="glyphicon glyphicon-ok" style="color:#8B4513"></span>
							</label>
							<label class="btn btn-bgcccolor1">
								<input type="radio" name="sugarLevel" value="2" id="option1" autocomplete="off">
								<span class="glyphicon glyphicon-ok" style="color:#8B4513"></span>
							</label>
							<label class="btn btn-bgcccolor2">
								<input type="radio" name="sugarLevel" value="3" id="option2" autocomplete="off">
								<span class="glyphicon glyphicon-ok" style="color:#8B4513"></span>
							</label>
							<label class="btn btn-bgcccolor3">
								<input type="radio" name="sugarLevel" value="4" id="option2" autocomplete="off">
								<span class="glyphicon glyphicon-ok" style="color:#8B4513"></span>
							</label>
						</div>
						
						<div class="clearfix"></div>

						<div class="form-group col-lg-6 col-md-6 col-sm-4 offset-lg-1 offset-md-1 offset-sm-1">
							<label class="control-label" for="brewDate">Brew date:</label>
							<div class="input-group">
								<input class="form-control pull-left" id="brewDate" name="brewDate" />
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
						
						<div class="submit-btns">
							<!-- <button type="submit" class="btn btn-submit btn-primary btn-md btn-save">
								<i class="fa fa-save fa-fw"></i> Brew
							</button> -->
							<input type="submit" name="brew-submit" class="btn btn-warning btn-md btn-save" value=' Brew'>
							<button type="button" class="btn btn-default btn-close" data-dismiss="modal">Close</button>
						</div>

					</form>
				</div>
				<div class="modal-footer">
					noice
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal fade" id="roundspaceModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
					<h3 class="modal-title" id="lineModalLabel">My Modal</h3>
				</div>
				<div class="modal-body">
					<div class="btn-group pull-right">
						<button type="button" class="btn btn-primary btn-xs active">Apple</button>
						<button type="button" class="btn btn-primary btn-xs">Samsung</button>
						<button type="button" class="btn btn-primary btn-xs">Sony</button>
					</div>
					<div class="clearfix"></div>

				</div>
				<div class="modal-footer">
					hellos
				</div>
			</div>
		</div>
	</div>
	<div id="test" class="padding container-fluid"></div>

	<!-- <div class="row">
		<div class="col-lg-12">
			<div class="panel panel-defualt" >
				<div class="panel-heading with-border">
					<h1>SSS Table Details</h1>
					<div class=" pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse">
							<i class="fa fa-plus"></i>
						</button>
					</div>
				</div>
				<div class="panel-body" >
					<div class="row">
						<div class="col-lg-12" id="sss-table-body">
							<div class="form-group col-lg-2 col-md-2">
								 <button type="button" id="black-coffee" class="btn btn-box-tool">Black Coffee</button>
							</div>
						</div>
					</div>
				</div>

			</div>
			
		</div>
	</div> -->

</body>
</html>
