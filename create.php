 <?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE site";
$sql2= " ALTER DATABASE `site` DEFAULT CHARACTER SET utf8 COLLATE utf8_hungarian_ci";
if ($conn->query($sql) === TRUE) {
if ($conn->query($sql2) === TRUE){
echo "Database created successfully";}
else{echo "Error creating database: " . $conn->error;}
} else {
    echo "Error creating database: " . $conn->error;
}

$conn->close();
?> 

<?php
$conn =new mysqli('localhost', 'root', '' , 'site');

$query = '';
$sqlScript = file('menu.sql');
foreach ($sqlScript as $line)	{
	
	$startWith = substr(trim($line), 0 ,2);
	$endWith = substr(trim($line), -1 ,1);
	
	if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
		continue;
	}
		
	$query = $query . $line;
	if ($endWith == ';') {
		mysqli_query($conn,$query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');
		$query= '';		
	}
}
echo '<div class="success-response sql-import-response">SQL file imported successfully</div>';
?>

<?php
$conn =new mysqli('localhost', 'root', '' , 'site');

$query = '';
$sqlScript = file('user.sql');
foreach ($sqlScript as $line)	{
	
	$startWith = substr(trim($line), 0 ,2);
	$endWith = substr(trim($line), -1 ,1);
	
	if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
		continue;
	}
		
	$query = $query . $line;
	if ($endWith == ';') {
		mysqli_query($conn,$query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');
		$query= '';		
	}
}
echo '<div class="success-response sql-import-response">SQL file imported successfully</div>';
?>