<?php 
	session_start(); 
	$mysqli = NEW MySQLi('localhost','root','','test');
	//$current_user =  $mysqli->query("SELECT * FROM accounts WHERE username = '$username'");

	$_SESSION['a'] = NULL;
	//echo $_SESSION['a']; //for debugging
	
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>
		MEDASE | Subscriptions
	</title>
	<link rel="stylesheet" type="text/css" href="subscriptions.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/ca5ab3a513.js"></script>
</head>
<style type="text/css">

		.forbg{
			height: 120vh;
			width: 99vw;
			background: url("images/bgmp.jpg");
			background-repeat: no-repeat;
			background-attachment: fixed;
		}
		.header{
      display: flex;
      position: relative;
      width: 100%;
      justify-content: center;
      align-items: center;
      padding-top: 0px;
      background: rgba(0, 0, 0, 0.1);
      margin-top: 0px;
      top: 0px;

    }
    .header-r { 
      position: absolute;
      font-size: 30px;
      right: 0;
      padding-right: 40px;
      padding-bottom: 20px;
    }

    .logouticon{
      padding-right: 42px;
    }

    .logouticon:hover{
    color: red;
    }
    .header-r:hover{
    color: red;
    }
    a:hover .header-r{
      text-decoration: none;
      color: red!important;
    }

    a:hover .header-r {
      color: red;
    }

    .accicon{
        width:10%;
                height:10%;
                position: absolute;
                right: 120px;
                bottom: 120px;

    }
    img {
                width:50%;
                height:50%;
            }

                .fixed-nav-bar {
          position: fixed;
          top: 0;
          left: 0;
          z-index: 9999;
          width: 100%;
          height: 45px;
          background-color: #0000;
      }

      .container{
         position: relative;
          text-align: center;
      }

    .header img {
    border: solid 5px transparent;
    border-radius: 50%;
    padding: 2.5px;
    transition: 0.4s;
}
  .header img:hover {
    border-color: #279AC1;
    
}

.accicon{
                width:10%;
                height:10%;
                position: absolute;
                right: 120px;
                bottom: 120px;

    }
.header-r{
      color: black;
    }
.gap{
	padding-bottom: 100px;
}
</style>

<body>
	<div class ="header">
		<div class="pads">
		<a href="medase.php" class="logo">
			<img src="images/homelogo.png" width="90px">
		</a>
		</div>

		<div class="accicon">
				<a href="login.php" class="logo"><img src="images/accounticon.png"></a>
			</div>
		<div class="header-r">	
			<a href="logout.php" id="logout"><i name ="logouticon" class="fa-solid fa-left-from-bracket"></i> <span class="header-r" onclick="return confirm('Are you sure to logout?');">Logout </span></a>
		</div>
	</div>
	<h1>Choose your subscription plan <?php if(!empty($_SESSION['username'])){ 
		echo $_SESSION['username'];
	} ?></h1>
	<form action="subscriptions.php" method="POST">	
	<div class="cards"><!-- Free -->
		<div class="card">
			<div class="box">
				<div class="content">
					<h3>Free Trial</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua.</p>
					<a href="checkout.php?a=free">Get started</a>
				</div>
			</div>
		</div>
		<div class="card"><!-- Standard -->
			<div class="box">
				<div class="content">
					<h3>Standard</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua.</p>
					<a href="checkout.php?a=standard">Proceed to payment</a>
				</div>
			</div>
		</div>
		<div class="card"><!-- Premium -->
			<div class="box">
				<div class="content">
					<h3>Premium</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua.</p>
					<a href="checkout.php?a=premium">Proceed to payment</a>
				</div>
			</div>
		</div>
	</div>
	</form>
	<div class="gap"></div>
</body>
</html>