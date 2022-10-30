<?php

session_start();

$error = NULL;
if(isset($_POST['button'])){
	if(isset($_GET['email'])){
		$email = $_GET['email'];
	$pass = $_POST['pass'];
	$pass2 = $_POST['pass2'];



	if($pass != $pass2){
		$error .= "<p>Passwords do not match, please try again.</p>";
	}
	else{
	//connect sa database
		$mysqli = NEW MySQLi('localhost','root','rakknaitu3','test');


		//sanitize data
		$pass = $mysqli->real_escape_string($pass);
		$pass2 = $mysqli->real_escape_string($pass2);

		//encrypt
		$pass = md5($pass);

		$valid = $mysqli->query("SELECT password FROM accounts WHERE email = '$email' LIMIT 1");

		if($valid->num_rows == 1){
			//validate email
			$update = $mysqli->query("UPDATE ACCOUNTS SET password = '$pass' WHERE email = '$email' LIMIT 1");


			header('location:passwordupdated.php');
					}

			}
		}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Reset Password</title>
	<link rel="stylesheet" href="styles.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
</head>
<style type="text/css">
*{
	margin: 0;
	padding: 0;
}


body{
	margin: 0;
	padding: 0;
}

.forbg{
	height: 100vh;
	width: 100vw;
}


.logo{
		-webkit-filter: drop-shadow(5px 10px 5px #555555);
        filter: drop-shadow(5px 10px 5px #555555);
	}


.resetcontainer{
	width: 800px;
	background-color: white;
	margin: auto;
	color: #000000;
	padding: 10px 0px 10px 0px;
	text-align: center;
	border-radius: 15px 15px 0px 0px;
	transition: background 0.5s;
}



.resetcontainer:hover{
	background: #FFFA;
}



.resetpwd{
	background-color: white;
	width: 800px;
	margin: auto;
	border-radius: 0px 0px 14px 14px;
	transition: background 0.5s
}

.resetpwd:hover{
	background: #FFFA;
}

form{
	padding: 10px;
	padding-bottom: 50px;
}

form .txt_field{
  position: relative;
  border-bottom: 2px solid #279AC1;
  margin: 30px 0;
}
.txt_field input{
  width: 100%;
  padding: 0 5px;
  height: 40px;
  font-size: 16px;
  border: none;
  background: none;
  outline: none;
  color: #000000;
}
.txt_field label{
  position: absolute;
  top: 50%;
  left: 5px;
  color: #adadad;
  transform: translateY(-80%);
  font-size: 16px;
  pointer-events: none;
  transition: .3s;
}
.txt_field span::before{
  content: '';
  position: absolute;
  top: 40px;
  left: 0;
  width: 0%;
  height: 2px;
  transition: .3s;
}
.txt_field input:focus ~ label,
.txt_field input:valid ~ label{
  top: -5px;
  color: #2691d9;
}
.txt_field input:focus ~ span::before,
.txt_field input:valid ~ span::before{
  width: 100%;
}


form .txt_fld{
  position: relative;
  border-bottom: 2px solid #279AC1;
  margin: 30px 0;
}
.txt_fld input{
  width: 100%;
  padding: 0 5px;
  height: 40px;
  font-size: 16px;
  border: none;
  background: none;
  outline: none;
  color: #000000;
}
.txt_fld label{
  position: absolute;
  top: 50%;
  left: 5px;
  color: #adadad;
  transform: translateY(-80%);
  font-size: 16px;
  pointer-events: none;
  transition: .8s;
}
.txt_fld span::before{
  content: '';
  position: absolute;
  top: 40px;
  left: 0;
  width: 0%;
  height: 2px;
  transition: .8s;
}
.txt_fld input:focus ~ label,
.txt_fld input:valid ~ label{
  top: -5px;
  color: #2691d9;
}
.txt_fld input:focus ~ span::before,
.txt_fld input:valid ~ span::before{
  width: 100%;
}


.name{
	margin-left: 55px;
	margin-top: 30px;
	width: 125px;
	color: white;
	font-size: 18px;
	font-weight: 700;
}


.sub label{
  position: absolute;
  top: 50%;
  left: 5px;
  color: #adadad;
  transform: translateY(-80%);
  font-size: 16px;
  pointer-events: none;
  transition: .8s;
}

.sub input{
  width: 0%;
  padding: 0 5px;
  height: 40px;
  font-size: 16px;
  border: none;
  background: none;
  outline: none;
}

form .sub{
  position: relative;
  border-bottom: 2px solid #279AC1;
  margin: 30px 0;
}

input::placeholder {
        color: transparent;
 }

input:focus::placeholder{
 	transition: transform 0.9s;
 	transform: translateX(20%);
 		color: #adadad;
 }


 .resetbtn{
 	text-align: center;
 }

.resetbtn{
	text-align: center;
}


.error{
	color: red;
}
</style>
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
					<li><a href="myprofile2.php">Account</li></a>
				</ul>
			</nav>
			<div class="book">
				<img src="images/book.png" width="35px" height="25px">
			</div>
		</div>

			<div class="resetcontainer">
			<h1>Reset Password</h1>
		</div>
			<div class="resetpwd">
				<form method="POST" action="">
						 	<div class="error">
<?php

	 				echo $error;
?>
	 			</div>
	 			<div><h4>Hi! <?php if(!empty($_SESSION['username'])){ 
		echo $_SESSION['username'];
	} ?>, you can reset your password below.</h4></div>
		
							<div class="txt_field">
            	<input type="password" name="pass" id="name" required="label">
                <label> New Password</label> 	    
        			</div>

        			<div class="txt_field">
        			<input type="password" name="pass2" id="name" required="label"> 
                	<label>Repeat Password</label>	
            	</div>
            	<div class="resetbtn">
				<button type="submit" name="button" id="resetbtn" value="Reset" required class="btn">
					<h1>Reset</h1>
				</button>
	 			</div>	
        </div>
			</form>
	 		
	 		</div>

</body>
</html>
