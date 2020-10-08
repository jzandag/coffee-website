<?php
    session_start();
    if(isset($_SESSION['username'])){
        header("Location: ../coffee-website/View/dashboard.php");
        exit();
    }

    //$localip = $_SERVER['HTTP_CLIENT_IP'];
?>

<html>
<head>
    
    <title>Login</title>

    <script src="../coffee-website/js/jquery-3.3.1.min.js"></script>
    <script src="../coffee-website/js/bootstrap/bootstrap.min.js"></script>
    <script src="../coffee-website/js/common.js"></script>

    <link rel="stylesheet" href="css/stylepic.css"> 

    <!-- RESPONSIVENESS CSS -->
    <link rel="stylesheet" href="../coffee-website/css/common-main.css" />

		
</head>
    <body>
    <div class="login-box">
    <img src="images/coffeemask2.png" class="avatar">
        <h1>Login Here</h1>
            <form method="post" action="../coffee-website/includes/login.inc.php">
            <p>Username</p>
            <input type="text" name="emailUsername" placeholder="Enter Username">
            <p>Password</p>
            <input type="password" name="password" placeholder="Enter Password">

            <?php
                if(isset($_GET['error'])){
                    if($_GET['error'] == "wrongpwd"){
                        echo '<p class="signuperror text-danger">Wrong username or password!</p>';
                    }else if($_GET['error'] == "nouser"){
                        echo '<p class="signuperror text-danger">User doesnt exist!</p>';
                    }
                }
            ?>
            <input type="submit" name="login-submit" value="Login">
            <span id="error"></span> 
            </form>
        
        
        </div>
        <!-- dto ka muna
            <?php
            if(isset($_GET['error'])){
                if($_GET['error'] == "sqlerror"){
                echo '<p class="signuperror">SQL Error!</p>';
                }
            }
            ?> -->
        
        <script type="text/javascript">
            $(document).ready(function() {
              update_list_main();

              setInterval(function(){
                update_list_main();
              },5000);


            });
        </script>
    </body>
</html>
