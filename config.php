<?php

$db = mysqli_connect("localhost","root","","site");
mysqli_query($db,"SET NAMES utf8");
mysqli_query($db,"SET collation_connection ='utf8'");
 
if($db === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>