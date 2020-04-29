<?php

require_once 'function/koneksi.php';
require_once 'function/helper.php';

session_start();

if(isset($_SESSION["user_login"]))
{
	header("location: home.php");
}

if(isset($_REQUEST['btn_login']))
{
	$username	=strip_tags($_REQUEST["txt_username_email"]);	
	$email		=strip_tags($_REQUEST["txt_username_email"]);	
	$password	=strip_tags($_REQUEST["txt_password"]);		
		
	if(empty($username)){						
		$errorMsg[]="please enter username or email";	
	}
	else if(empty($email)){
		$errorMsg[]="please enter username or email";	
	}
	else if(empty($password)){
		$errorMsg[]="please enter password";
	}
	else
	{
		try
		{
			$select_stmt=$db->prepare("SELECT * FROM user WHERE username=:uname OR email=:uemail");
			$select_stmt->execute(array(':uname'=>$username, ':uemail'=>$email));
			$row=$select_stmt->fetch(PDO::FETCH_ASSOC);
			
			if($select_stmt->rowCount() > 0)
			{
				if($username==$row["username"] OR $email==$row["email"])
				{
					if(password_verify($password, $row["password"])) 
					{
						$_SESSION["user_login"] = $row["user_id"];
						$loginMsg = "Successfully Login...";
						header("refresh:2; home.php");			
					}
					else
					{
						$errorMsg[]="wrong password";
					}
				}
				else
				{
					$errorMsg[]="wrong username or email";
				}
			}
			else
			{
				$errorMsg[]="wrong username or email";
			}
		}
		catch(PDOException $e)
		{
			$e->getMessage();
		}		
	}
}
?>

<?php include ('component/head.php')?>

	<body>
		<div class="login-page">
			<div class="form">
				<form class="login-form">
				<center><h1>Sign In</h1></center>
				<?php
				if(isset($errorMsg))
				{
					foreach($errorMsg as $error)
					{
					?>
						<div class="alert alert-danger">
							<strong><?php echo $error; ?></strong>
						</div>
					<?php
					}
				}
				if(isset($loginMsg))
				{
				?>
					<div class="alert alert-success">
						<strong><?php echo $loginMsg; ?></strong>
					</div>
				<?php
				}
				?>   
				<input type="text" name="txt_username_email" class="form-control" placeholder="Username or Email" />
				<input type="password" name="txt_password" class="form-control" placeholder="Password" />
				<input type="submit" name="btn_login" class="btn btn-primary"style="color: black;" value="Login">
				<p class="message">Not registered? <a href="<?php echo BASE_URL."register.php"; ?>">Create an account</a></p>
				</form>
			</div>
		</div>
		<?php include ('component/script.php')?>							
