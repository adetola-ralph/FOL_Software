<?php

	include("../configs/db.php");
	
	$db = new MyDatabase("localhost","foldb","root","");
	$conn = $db->get_connection();
	
	$query = "SELECT * FROM zonal_coor ";
?>