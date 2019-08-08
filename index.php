<?php
    session_start();
    if(isset($_SESSION['username'])){
	header("Location: ../smart-coffee/View/dashboard.php");
	exit();
    }
    
    //$localip = $_SERVER['HTTP_CLIENT_IP'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Login</title>

    <script src="../smart-coffee/js/common.js"></script>
    <script src="../smart-coffee/js/jquery-3.3.1.min.js"></script>
    <script src="../smart-coffee/js/bootstrap/bootstrap.min.js"></script>

    <link rel="stylesheet" href="../smart-coffee/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../smart-coffee/css/font-awesome.min.css">
    <link rel="stylesheet" href="../smart-coffee/css/homepage.css" />

    <link rel="shortcut icon" href="../smart-coffee/images/hot-coffee-icon.png" />

</head>
<body>
    <div class="wrapper fadeInDown">
	<div id="formContent">
	<!-- Tabs Titles -->

	    <!-- Icon -->
	    <div class="fadeIn first">
		<img src="images/login.jpg" alt="coffee" />
		<h1>XPRESSO</h1>
	    </div>

	    <!-- Login Form -->
	    <form method="post" action="../smart-coffee/includes/login.inc.php">
		<input type="text" id="login" class="fadeIn second" name="emailUsername" placeholder="Username/email...">
		<input type="password" id="login" class="fadeIn third" name="password" placeholder="password...">
		<?php
		    if(isset($_GET['error'])){
			if($_GET['error'] == "wrongpwd"){
			    echo '<p class="signuperror text-danger">Wrong username or password!</p>';
			}else if($_GET['error'] == "nouser"){
			    echo '<p class="signuperror text-danger">User doesnt exist!</p>';
			}
		    }
		?>
		<input type="submit" class="fadeIn fourth" name="login-submit" value="Log In">

		<span id="error"></span>
	    </form>

	    <!-- dto ka muna
	    <?php
		if(isset($_GET['error'])){
		    if($_GET['error'] == "sqlerror"){
			echo '<p class="signuperror">SQL Error!</p>';
		    }
		}
	    ?>
-->
	    <!-- Remind Passowrd -->
	    <div id="formFooter">
		Department of Computer Engineering
	    </div>
	</div>
    </div>
</body>
</html>
