<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<?php
//echo 'WTF';
//echo (stripslashes($_POST['username']));
	require_once 'config.php';
	require_once 'mogi.php';
	$mogi=new Mogi();
	
	
	$user=trim($_POST['username']);
	$pass=trim($_POST['password']);
	
	if (empty($user)){
		echo 'Üres Felhasználó.<p>';
		echo '<form action="login.php">';
		echo '<input type="submit" value="TRY AGAIN" autofocus>';
		
	}else{
		if (empty($pass)){
			echo 'Üres Jelszó.<p>';
			echo '<form action="login.php">';
			echo '<input type="submit" value="TRY AGAIN" autofocus>';
		}else{ //nem üres
			$password=sha1(md5($pass."almafa"));
			//echo ($user."    ".$pass."   ".$password);
			$felhasznalo=$mogi->sql_lekerd("SELECT password FROM user WHERE (username='".$user."')");
			if($felhasznalo[0][1]==0){
				echo 'Rossz felhasználó.<p>';
				echo '<form action="login.php">';
				echo '<input type="submit" value="TRY AGAIN" autofocus>';
			}else{
			if($felhasznalo[1][0]== $password){ //Siker
					session_start();
					$_SESSION["user"]=$user;
					header("location: index.php");
					exit;
					//$url='index.php';
					//echo '<META HTTP-EQUIV=REFRESH CONTENT="1; '.$url.'">';
				
			}else{ 
				echo 'Rossz Jelszó.<p>';
				echo '<form action="login.php">';
				echo '<input type="submit" value="TRY AGAIN" autofocus>';
				
			}
			
		}
			
		}
	}
	mysqli_close($db);
		
	
	







?>
</body>
</html>