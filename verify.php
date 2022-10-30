<?php
	if (isset($_GET['vkey'])){
		//Verification process
		$vkey = $_GET['vkey'];



		$mysqli = NEW MySQLi('localhost','root','','test');

		$resultSet = $mysqli->query("SELECT verified,vkey FROM accounts WHERE verified = 0 and vkey = '$vkey' LIMIT 1");

		if($resultSet->num_rows == 1){
			//validate email
			$update = $mysqli->query("UPDATE ACCOUNTS SET verified = 1 WHERE vkey = '$vkey' LIMIT 1");


		if($update){
			//echo "Account is already verified , you can now login";
		}else{
			echo $mysqli->error;
		}
	}else{
			//echo "The email that you entered already exists.";
	}

}

else{
		die("Oh no, something went wrong.");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>THANK YOU!</title>
	<link rel="stylesheet" href="styles.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">

	<style type="text/css">
.forbg{
	height: 100vh;
	width: 100vw;
}


.logo{
		-webkit-filter: drop-shadow(5px 10px 5px #555555);
        filter: drop-shadow(5px 10px 5px #555555);
	}

.gap{
		
	padding-bottom: 155px;
	
}

h1{

	text-align: center;
}

.check{
	margin-top: 20px;
	text-align: center;
}

</style>
</head>
<body>
<div class="forbg">
<div class="header">
	<div class="container">
		<div class="navbar">
			<div class="logo">
				<img src="images/logomedasee.png" width="200px">
			</div>
			<nav>
				<ul>
					<li><a href="medase.php">Home</li></a>
					<li><a href="">About</li></a>
					<li><a href="">Contact</li></a>
					<li><a href="login.php">Account</li></a>
				</ul>
			</nav>
			<div class="book">
				<img src="images/book.png" width="35px" height="25px">
			</div>	
		
		</div> <!--navbar closing div tag-->
		<h1>Account is now verified , you can now login!</h1>
		<div class="check">
			<img src="images\check_mark2.gif" >
		</div>
		</div>
	</div>
</div>




</div>
</body>
</html>