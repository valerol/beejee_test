<?php
class Post
{	
	private $db;
	public $name;
	public $email;
	public $date;
	public $content;
	public $published;
	public $moderated;
	public $img;
	public $table = 'feedbacks';
	
	public function __construct() 
	{
		global $config;
		$settings = $config->GetSettings( array( 'host', 'user', 'db_pass', 'db', 'db_charset' ) );
		$this->db = new DB( 
			$settings[ 'host' ], 
			$settings[ 'user' ], 
			$settings[ 'db_pass' ], 
			$settings[ 'db' ],
			$settings[ 'db_charset' ] );
	}
	
	public function Add() 
	{
		if ( ! $this->db->TableCheck( $this->table ) ) {
		
			$cols = "`id` int(255) primary key AUTO_INCREMENT,
				`name` varchar(255) NOT NULL,
				`email` varchar(255) NOT NULL,
				`date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
				`published` tinyint(1) DEFAULT NULL,
				`moderated` tinyint(1) NOT NULL DEFAULT '0',
				`content` text NOT NULL,
				`img` varchar(255) DEFAULT NULL";
			
			try {
				$this->db->TableCreate( $this->table, $cols );
			} catch ( Exception $e ) {
				die( $e->getMessage() );
			}
		}
	
		$values = array( 'name' => $this->name, 'email' => $this->email, 'content' => $this->content );
		
		if ( ! empty( $_FILES[ 'image' ][ 'name' ] ) ) {
			$this->img = $_FILES[ 'image' ];
			
			try { 
				$values[ 'img' ] = image_upload( $this->img );
			} catch ( Exception $e ) {
				die( $e->getMessage() );
			}
		}
		
		$this->db->Insert( $this->table, $values );
	}
	
	public function Update( $id, $name, $email, $content ) {
		$cond = "id=$id";
		$values = array( 'name' => $name, 'email' => $email, 'content' => $content, 'moderated' => '1' );
		return $this->db->Update( $this->table, $cond, $values );
	}
	
	public function Retrieve( $id, $props ) 
	{
		$conditions = "id=$id";	
		$post = $this->db->GetElement( $this->table, $props, $conditions );
		
		foreach ( $post as $key => $val ) {
			$this->$key = $val;
		}
	}
}
