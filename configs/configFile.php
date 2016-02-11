<?php
include("db.php");
$db = new MyDatabase("localhost","foldb","root","");
$conn = $db->get_connection();
//echo var_dump($db);
//echo var_dump($conn);

/*if($conn==null)
{
	echo "empty";
}else{echo var_dump($conn);}*/
?>