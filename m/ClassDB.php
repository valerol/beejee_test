<?php
class DB 
{
	private $host;
	private $user;
	private $pass;
	private $base;
	private $charset;
	private $connect;

	function __construct( $host, $user, $pass, $base, $charset ) 
	{
		$this->charset = $charset;
		$this->connect = new mysqli( $host, $user, $pass, $base ) or die( mysqli_error( $connect ) );
		$this->connect->set_charset( $this->charset );
	}
	
	public function TableCheck( $table ) 
	{	
		$this->connect->query( "SHOW TABLES LIKE $table" );
	}
	
	public function TableCreate( $table, $cols ) 
	{	
		$query = "CREATE TABLE IF NOT EXISTS $table ( $cols	) ENGINE=InnoDB DEFAULT CHARSET=$this->charset";	
		
		if ( ! $this->connect->query( $query ) ) {
			throw new Exception( "Can't create table" );
		}
	}
	
	public function Select( $table, $values = '', $cond = '' ) 
	{
		$query = "SELECT $values FROM $table";
		
		if ( $cond !== '' ) {
			$query .= " WHERE $cond";
		}			
		return $this->connect->query( $query );
	}
	
	public function Insert( $table, $values ) 
	{
        if ( ! empty( $values ) ) {
		
			foreach ( $values as $col => $val ) {
				$cols[] = $col;
				$vals[] = $val;
			}
		}

		$cols = implode( ',', $cols );
		$vals = "'" . implode( "','", $vals ) . "'";
		$query = "INSERT INTO $table ( $cols ) VALUES ( $vals )";
		$this->connect->query( $query );
	}
	
	public function Update( $table, $cond, $values ) 
	{
		if ( ! empty( $values ) ) {
			$val_str = '';
		
			foreach ( $values as $key => $val ) {
				$val_str .= $key . '=' . "'" . $val . "'" . ',';
			}
			
			$val_str = rtrim( $val_str, ',' );
		}
		
		$query = "UPDATE $table SET $val_str WHERE $cond";
		$this->connect->query( $query );
	}
	
	public function Delete( $table, $cond ) 
	{
		$query = "DELETE FROM $table WHERE $cond";
		$this->connect->query( $query );
	}
			
	public function GetElements( $table, $values ) 
	{			
		$elements = array();
		
		if ( $res = $this->Select( $table, $values ) ) {

			while ( $element = $res->fetch_assoc() ) {
				$elements[] = $element;
			}
            return $elements;
		}
	}
	
	public function GetElement( $table, $values, $cond )
	{			
		if ( $res = $this->Select( $table, $values, $cond ) ) {
			$element = $res->fetch_assoc();
			return $element;
		}
	}
}
