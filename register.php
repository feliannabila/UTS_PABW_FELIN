<?php

require_once "function/koneksi.php";
require_once "function/helper.php";

if(isset($_REQUEST['btn_register']))
{
	$username	= strip_tags($_REQUEST['txt_username']);	
	$email		= strip_tags($_REQUEST['txt_email']);	
	$password	= strip_tags($_REQUEST['txt_password']);	
		
	if(empty($username)){
		$errorMsg[]="Please enter username";
	}
	else if(empty($email)){
		$errorMsg[]="Please enter email";	
	}
	else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		$errorMsg[]="Please enter a valid email address";
	}
	else if(empty($password)){
		$errorMsg[]="Please enter password";
	}
	else if(strlen($password) < 6){
		$errorMsg[] = "Password must be atleast 6 characters";
	}
	else
	{	
		try
		{	
			$select_stmt=$db->prepare("SELECT username, email FROM user
										WHERE username=:uname OR email=:uemail"); 
			$select_stmt->execute(array(':uname'=>$username, ':uemail'=>$email));  
			$row=$select_stmt->fetch(PDO::FETCH_ASSOC);	
			
			if($row["username"]==$username){
				$errorMsg[]="Sorry username already exists";	
			}
			else if($row["email"]==$email){
				$errorMsg[]="Sorry email already exists";
			}
			else if(!isset($errorMsg)) 
			{
				$new_password = password_hash($password, PASSWORD_DEFAULT); 
				
				$insert_stmt=$db->prepare("INSERT INTO user	(username,email,password) VALUES
																(:uname,:uemail,:upassword)"); 				
				
				if($insert_stmt->execute(array(	':uname'	=>$username, 
												':uemail'	=>$email, 
												':upassword'=>$new_password))){
													
					$registerMsg="Register Successfully..... Please Click On Login Account Link";
				}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
}
?>
<?php include ('component/head.php')?>
	<body>
		<div class="login-page">
			<div class="form">
				<center><h1>Sign Up</h1></center> 
				<form class="login-form">
					<?php
					if(isset($errorMsg))						{
						foreach($errorMsg as $error)
						{
						?>
							<div class="alert alert-danger">
								<strong>WRONG ! <?php echo $error; ?></strong>
							</div>
						<?php
						}
					}
					if(isset($registerMsg))
					{
						?>
							<div class="alert alert-success">
								<strong><?php echo $registerMsg; ?></strong>
							</div>
						<?php
					}
						?>   
					<input type="text" name="txt_username" class="form-control" placeholder="Username" />
					<input type="text" name="txt_email" class="form-control" placeholder="Email" />
					<input type="password" name="txt_password" class="form-control" placeholder="Password" />
					<input type="submit" name="btn_register" class="btn btn-primary" style="color: black;" value="Register">
					<p class="message">Already registered? <a href="<?php echo BASE_URL."index.php";?>">Sign In</a></p>
					</form>
				</div>
			</div>
										
<?php include ('component/script.php')?>
