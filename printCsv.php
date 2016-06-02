<?php
	include_once("php_class/auth.php");
	// echo(isset($_SERVER["HTTP_REFERER"]));
	if($_SERVER["HTTP_REFERER"] !== "http://folsoftware.local/print.php" || !isset($_SERVER["HTTP_REFERER"])) {
		header("LOCATION:print.php");
	}

	// output headers so that the file is downloaded rather than displayed
	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename=data.csv');

	require("php_class/convert.php");
	require("php_class/convertHelper.php");

	// create a file pointer connected to the output stream
	$output = fopen('php://output', 'w');

	$_dateObj = $_POST["select_date"];
	$_obj = explode("/",$_dateObj);
	$_year = $_obj[0];
	$_month = $_obj[1];

	// $ch = new convertHelper();
	// $convertArray = $ch->getAll();
	// $convertArray = $ch->getByYear(2016);
	// echo(json_encode($convertArray));
	// print_r( $convertArray);

	$file_header = array("ConvertID","ConvertTitle","ConvertFirstName","ConvertLastname","ConvertAddress","ConvertCity","ConvertCounty","ConvertPostalCode","ConvertCountry","ConvertAlterCallResType","ConvertDateOfNewBirth","ConvertFollowUpPerson","ConvertFolContNo","ConverZonalContTNo");

	/**
	*ConvertFollowUpPerson is the area counsellor (I'm guessing)
	*ConvertFolContNo is the phone number of the area counsellor
	*ConverZonalContTNo is the phone number of the zonal co-ordinator
	*/

	// output the column headings
	fputcsv($output, $file_header);

	//data source
	$db = new MyDatabase("localhost","foldb","root","");
 	$conn = $db->get_connection();


	$query = "SELECT converts.id AS ConvertID, converts.title AS ConvertTitle, converts.firstname AS ConvertFirstName, converts.lastname AS ConvertLastName, converts.address AS ConvertAddress, converts.city AS ConvertCity, converts.county AS ConvertCounty, converts.postcode AS ConvertPostalCode, apps_countries.country_name AS ConvertCountry, converts.altarCallResponse AS ConvertAlterCallResType, converts.regDate AS ConvertDateOfNewBirth, area_couns.name AS ConvertFollowUpPerson, area_couns.phoneNo AS ConvertFolContNo, zonal_coor.phoneNo AS ConverZonalContTNo FROM converts Inner Join apps_countries ON apps_countries.country_code = converts.country Inner Join area_couns ON area_couns.area = converts.area_couns Inner Join zonal_coor ON zonal_coor.zone = converts.zonal_coor WHERE YEAR(regDate) = {$_year} AND MONTH(regDate) = {$_month} ORDER BY ConvertID ASC";
	$stmt = $conn->prepare($query);
	$stmt->execute();

	//$convertArray1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
	while($row = $stmt->fetch(PDO::FETCH_NUM))
	{
		fputcsv($output, $row);
		//print_r($row);
	}

?>
