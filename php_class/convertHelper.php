<?php
include("/configs/db.php");
require_once("convert.php");

class convertHelper
{
	
	private $conn;
	
	public function __construct()
	{
		$db = new MyDatabase("localhost","foldb","root","");
		$this->conn = $db->get_connection();	
	}
		
	public static function getAll()
	{
		$query = "SELECT * FROM converts";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		$convertArray = array();
		
		if($stmt->fetchColumn() > 0)
		{
			$convertArray = $stmt->fetchAll(PDO::FETCH_CLASS, "Convert");
			return $convertArray;
		}else{return null;}
	}
	
	public function getConvert($id)
	{
		$query = "SELECT * FROM converts WHERE id = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam("i",$id);
		$stmt->execute();
		
		if($stmt->fetchColumn() == 1)
		{
			return $stmt->fetch(PDO::FETCH_CLASS, "Convert");
		}else{return null;}
		
	}
	
	public static function getByYear($year)
	{
		$query = "SELECT * FROM converts WHERE YEAR(date) = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam("i",$year);
		$stmt->execute();
		$convertArray = array();
		
		if($stmt->fetchColumn() > 0)
		{
			$convertArray = $stmt->fetchAll(PDO::FETCH_CLASS, "Convert");
			return $convertArray;
		}else{return null;}
	}
	
	public function insertConvert(Convert $convert)
	{
		$stringValues = "title,firstname,lastname,agerange,homeTelNum,officeTelNum,mobileTelNum,email,postcode,address,county,city,country,altarCallResponse,prayerPoints,regDate,area_supers,zonal_coor";
		$query = "INSERT INTO converts(".$stringValues.") VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$stmt = $this->conn->prepare($query);
		
		//$stmt->bindParam(1,$convert->id,PDO::PARAM_INT);
		$stmt->bindParam(1,$convert->title,PDO::PARAM_STR);
		$stmt->bindParam(2,$convert->firstname,PDO::PARAM_STR);
		$stmt->bindParam(3,$convert->lastname,PDO::PARAM_STR);
		$stmt->bindParam(4,$convert->agerange,PDO::PARAM_STR);
		$stmt->bindParam(5,$convert->homeTelNum,PDO::PARAM_INT);
		$stmt->bindParam(6,$convert->officeTelNum,PDO::PARAM_INT);
		$stmt->bindParam(7,$convert->mobileTelNum,PDO::PARAM_INT);
		$stmt->bindParam(8,$convert->email,PDO::PARAM_STR);
		$stmt->bindParam(9,$convert->postcode,PDO::PARAM_STR);
		$stmt->bindParam(10,$convert->address,PDO::PARAM_STR);
		$stmt->bindParam(11,$convert->county,PDO::PARAM_STR);
		$stmt->bindParam(12,$convert->city,PDO::PARAM_STR);
		$stmt->bindParam(13,$convert->country,PDO::PARAM_STR);
		$stmt->bindParam(14,$convert->altarCallResponse,PDO::PARAM_STR);
		$stmt->bindParam(15,$convert->prayerPoints,PDO::PARAM_STR);
		$stmt->bindParam(16,$convert->regDate,PDO::PARAM_STR);
		$stmt->bindParam(17,$convert->area_supers,PDO::PARAM_STR);
		$stmt->bindParam(18,$convert->zonal_coor,PDO::PARAM_STR);
		
		$stmt->execute();

		if($stmt->rowCount() == 1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function updateConvert(Convert $convert)
	{
		$stringValues = "title = ?,firstname = ?,lastname = ?,agerange = ?,homeTelNum = ?,officeTelNum = ?,mobileTelNum = ?,email = ?,postcode = ?,address = ?,county = ?,city = ?,country = ?,altarCallResponse = ?,prayerPoints = ?,area_supers = ?,zonal_coor = ?";
		
		$query = "UPDATE converts(".$stringValues.") WHERE id = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1,$convert->title,PDO::PARAM_STR);
		$stmt->bindParam(2,$convert->firstname,PDO::PARAM_STR);
		$stmt->bindParam(3,$convert->lastname,PDO::PARAM_STR);
		$stmt->bindParam(4,$convert->agerange,PDO::PARAM_STR);
		$stmt->bindParam(5,$convert->homeTelNum,PDO::PARAM_INT);
		$stmt->bindParam(6,$convert->officeTelNum,PDO::PARAM_INT);
		$stmt->bindParam(7,$convert->mobileTelNum,PDO::PARAM_INT);
		$stmt->bindParam(8,$convert->email,PDO::PARAM_STR);
		$stmt->bindParam(9,$convert->postcode,PDO::PARAM_STR);
		$stmt->bindParam(10,$convert->address,PDO::PARAM_STR);
		$stmt->bindParam(11,$convert->county,PDO::PARAM_STR);
		$stmt->bindParam(12,$convert->city,PDO::PARAM_STR);
		$stmt->bindParam(13,$convert->country,PDO::PARAM_STR);
		$stmt->bindParam(14,$convert->altarCallResponse,PDO::PARAM_STR);
		$stmt->bindParam(15,$convert->prayerPoints,PDO::PARAM_STR);
		$stmt->bindParam(16,$convert->area_supers,PDO::PARAM_STR);
		$stmt->bindParam(17,$convert->zonal_coor,PDO::PARAM_STR);
		
		$stmt->bindParam(18,$convert->id,PDO::PARAM_INT);
		$stmt->execute();
		
		if($stmt->rowCount() == 1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function deleteConvert(Convert $convert)
	{
		$query = "DELETE FROM converts WHERE id = ?";
		$stmt = $this->conn->prepare($query);
		$stmt = $conn->bindParam(1,$convert->id,PDO::PARAM_INT);
		$stmt->execute();
		
		if($stmt->rowCount() == 1)
		{
			return "Operation successful";
		}
		else
		{
			return "Unsuccesful operation";
		}
	}
}

?>