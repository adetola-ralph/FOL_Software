<?php
	include("../configs/db.php");

	$db = new MyDatabase("eu-cdbr-azure-west-d.cloudapp.net","folappdb", "b853a90a974d6f","8d4c78a1");
	$conn = $db->get_connection();

	$query = "SELECT country_code,country_name FROM apps_countries ORDER BY id ASC";
	$sth = $conn->query($query);
	$result = $sth->fetchAll(PDO::FETCH_ASSOC);

	$result_json = json_encode($result);
	echo $result_json;

	return $result_json;
?>
