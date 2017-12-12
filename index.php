<?php

session_start();

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Site</title>
		<link rel="stylesheet" type="text/css" href="ora2_1.css" >
	</head>

	<body>
		<div id="kontener">
			<div id="fejlec">
						Fejléc
			</div>			
			<div id="main">				
				<div id="menu">
					<nav class="navi">



<?php
	$connect=mysqli_connect("localhost","root","","site");
	if ($connect == false) {
		echo ("FAIL YOU SUCK!!!"); }
	else{
		mysqli_query($connect,"SET NAMES utf8");
		mysqli_query($connect,"SET collation_connection ='utf8'");
		$select="SELECT * FROM menu WHERE (parent=0)";
		$doit=mysqli_query($connect,$select);
		$rnumber=0;
		while($data=mysqli_fetch_row($doit)) {
			$rnumber++;
			$menus[$rnumber][0]=$data[0]; //id
			$menus[$rnumber][1]=$data[1]; //name
			$menus[$rnumber][2]=$data[2]; //link
			$menus[$rnumber][3]=$data[3]; //parent
		}
		
		//echo "<p>".$menus[1] [0]." ".$menus[1] [1]." ".$menus[1] [2]." ".$menus[1] [3];
		echo '<ul>';
		for ($i=1;$i<=$rnumber;$i++){
			$select="SELECT * FROM menu WHERE (parent=".$menus[$i][0].")";
			$result=mysqli_query($connect,$select);
			$subnum=mysqli_num_rows($result);
			if ($subnum == 0) {
				echo '<li>';
				echo '<a href="'.$menus[$i][2].'">';
				echo $menus [$i][1];
				echo '</a>';
				echo '</li>';
			}
			else {
				$subnum=0;
				while($data2=mysqli_fetch_row($result)) {
					$subnum++;
					$smenus[$subnum][0]=$data2[0]; //id
					$smenus[$subnum][1]=$data2[1]; //name
					$smenus[$subnum][2]=$data2[2]; //link
					$smenus[$subnum][3]=$data2[3]; //parent
				}
				echo '<li>'; //főmenü eleme
				echo '<a href="'.$menus[$i][2].'">';
				echo $menus [$i][1];
				echo '</a>';
				echo '<ul class="almenu">'; //almenü
				for($j=1;$j<=$subnum;$j++){
					echo '<li>';
					echo '<a href="'.$smenus[$j][2].'">';
					echo $smenus [$j][1];
					echo '</a>';
					echo '</li>';
					
				}
				echo '</ul>'; //almenü zár
				echo '</li>';
				
			}
		}
		$usernum=0;
		if (isset($_SESSION['user'])){
		$user=$_SESSION["user"];
		$session="SELECT * FROM user WHERE username='".$user."'";
		$test=mysqli_query($connect,$session);
		$usernum=mysqli_num_rows($test);	
		if ($usernum!=0){
			echo '<li><a href="logout.php" >Kijelentkezés</a></li>';
		}
		}else{
			echo '<li><a href="login.php" >Bejelentkezés</a>';
			echo '<ul class="almenu">';
			echo '<li><a href="signup.php" >Regisztráció</a></li>';
			echo '</ul>';
			echo '</li>';
		}
		echo '</ul>';
		mysqli_close($connect);
	}

?>

</nav>
				</div>			
				<div id="tartalom">
					<?php
							
						if ($usernum!=0){
							echo 'Hello '.$user.'';
						}else{
							echo 'Üdv az oldalon.';
						}
						
					?>
				</div>
			</div>			
			<div id="vizjel">
					Vízjel
			</div>					
		</div>
	</body>

</html>