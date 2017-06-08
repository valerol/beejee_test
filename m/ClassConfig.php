<?php
class Config
{
	private $settings;
	private $filename;
	
	function __construct( $filename ) {
		$this->filename = $_SERVER[ 'DOCUMENT_ROOT' ] . '/' . $filename;
	}
	
	function GetSettings( $args = array() ) {
		$this->settings = parse_ini_file( $this->filename );
		$settings = array();
		
		if ( $args ) {
			foreach ( $args as $arg ) {
				$settings[ $arg ] = $this->settings[ $arg ];
			}
		} else $settings = $this->settings;
		
		return $settings;
	}
}
