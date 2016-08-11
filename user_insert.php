<?php

if ( isset( $_POST['sign_up'] ) ) {

	$name 	 = mysqli_real_escape_string( $connection, $_POST['u_name'] );
	$pass 	 = mysqli_real_escape_string( $connection, $_POST['u_pass'] );
	$email 	 = mysqli_real_escape_string( $connection, $_POST['u_email'] );
	$country = mysqli_real_escape_string( $connection, $_POST['u_country'] );
	$gender  = mysqli_real_escape_string( $connection, $_POST['u_gender'] );
	$b_day   = mysqli_real_escape_string( $connection, $_POST['u_birthday'] );
	$status  = "unverified";
	$posts   = "No";
	$verification_code = mt_rand();

	$get_email = "SELECT * from users where user_email='$email'";
	$run_email = mysqli_query( $connection, $get_email );
	$check = mysqli_num_rows( $run_email );

	if ( $check == 1 ) {

		echo "<script>alert('Email is already registered, please try another!')</script>";
		exit();

	}

	if ( strlen( $pass ) < 8 ) {

		echo "<script>alert('Password should be 8 characters!')</script>";
		exit();

	} else {

		$insert = "INSERT INTO users(user_name,user_pass,user_email,user_country,user_gender,user_b_day,user_image,register_date,last_login,status,verification_code,posts,user_role) VALUES('{$name}','{$pass}','{$email}','{$country}','{$gender}','{$b_day}','default.jpg',NOW(),NOW(),'{$status}','{$verification_code}','{$posts}','subscriber')";
		
		$run_insert = mysqli_query( $connection, $insert );

			if ( $run_insert ) {

				echo "<div class='alert alert-success'>Hi $name, registration is almost complete. We have send an email to $email, please check your inbox or spam folder.</div>";

			}else {
				echo "User was not inserted";
			}

	}

	$to = $email;
	$subject = "Verify your email address";
	$message = "
	<html>
		Hello <strong>$name</strong> You have just created an account, please verify your email address by clicking below link:
		<a href='localhost/Social-Network/verify.php?code=$verification_code'>Click to Verify Your Email</a><br>
		<strong>Thank you fro creating an account!</strong>
	</html>
	";

	$headers  = "MIME-VERSION: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= "From: <admin@mail.com>" . "\r\n"; 

	mail( $to, $subject, $message, $headers );

}


?>