<?php
class Mogi{

	function sql_lekerd($sqlut){
			
			$csatlakoz=mysqli_connect("localhost","root","","site");
			if (!$csatlakoz){
				//nem sikerült csatlakozni
				$kimenet [0] [0]=1 ;	//hiba 001
			}else{
				mysqli_query($csatlakoz,"SET NAMES utf8");
				mysqli_query($csatlakoz,"SET collation_connection ='utf8'");
				$vegrehajt=mysqli_query($csatlakoz,$sqlut);
				$erekord=0;
				if (!$vegrehajt) {
					$kimenet [0] [0] =2;	//hiba 002
				}else{
					while($adat=mysqli_fetch_row($vegrehajt)){
						$erekord++;
						for($i=0;$i<mysqli_num_fields($vegrehajt);$i++){
							$kimenet [$erekord][$i]=$adat[$i];						
							
						}
						
						
					}
					mysqli_close($csatlakoz);
					$kimenet [0][1]=$erekord;
					$kimenet [0][0]=0; //nincs hiba
					
				}
				
				
			}
		return $kimenet;
	}


}


?>