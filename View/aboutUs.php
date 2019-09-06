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
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	
	<title>Users</title>
	<!-- <?php include('../View/include.php');?> -->

	<!-- <script src="../js/homepage.js"></script> -->
	<script src="../js/viewusers.js"></script>
	
	<link rel="stylesheet" href="../css/dashboard.css" />
	<link rel="stylesheet" type="text/css" href="../css/style-about.css">

	<style type="text/css">
		.form-control-feedback{
			width: 63px !important;
			line-height: 32px !important;
		}
		#main{
			padding-top: 60px;
		}
		#team{
			padding-top: -1000px !important;
		}

	</style>
</head>
<body>
	<?php include('../View/navbar.php'); ?>
	<main id="main">
	<!--==========================
      About Section
    ============================-->
    <section id="about">
      <div class="container">
        <div class="row about-container">

          <div class="col-lg-6 content order-lg-1 order-2">
            <h2 class="title">About</h2>
            <p class="description">
              For the demanding coffee connoisseur who lives on the bleeding edge of technology, the <b>XPRESSO</b> is here to satisfy your needs. You can't control it via voice-recognition, but the connected web-based application has adjustments for ingredients' levels, preset combinations, and brewing schedule. If you're in a hurry, you can even select the last option that you've made.

                The <b>XPRESSO</b> is a part of the reasearch proposal entitled <b>Web Application-Controlled Electronic Variable Coffee Mixer</b> that aims to develop a convenient ad efficent system of preparing coffee that will cater the needs of people with different coffee taste preferences by the use of an electroic variable coffee mixer controlled through a web application using a Raspberry Pi.
            </p>
          </div>

          <!-- <div class="col-lg-6 background order-lg-2 order-1 wow fadeInRight"></div> -->
        </div>

      </div>
    </section><!-- #about -->


<!--==========================
      Team Section
      ============================-->
      <section id="team">
      	<div class="container wow fadeInUp">
      		<div class="section-header">
      			<h3 class="section-title">The Researchers</h3>
      			<p class="section-description">We are the researchers behind the project entitled Web Application-Controlled Electronic Variable Coffee Mixer</p>

      		</div>
      		<div class="row">
      			<div class="col-lg-3 col-md-6">
      				<div class="member">
      					<div class="pic"><img src="../images/team-1.jpg" alt=""></div>
      					<h4>Robert Media</h4>
      					<span>Bachelor of Science in Computer Engineering, Polytechnic University of the Philippines, Sta. Mesa, Manila</span>
      				</div>
      			</div>

      			<div class="col-lg-3 col-md-6">
      				<div class="member">
      					<div class="pic"><img src="../images/team-2.jpg" alt=""></div>
      					<h4>Zidrex Andag</h4>
      					<span>Bachelor of Science in Computer Engineering, Polytechnic University of the Philippines, Sta. Mesa, Manila</span>
      				</div>
      			</div>

      			<div class="col-lg-3 col-md-6">
      				<div class="member">
      					<div class="pic"><img src="../images/team-3.jpg" alt=""></div>
      					<h4>Jayven Buyco</h4>
      					<span>Bachelor of Science in Computer Engineering, Polytechnic University of the Philippines, Sta. Mesa, Manila</span>
      				</div>
      			</div>

      			<div class="col-lg-3 col-md-6">
      				<div class="member">
      					<div class="pic"><img src="../images/team-4.jpg" alt=""></div>
      					<h4>Alyssa Apura</h4>
      					<span>Bachelor of Science in Computer Engineering, Polytechnic University of the Philippines, Sta. Mesa, Manila</span>
      				</div>
      			</div>
      		</div>

      	</div>
    </section><!-- #team -->
</main>

</body>
</html>