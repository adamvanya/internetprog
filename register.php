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
	$email=trim($_POST['email']);
	
	if (empty($user)){
		echo 'Üres Felhasználó.<p>';
		echo '<form action="signup.php">';
		echo '<input type="submit" value="TRY AGAIN" autofocus>';
		
	}else{
		if (empty($pass)){
			echo 'Üres Jelszó.<p>';
			echo '<form action="signup.php">';
			echo '<input type="submit" value="TRY AGAIN" autofocus>';
		}else{
			if (empty($email)){
			echo 'Üres Email.<p>';
			echo '<form action="signup.php">';
			echo '<input type="submit" value="TRY AGAIN" autofocus>';
			}else{//nem üres
				$password=sha1(md5($pass."almafa")); //<---jó eddig
				//echo ($user."    ".$pass."   ".$password);
				$userc="SELECT * FROM user WHERE username='".$user."'";
				$utest=mysqli_query($db,$userc);
				$usernum=mysqli_num_rows($utest);	
				if ($usernum!=0){
					echo 'Ez a felhasználó már létezik.<p>';
					echo '<form action="signup.php">';
					echo '<input type="submit" value="TRY AGAIN" autofocus>';
				}else{
					$emailc="SELECT * FROM user WHERE email='".$email."'";
					$etest=mysqli_query($db,$emailc);
					$emailnum=mysqli_num_rows($etest);
					if ($emailnum!=0){
					echo 'Az e-mail foglalt.<p>';
					echo '<form action="signup.php">';
					echo '<input type="submit" value="TRY AGAIN" autofocus>';
				}else{
					$insert="INSERT INTO `user` (`id`, `username`, `password`, `email`) VALUES (NULL, '".$user."', '".$password."', '".$email."');";
					$utest=mysqli_query($db,$insert);
					header("location: index.php");
					exit;
				}	
					
				}
			
		}
			
		}
	}
	mysqli_close($db);
	
			
	
	







?>
</body>
</html>