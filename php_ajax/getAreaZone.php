<?php

	include("../configs/db.php");
	

	$dbinfo = MyDatabase::getConnectionDetails();
	$host = $dbinfo["host"];
	$database = $dbinfo["database"];
	$username = $dbinfo["username"];
	$password = $dbinfo["password"];
	$db = new MyDatabase($host,$database,$username,$password);
	$conn = $db->get_connection();
	
	$outcode = $_GET["postcode"];
	
	//get what area the outcode belongs
	$query = "SELECT * FROM outcodes WHERE outcode = ? ";
	$stmt = $conn->prepare($query);
	$stmt->bindParam(1,$outcode);
	$stmt->execute();
	
	//echo($stmt->rowCount());
	
	if($stmt->rowCount() > 0)
	{
		$outCodeArea = $stmt->fetch(PDO::FETCH_ASSOC);
		//outcode and area number have been returned here
		//print_r( $convertArray);
		//returns the following format Array ( [outcode] => ?? [area] => ?? )
		
		//next get the Area Counsellor and the zone he/she belongs to
		
		$query1 = "SELECT * FROM area_couns WHERE area = ?";
		$stmt1 = $conn->prepare($query1);
		$stmt1->bindParam(1,$outCodeArea["area"]);
		$stmt1->execute();
		
		$AreaCoun = $stmt1->fetch(PDO::FETCH_ASSOC);
		//print_r($AreaCoun);
		//returns the following format Array ( [id] => ?? [name] => ?? [area] => ?? [zone] => ?? )
		
		//next get the Zonal coordinator
		$query2 = "SELECT * FROM zonal_coor WHERE zone = ?";
		$stmt2 = $conn->prepare($query2);
		$stmt2->bindParam(1,$AreaCoun["zone"]);
		$stmt2->execute();
		
		$zonalCoor = $stmt2->fetch(PDO::FETCH_ASSOC);
		//print_r($zonalCoor);
		//returns the following format Array ( [name] => ?? [zone] => ?? )
		
		$aggregate = array("zone"=>$zonalCoor['zone'], "zonal_coor"=>$zonalCoor['name'], "area"=>$AreaCoun['area'], "area_coun"=>$AreaCoun['name']);
		
		echo json_encode($aggregate);
	}
	else
	{
		//assuming it's a valid UK Code that doesn't exist in the outcode database
		$result = array("zone"=>"4", "zonal_coor"=>"Niyi Oludayomi", "area"=>"12", "area_coun"=>"Denis Amara");
		echo json_encode($result);
	}
?>
