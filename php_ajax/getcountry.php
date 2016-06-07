<?php
	include("../configs/db.php");
	
	$dbinfo = MyDatabase::getConnectionDetails();
	$host = $dbinfo["host"];
	$database = $dbinfo["database"];
	$username = $dbinfo["username"];
	$password = $dbinfo["password"];
	$db = new MyDatabase($host,$database,$username,$password);
	$conn = $db->get_connection();
	
	$query = "SELECT country_code,country_name FROM apps_countries ORDER BY id ASC";
	$sth = $conn->query($query);
	$result = $sth->fetchAll(PDO::FETCH_ASSOC);
	
	$result_json = json_encode($result);
	echo $result_json;
	
	return $result_json;
?>