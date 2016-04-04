<?php

	include("../configs/db.php");
	
	$db = new MyDatabase("localhost","foldb","root","");
	$conn = $db->get_connection();
	
	$query="SELECT DISTINCT EXTRACT(YEAR_MONTH FROM regDate) AS yeardate FROM converts";
	$sth = $conn->query($query);
	$result = $sth->fetchAll(PDO::FETCH_NUM);
	//print_r($result);
	//echo json_encode($result);
	
	$dateObject = array();
	
	foreach($result as $datemonth)
	{
		 substr($datemonth[0], 0, 4);
		 substr($datemonth[0], 4);
		 array_push($dateObject,array( "year"=>substr($datemonth[0], 0, 4),"month"=>substr($datemonth[0], 4)));
	}
	
	echo json_encode($dateObject);
	
	//$query2 = "SELECT * FROM converts WHERE YEAR(regDate) = 2016 AND MONTH(regDate) = 4 ORDER BY id";

?>