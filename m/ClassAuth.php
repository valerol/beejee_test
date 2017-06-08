<?php
class Auth 
{
	private $login;
	private $pass;
	public $status;
	
	function __construct( $login, $pass ) 
	{
		$this->login = $login;
		$this->pass = $pass;
	}

	function Login() 
	{	
		$_SESSION[ 'login' ] = $this->login;
		$this->status = true;
		header( 'Location: ' . $_SERVER[ 'PHP_SELF' ] );
	}

	function Logout() 
	{
		unset( $_SESSION[ 'login' ] );
		$this->status = false;
		header( 'Location: ' . $_SERVER[ 'PHP_SELF' ] );
	}

	function Check( $login = '' ) 
	{		
		if ( is_session( 'login' ) && ( $login === '' || $login == $this->login ) ) {
			$this->status = true;
			return true;
		} else {
			$this->status = false;
			return false;
		}
	}
}