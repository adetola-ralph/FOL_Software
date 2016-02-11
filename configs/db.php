<?php
class MyDatabase
{
	private $db_name;
	private $db_username;
	private $db_password;
	private $db_host;
	
	private $db_conn;
	private $error;
	
	public function __construct($host,$name,$username,$password)
	{
		$this->db_host = $host;
		$this->db_name = $name;
		$this->db_username = $username;
		$this->db_password = $password;
		
		$dsn = 'mysql:host=' . $this->db_host . ';dbname=' . $this->db_name;
		
		$options = array(
            PDO::ATTR_PERSISTENT    => true,
            PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION
        );
        // Create a new PDO instanace
        try
		{
			//echo "try";
            $this->db_conn = new PDO($dsn, $this->db_username, $this->db_password, $options);		
        }
        // Catch any errors
        catch(PDOException $e){
			//echo "catch";
            $this->error = $e->getMessage();
			//echo ($e->getMessage());
        }
	}
	
	public function get_connection()
	{
		//if($this->db_conn != null)
		//{
			return $this->db_conn;
		//}return null;
	}
}
?>