<?php 

	session_start(); 

	$mysqli = NEW MySQLi('localhost','root','','test');
	//$current_user =  $mysqli->query("SELECT * FROM accounts WHERE username = '$username'");
	$now = date("Y-m-d");
	$error = NULL;
	if(isset($_SESSION['username'])){
		$user = $_SESSION['username'];
		$get_sub_type = $mysqli->query("SELECT sub_type from accounts WHERE username = '$user' LIMIT 1");
		$row_sub = $get_sub_type->fetch_assoc();
		$user_sub_type = $row_sub['sub_type'];

		//for showing expiration
		$get_expiry = $mysqli->query("SELECT sub_expire FROM accounts WHERE username = '$user' LIMIT 1");
    	$row_get_expiry = $get_expiry->fetch_assoc();

    	$expiry_date = $row_get_expiry['sub_expire'];
    	$checktype =  gettype($get_expiry); //for debugging purposes
    	$display_date = date("Y-m-d",strtotime(date("Y-m-d",strtotime($expiry_date))));
    	
		if ($user_sub_type == '1'){
			$sub_type = 'free';
		}
		elseif ($user_sub_type == '2'){
			$sub_type = 'standard';
		}
		elseif ($user_sub_type == '3'){
			$sub_type = 'premium';
		}
		else{
			$sub_type = 'Not yet subscribed';
		}
		
		
		//real-time update yung expiry date na dinidisplay if expired na ba or hindi
		 if($now > $expiry_date){
    		$error .= "Membership already Expired!";
    		$sub_type = 'Membership Expired';
    		$update_account = $mysqli->query("UPDATE accounts SET sub_date = '0000-00-00 00:00:00',sub_expire = '0000-00-00 00:00:00',sub_type = 0  WHERE username = '$user' LIMIT 1");
    	}
    	else{
			$error .= "You're still subscribe";
    	}
		
	
	}

		





?>
<!DOCTYPE html>
<html>
<head>
	<title>My Profile</title>
	<link rel="stylesheet" type="text/css" href="profilestats2.css">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/ca5ab3a513.js" crossorigin="anonymous"></script>
</head>
<style type="text/css">
	.card-container{
		user-select: none;
	}

	h6{
		color: gray;
	}
	span .sub{
		color: gray;
	}

</style>


<body>
<div class="card-container">
	<div class="round"><i class="fas fa-user-circle fa-7x"></i></i></div>
	<h3><?php if(!empty($_SESSION['username'])){ 
		echo $_SESSION['username'];
	} ?></h3>
	<h6>Subscription status :</h6>
	<span class ="sub">
	<?php
		if ($sub_type == 'standard'){ # standard
		echo '<span style = "background-color: #279AC1;">' .ucfirst($sub_type).' </span>';
		}
		elseif ($sub_type == 'premium'){ # premium
		echo '<span style = "background-color: #FEBB0B;">' .ucfirst($sub_type).'</span>';
		}
		elseif ($sub_type == 'free'){ # premium
		echo '<span style = "background-color: lightgray;">' .ucfirst($sub_type).'</span>';
		}
		else{ 
		echo  ucfirst($sub_type);
		}


		

	?>
	</span>
	<p></p>
	<?php if($sub_type == 'Membership Expired'){?>
	<div class=expiry>
	<p>Your membership expired on </p> <?php echo $display_date; ?>
	</div>		
	<?php } else if($sub_type != 'Not yet subscribed' and $sub_type != 'Membership Expired'){?>
	<div class=expiry>
	<p>Expires on </p> <?php echo $display_date; ?>
	</div>
	<?php } ?>

	<button onclick= "window.location.href='accresetpass.php';" class="primary">
		Change Password
	</button>
	<div class="logoutb">
		<a href="logout.php"><span class="logoutbtn" onclick="return confirm('Are you sure to logout?');">
			<!--<input class="btn btn-primary" type="submit" name="logout"> -->Logout
		</span>
			</a>
		</div>
</div>
</div>
<?php if($sub_type == 'Not yet subscribed' or $sub_type == 'Membership Expired') { ?>
<div class = "back">
<a href="medase.php"><i class="fas fa-arrow-left fa-4x"></i></i></a>
</div>
<?php } 
 else {?>
<div class = "back">
<a href="mainpage.php"><i class="fas fa-arrow-left fa-4x"></i></i></a>
</div>
<?php  } ?>

</body>
</html>