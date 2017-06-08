<?php
class Posts
{	
	private $db;
	private $table = 'feedbacks';
	
	public function __construct() 
	{
		global $config;
		$settings = $config->GetSettings( array( 'host', 'user', 'db_pass', 'db', 'db_charset' ) );
		$this->db = new DB ( 
			$settings[ 'host' ], 
			$settings[ 'user' ], 
			$settings[ 'db_pass' ], 
			$settings[ 'db' ], 
			$settings[ 'db_charset' ] 
        );
	}
	
	public function Retrieve( $props ) 
	{
		if ( $posts = $this->db->GetElements( $this->table, $props ) ) {
			return $posts;
		} else return false;
	}
	
	public function Publish( $ids ) 
	{		
		$cond = 'id=' . str_replace( ',', ' OR id=', $ids );
		$values = array( 'published' => '1' );
		$this->db->Update( $this->table, $cond, $values );
	}
	
	public function Reject( $ids ) 
	{
		$cond = 'id=' . str_replace( ',', ' OR id=', $ids );
		$values = array( 'published' => '0' );
		$this->db->Update( $this->table, $cond, $values );
	}
	
	public function Remove( $ids )
	{	
		$cond = 'id=' . str_replace( ',', ' OR id=', $ids );
		$this->db->Delete( $this->table, $cond );
	}
}
