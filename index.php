<?php
$host_heroku = "ec2-34-203-255-149.compute-1.amazonaws.com";
$db_heroku = "d642kjd2c1kho9";
$user_heroku = "nkkmoipxidjucr";
$pw_heroku = "d7e2d81d7683c4e0b617b5004f9f0c56f2accc2c28e3fcd58e5abdc8165aabcc";

$conn_string = "host=$host_heroku port=5432 dbname=$db_heroku user=$user_heroku password=$pw_heroku";
$pg_heroku = pg_connect($conn_string);

if (!$pg_heroku)
  {
    exit('Error: Could not connect: ' . pg_last_error());
  }

if(isset($_POST['login'])&&!empty($_POST['login'])){
    
    #$hashpassword = md5($_POST[password]);
	$role1 = 'boss01';
	$role2 = 'staff01';
	#$username = $_POST['username']
    $sql ="select * from accounts where username = '$_POST[username]' and password ='$_POST[password]'";
    $sql1 = "select superior from accounts where username = '$_POST[username]' and password ='$_POST[password]'";
    $data = pg_query($pg_heroku,$sql);
    $data1 = pg_query($pg_heroku,$sql1);
    $login_check = pg_num_rows($data);
    if($login_check > 0)
    { 
        if ($_POST['username'] == $role1)
	{
		#echo $data1;
		header('Location: home1.php');
	}else{
		#echo $data1;
		header('Location: home.php');
	}
    }else{
        echo "Invalid Details";
	    
        
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
