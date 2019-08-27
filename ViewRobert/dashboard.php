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
	<script src="../js/jquery-3.3.1.min.js"></script>
	<script src="../js/bootstrap/bootstrap.min.js"></script>
	<script src="../js/dashboard.js"></script>
	<script src="../js/bootstrapValidator.min.js"></script>
	<script src="../js/bootstrap-datetimepicker.min.js"></script>
	<script src="../js/common.js"></script>

	<link rel="stylesheet" href="../css/bootstrap/bootstrap.min.css">
	<link rel="stylesheet" href="../css/font-awesome.min.css">
 	<link rel="stylesheet" href="../css/dashboard.css" />
 	<!--<link rel="stylesheet" href="../css/common.css" /> -->
 	<link rel="stylesheet" href="../css/bootstrap-datetimepicker.min.css" />
 	<link rel="stylesheet" href="../css/modal.css" />

	<link rel="shortcut icon" href="../images/hot-coffee-icon.png" />

</head>
<body>
<?php include('../includes/navbar.php'); ?>
	
	<!-- confirm navigation bar  -->
	<!-- class padding if you want to put content -->
	<div class="padding">
		<div class="container-fluid">
			<div class="row">
				<div class="center" style="margin-top:25px">
					<div class="col-xs-12 col-sm-4" style="margin-bottom:5px">
					<a href="#" data-toggle="modal" data-target="">
						<button class="btn btn-primary btn-block">Brew now</button>
					</div>
					<div class="col-xs-12 col-sm-4" style="margin-bottom:5px">
					<a href="#" data-toggle="modal" data-target="">
						<button class="btn btn-primary btn-block">Schedule</button>
					</div>
					<div class="col-xs-12 col-sm-4">
					<a href="#" data-toggle="modal" data-target="">
						<button class="btn btn-primary btn-block">Database</button>
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
								echo '<th>No.</th>
							<th>Application date</th>
							<th>Brew Date</th>
							<th class="td-right">Status</th>';
							}
						}
						?>
						</tr>
					</thead>
					<tbody id="tbody-brews">

					</tbody>
				 </table>
			</div>
		</div>
	</div>
	
	<!-- Modals section -->
	<div class="modal fade" id="brewnow" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">Ã—</span><span class="sr-only">Close</span></button>
					<h3 class="modal-title" id="lineModalLabel">Brew a coffee</h3>
				</div>
				<div class="modal-body">

					<!-- content goes here -->
					<form class="form-horizontal" id="execute_form" action="../includes/executebrew.inc.php" method="post" autocomplete="off">
					  
						<label class="control-label" for="coffeeLevel">Coffee Level:</label><div class="clearfix"></div>
						<label class="radio-inline"><input type="radio" value="1" name="coffeeLevel" checked>1</label>
						<label class="radio-inline"><input type="radio" value="2" name="coffeeLevel">2</label>
						<label class="radio-inline"><input type="radio" value="3" name="coffeeLevel">3</label>
						
						<div class="clearfix"></div>
						 
						<label class="control-label" for="creamerLevel">Creamer Level:</label><div class="clearfix"></div>
						<label class="radio-inline"><input type="radio" value="1" name="creamerLevel" checked>1</label>
						<label class="radio-inline"><input type="radio" value="2" name="creamerLevel">2</label>
						<label class="radio-inline"><input type="radio" value="3" name="creamerLevel">3</label>
						<label class="radio-inline"><input type="radio" value="4" name="creamerLevel">4</label>
						<label class="radio-inline"><input type="radio" value="5" name="creamerLevel">5</label>
						
						<div class="clearfix"></div>
						
						<label class="control-label" for="creamerLevel">Sugar Level:</label><div class="clearfix"></div>
						<label class="radio-inline"><input type="radio" value="1" name="sugarLevel" checked>1</label>
						<label class="radio-inline"><input type="radio" value="2" name="sugarLevel">2</label>
						<label class="radio-inline"><input type="radio" value="3" name="sugarLevel">3</label>
						<label class="radio-inline"><input type="radio" value="4" name="sugarLevel">4</label>
						<label class="radio-inline"><input type="radio" value="5" name="sugarLevel">5</label>
						
						<div class="clearfix"></div>
						 
						  <!--<div class="form-group col-lg-6 col-md-6">
							<label class="control-label" for="brewDate">Brew date:</label>
							<div class="input-group">
								<input class="form-control pull-right" id="brewDate" name="brewDate" />
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
							</div>
						  </div>-->
						<div class="clearfix"></div>
						
						<input type="hidden" name="userid" value="<?php echo $_SESSION['id'];?>">
						<input type="submit" name="executebrew-submit" class="btn btn-warning btn-md btn-save" value="Brew">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">Ã—</span><span class="sr-only">Close</span></button>
					<h3 class="modal-title" id="lineModalLabel">Brew a coffee</h3>
				</div>
				<div class="modal-body">

						<!-- content goes here -->
					<form class="form-horizontal" id="submit_form" action="../includes/saveBrew.inc.php" method="post" autocomplete="off">
						 <div class="form-group col-lg-3">
							<label class="control-label" for="coffeeLevel">Coffee Level:</label><div class="clearfix"></div>
							<label class="radio-inline"><input type="radio" value="1" name="coffeeLevel" checked>1</label>
							<label class="radio-inline"><input type="radio" value="2" name="coffeeLevel">2</label>
							<label class="radio-inline"><input type="radio" value="3" name="coffeeLevel">3</label>
						</div>
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
						<div class="form-group col-lg-5">
							<label class="control-label" for="creamerLevel">Creamer Level:</label><div class="clearfix"></div>
							<label class="radio-inline"><input type="radio" value="1" name="creamerLevel" checked>1</label>
							<label class="radio-inline"><input type="radio" value="2" name="creamerLevel">2</label>
							<label class="radio-inline"><input type="radio" value="3" name="creamerLevel">3</label>
							<label class="radio-inline"><input type="radio" value="4" name="creamerLevel">4</label>
							<label class="radio-inline"><input type="radio" value="5" name="creamerLevel">5</label>
						</div>
						<div class="clearfix"></div>
						 <div class="form-group col-lg-5">
							<label class="control-label" for="sugarLevel">Sugar Level:</label><div class="clearfix"></div>
							<label class="radio-inline"><input type="radio" value="1" name="sugarLevel" checked>1</label>
							<label class="radio-inline"><input type="radio" value="2" name="sugarLevel">2</label>
							<label class="radio-inline"><input type="radio" value="3" name="sugarLevel">3</label>
							<label class="radio-inline"><input type="radio" value="4" name="sugarLevel">4</label>
							<label class="radio-inline"><input type="radio" value="5" name="sugarLevel">5</label>
						</div>
						<div class="clearfix"></div>
						 
						<!--<div class="form-group col-lg-6 col-md-6">
							<label class="control-label" for="brewDate">Brew date:</label>
							<div class="input-group">
								<input class="form-control pull-right" id="brewDate" name="brewDate" />
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
							</div>
						</div>-->
						
						<div class="clearfix"></div>
						<input type="hidden" name="userid" value="<?php echo $_SESSION['id'];?>">
						<input type="submit" name="brew-submit" class="btn btn-warning btn-md btn-save" value="Brew">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
					
					<!-- content goes here -->
					database
				</div>
				<div class="modal-footer">
					
				</div>
			</div>
		</div>
	</div>
	<div id="test" class="padding container-fluid"></div>
</body>
</html>
