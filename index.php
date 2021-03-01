<?php
$host_heroku = "ec2-34-203-255-149.compute-1.amazonaws.com";
$db_heroku = "d642kjd2c1kho9";
$user_heroku = "nkkmoipxidjucr";
$pw_heroku = "d7e2d81d7683c4e0b617b5004f9f0c56f2accc2c28e3fcd58e5abdc8165aabcc";

$conn_string = "host=$host_heroku port=5432 dbname=$db_heroku user=$user_heroku password=$pw_heroku";
$pg_heroku = pg_connect($conn_string);

if (!$pg_heroku)
  {
    die('Error: Could not connect: ' . pg_last_error());
  }

if ( !isset($_POST['username'], $_POST['password']) ) 
{
	// Could not get the data that should have been sent.
	die('Please fill both the username and password fields!');
}

if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) 
{
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();
	
	if ($stmt->num_rows > 0) 
	{
	$stmt->bind_result($id, $password);
	$stmt->fetch();
	// Account exists, now we verify the password.
	// Note: remember to use password_hash in your registration file to store the hashed passwords.
	if (password_verify($_POST['password'], $password)) 
	{
		header('Location: /home.php');
	} else 
	{
		echo 'Incorrect username and/or password!';
	}
} else {
	// Incorrect username
	echo 'Incorrect username and/or password!';


	$stmt->close();
}
?>

    if($login_check > 0){ 
        
        echo "Login Successfully";    
    }else{
        
        header('Location: /home.php');
    }
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Login</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
		<div class="login">
			<h1>Login</h1>
			<p>Login to go any further</p>
			<form method="post">
				<label for="username">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="username" placeholder="Username" id="username" required>
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="Password" id="password" required>
				<input type="submit" name="login" value="Login">
			</form>
		</div>
	</body>
</html>
