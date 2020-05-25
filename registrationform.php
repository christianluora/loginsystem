<?php
//include the config file
require_once "config.php";

//define variables and initialize with empty values 
$username=$password=$confirm_password="";
$username_err=$password_err=$confirm_password_err="";

//processing form data when the form is submited
if($_SERVER["REQUEST_METHOD"] =="POST"){
	
	//validating username
	if(empty(trim($_POST["username"]))){
		$username_err="please enter a username";
	} else{
		$sql="SELECT id FROM users WHERE username = ?";

		if($stmt=mysqli_prepare($conn,$sql)){
			mysqli_stmt_bind_param($stmt,"s",$param_username);

			$param_username=$POST["username"]);
				

				//attempt to execute the prepared statement
			
			if(mysqli_stmt_execute($stmt)){

			if(mysqli_stmt_num_rows($stmt)==1){
				$username_err="This username has already been taken";
			} else {

				$username=trim($_POST["username"]);
			}

		} else {

			echo "OOOPs something went wrong please try again later"
		}

		//close statement


		mysqli_stmt_close( $stmt)



			}

		}
	}
	
}

    //validate user password 
    if(empty(trim($_POST["password"]))){
    	 $password_err="please provide a password";
    } elseif(strlen(trim($_POST["password"])) < 6){


    	$password_err="passsword must be atleast 6 characters long";

    } else{
    	$password=trim($_POST["password"]);
	    }


	//validate user confirm password
	    if(empty(trim($_POST["password"]))){
	    	$confirm_password_err="please confirm password";
	    } else{
	    	$confirm_password=trim($_POST["password"]);
	    if(empty($password_err)&($password!=$confirm_password)){
	    	$confirm_password_err="password did not match";
	    }


	    } 

	    //check input erors before submitting data into the database

	    if(empty($username_err)) && empty($password_err) && empty(confirm_password_err)){
	$sql="INSERT INTO users(username, password) VALUES(??)";


		if($stmt=mysqli_prepare($conn,$sql)){
			mysqli_stmt_bind_param($stmt,"ss",$param_username,$param_password);
		}

		$param_username=$username
		$param_password=password hash($password, PASSWORD_DEFAULT);//creates a password hash


		if(mysqli_stmt_execute($tmt)){
			//redirect to the login page

			header("location:login.php");
		} else{
			echo "something went wrong .Please try again later";

		}
			//close the statement
		mysqli_stmt_close($stmt);

		}
}

		mysqli_close($conn);

		}

		?>

		<!DOCTYPE HTML>
		<html lang="en">
		<head>
			<meta charset="UTF_8">
			<title>sign up</title>
			<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
			<style>
				body{ font:14px sans seriff; }
				.wrapper{width:350px; padding:20px;}
			</style>
		</head>
		<body>
			<div class="wrapper">
				<h2>sign up</h2>
				<p>please fill these form to create an account.</p>
				<form action="<?php echo htmlspecialchars($_SERVER["PHPSELF"]); ?>" method="post">
					
						<div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>	