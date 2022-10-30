<?php

session_start();

$error = NULL;
	if(isset($_POST['button'])){

	//get form data
	$username  = $_POST['username'];
	$pass = $_POST['pass'];
	$pass2 = $_POST['pass2'];
	$email = $_POST['email'];
	//connect sa database
	$mysqli = NEW MySQLi('localhost','root','','test');
	$username = $mysqli->real_escape_string($username);
	$email = $mysqli->real_escape_string($email);
	$checkexistsinguser = $mysqli->query("SELECT username FROM accounts WHERE username='$username'");
	$checkexistsingemail = $mysqli->query("SELECT username FROM accounts WHERE email='$email'");
	//error cases
	if(strlen($username) < 8){
		$error = "<p>Your username must be atleast 8 characters!</p>";
	}
	elseif($pass != $pass2){
		$error .= "<p>Passwords do not match, please try again.</p>";
	}
	elseif($checkexistsinguser->num_rows != 0){
      $error .= "<p>Username already exists.</p>";
      
	}/*
	elseif($checkexistsingemail->num_rows != 0){
      $error .= "<p>Email is already used, please enter another email.</p>";
      $mysqli -> close();									//!!!!!!!!!!UNCOMMENT FOR DEBUGGING PURPOSES!!!!!!
	}*/		
	else{
		//Form is valid

		//connect sa database
		//$mysqli = NEW MySQLi('localhost','root','rakknaitu3','test');
		
		//Sanitize form data
		//$username = $mysqli->real_escape_string($username);
		$pass = $mysqli->real_escape_string($pass);
		$pass2 = $mysqli->real_escape_string($pass2);
		//$email = $mysqli->real_escape_string($email);

		//Generate Vkey
		$vkey = md5(time().$username);

		///echo $vkey; for debugging purposes

		//insert acc into database
		$pass = md5($pass);
		$insert = $mysqli->query("INSERT INTO accounts(username,password,email,vkey,sub_date,sub_expire) VALUES ('$username','$pass','$email','$vkey','0000-00-00 00:00:00','0000-00-00 00:00:00')");


		if ($insert){
			//send e-mail
			$to = $email;
			$subject = "Email Verification";
			$message = "Hi! Thanks for registering in Medase PH , you may confirm your account verification on the link provided.<br><br>

			<a href = 'http://localhost/projects/technosite/verify.php?vkey=$vkey'> <h1>Verify Account </h1></a>";
			$headers = "From: jerwin_tuchi21@yahoo.com \r\n";
			$headers .= "MIME-Version: 1.0"."\r\n";
			$headers .= "Content-type:text/html; charset=UTF-8". "\r\n";

			mail($to,$subject,$message,$headers);

			header('location:thankyou.php');

		}
		else{
			echo $mysqli->error;
			$mysqli -> close();
		}
		
	}

}

?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Register your account</title>
	<link rel="stylesheet" href="styles.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
	<style type="text/css">

*{
	margin: 0;
	padding: 0;
}

.logo{
		-webkit-filter: drop-shadow(5px 10px 5px #555555);
        filter: drop-shadow(5px 10px 5px #555555);
	}

.regform{
	width: 800px;
	background-color: rgb(0,0,0,0.6);
	margin: auto;
	color: #FFFFFF;
	padding: 10px 0px 10px 0px;
	text-align: center;
	border-radius: 15px 15px 0px 0px;
	box-shadow: 10px 10px 9px grey;
}


.forbg{
	height: 100vh;
	width: 100vw;
}

.main {
	background-color: rgb(0,0,0,0.5);
	width: 800px;
	margin: auto;
	border-radius: 0px 0px 14px 14px;
}

form{
	padding: 10px;
	padding-bottom: 50px;
}



.name{
	margin-left: 55px;
	margin-top: 30px;
	width: 125px;
	color: white;
	font-size: 18px;
	font-weight: 700;
}


#name{
	margin-left: 30px;
	margin-right: 250px;
}

#submit{
	font-size: 20px;
	width: 100px;
}


.gap{
	padding-bottom: 122px;
}


.animated{
	opacity: 0.1;
	position: absolute;
	margin: 0;
  top: 44%;
  right: 38%;
  transform: translateY(-10%);
}

form .txt_field{
  position: relative;
  border-bottom: 2px solid #279AC1;
  margin: 30px 0;
}
.txt_field input{
  width: 95%;
  padding: 0 5px;
  height: 40px;
  font-size: 16px;
  border: none;
  background: none;
  outline: none;
}
.txt_field label{
  position: absolute;
  top: 50%;
  left: 5px;
  color: #adadad;
  transform: translateY(-80%);
  font-size: 16px;
  pointer-events: none;
  transition: .8s;
}
.txt_field span::before{
  content: '';
  position: absolute;
  top: 40px;
  left: 0;
  width: 0%;
  height: 2px;
  transition: .8s;
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


.btn{
	display: inline-block;
	background: #279AC1;
	color: #fff;
	padding: 8px 30px;
	margin: 30px 0;
	border-radius: 50px;
	transition: background 0.5s;
	margin: 0;
  transform: translateY(165%);
  transform: translateX(165%);

}

.btn:hover{
	background: #0000E1;
}

.error{
	color: black;
	background-color: crimson;
	width: 250px;
	border-color: green;
	border-radius: 4px 4px 4px 4px;
	text-align: center;
	box-shadow: 2px 2px 5px red;
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
			<a href="https://en.wikipedia.org/wiki/Main_Page">
				<img src="images/book.png" width="35px" height="25px">
				</a>
			</div>
			<?php if(!empty($_SESSION['username'])){?>
			<div class="logoutbtn">
			<input class="btn btn-primary" type="submit" name="logout" value="Logout">
			</div>
			<?php } ?>
		</div> <!--navbar closing div tag-->

		<!--REGISTRATION-->
		<div class="regform">
			<h1>Account Register</h1>
		</div>
		<div class="main"> <!--CLICKABLE-->
			<div class="animated">
                		<img src="images\regdesign.gif">
                	</div>
		 <form method="POST" action="">
		 	<div class="error">
					<?php

	 				echo $error;
	 				?>
	 			</div>

				<div class="txt_field">
					<input type="text" name="username" id="name" required="label">
                	<label>Username</label>
                	
        		</div>
        
            	<div class="txt_field">
            		<input type="password" name="pass" id="name" required="label">
                	<label>Password</label>
                	    
        		</div>

        		<div class="txt_field">
        			<input type="password" name="pass2" id="name" required="label"> 
                	<label>Repeat Password</label>
                	
            	</div>
                	

            	<div class="txt_field">
            		<input type="email" name="email" id="name" required="label">
                	<label>Email</label>
                	 
                </div>
                	   

			
				<button type="submit" name="button" id="regbtn" value="Register" required class="btn">
					<h1>Register</h1>
				</button>
	 			</div>	
	 		
            	
		</form>
	 		
	 		</div> <!-- main closing tag -->

	</div>
</div>



</body>
</html>