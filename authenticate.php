<?php
session_start();

// Change this to your connection info.
$host_heroku = "ec2-34-203-255-149.compute-1.amazonaws.com";
$db_heroku = "d642kjd2c1kho9";
$user_heroku = "nkkmoipxidjucr";
$pw_heroku = "d7e2d81d7683c4e0b617b5004f9f0c56f2accc2c28e3fcd58e5abdc8165aabcc";

$conn_string = "host=$host_heroku port=5432 dbname=$db_heroku user=$user_heroku password=$pw_heroku";
$pg_heroku = pg_connect($conn_string);

// Try and connect using the info above.
if (!$pg_heroku)
  {
    exit('Error: Could not connect: ' . pg_last_error());
  }

if(isset($_POST['login'])&&!empty($_POST['login'])){
    
    $hashpassword = md5($_POST['password']);
    $sql ="select *from  where username = '".pg_escape_string($_POST['username'])."' and password ='".$hashpassword."'";
    $data = pg_query($pg_heroku,$sql); 
    $login_check = pg_num_rows($data);
    if($login_check > 0){ 
        
        echo "Login Successfully";    
    }else{
        
        echo "Invalid Details";
    }
}
}
?>
