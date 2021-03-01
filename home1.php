<?php
// We need to use sessions, so you should always start sessions using the below code.
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
?>

<html>
<head>
	<meta charset="utf-8">
	<title>Database</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
</head>
<body>
	<nav class="navtop">
		<div>
			<h1>ATN website</h1>
			<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
		</div>
	</nav>
	<div class="content">
		<h2>DATABASE</h2>
		<p>Table of database</p>
		
	</div>
	<?php
		$query = 'select * from products';
		$result = pg_query($pg_heroku, $query);
		  # Display data column by column
		$i = 0;
		echo '<html><body><table><tr>';
		while ($i < pg_num_fields($result))
		{
		  $fieldName = pg_field_name($result, $i);
		  echo '<td>' . $fieldName . '</td>';
		  $i = $i + 1;
		}
		echo '</tr>';
		  # Display data row by row
		$i = 0;
		while ($row = pg_fetch_row($result)) 
		{
		  echo '<tr>';
		  $count = count($row);
		  $y = 0;
		  while ($y < $count)
		  {
		    $c_row = current($row);
		    echo '<td>' . $c_row . '</td>';
		    next($row);
		    $y = $y + 1;
		  }
		  echo '</tr>';
		  $i = $i + 1;
		}
		pg_free_result($result);

		echo '</table></body></html>';
	?>
	
	
</body>
</html>
