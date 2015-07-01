<?php
class Database
{
	/* private static $dbName = 'dmt_final' ;
	private static $dbHost = 'localhost' ;
	private static $dbUsername = 'root';
	private static $dbUserPassword = '';  */
	private static $dbName = 'uskcorpi_dm_tool_test' ;
	private static $dbHost = '119.18.48.51' ;
	private static $dbUsername = 'uskcorpi_test';
	private static $dbUserPassword = 'test123'; 

	private static $cont  = null;

	public function __construct() {
		exit('Init function is not allowed');
	}

	public static function connect()
	{
		// One connection through whole application
		if ( null == self::$cont )
		{
			try
			{
				self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword);
			}
			catch(PDOException $e)
			{
				die($e->getMessage());
			}
		}
		return self::$cont;
	}

	public static function disconnect()
	{
		self::$cont = null;
	}
}
?>