<?php
class CMain extends C
{
	private $auth;
	private $login;
	private $action;
	private $template_name;
	public $title;
	public $content;
    
    function __construct() 
	{
		global $config;
		$config = new Config( 'config.ini' ); // Сохраняем настройки в глобальную переменную
		$settings = $config->GetSettings( array( 'login', 'admin_pass' ) );
		$this->login = $settings[ 'login' ];
		$this->pass = $settings[ 'admin_pass' ];
		$this->auth = new Auth( $this->login, $this->pass );
    }
	
	function In() 
	{
		session_start();
		// Если введенные данные авторизации верны
		if ( is_post_value( 'login', $this->login ) && is_post_value( 'pass', $this->pass ) ) {
			$this->auth->Login();
		}
		// Если пользователь разлогинился
		if ( is_get( 'logout' ) ) {
			$this->auth->Logout();
		}
        // Установка текущей страницы 
		$this->template_name = get_value( 'action' );
		
		if ( ! $this->auth->Check( $this->login ) ) {
			$this->template_name = 'view';
		} elseif ( ! $this->template_name ) {
			$this->template_name = 'moderate';
		}
		// Подключение и выполнение контроллера страницы
		$this->action = set_controller( $this->template_name );
		$this->action->In();
    }
    
    function Out() 
	{	
		$content = new Content();
		$this->action->Out();
		$this->title = $this->action->title;
		// Установка шаблона формы авторизации
		if ( $this->auth->status == true ) {
			$login = $content->SetContentPart( 'authorized', array( 'login' => $this->login ) );
		} else {
			$login = $content->SetContentPart( 'login_form' );
		}
		
		$header = $content->SetContent( 'header', array( 'title' => $this->title, 'login' => $login ) );
		$this->content = $this->action->content;
		
		if ( $this->template_name != 'edit' ) {
			$script = $content->SetContentPart( 'script', array( 'script' => $this->template_name ) );
		} else {		
			$script = '';
		}
		
		$footer = $content->SetContent( 'footer', array( 'script' => $script ) );		
		$this->content = $header . $this->content . $footer;
    }   
}
