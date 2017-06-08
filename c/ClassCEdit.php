<?php

class CEdit extends C
{
	private $post;
	public $title;
	public $content;
    
    function __construct() 
	{
        $this->post = new Post();
    }
     
    function In() 
	{		
		if ( is_get( 'back' ) ) {
			header( 'Location: ' . $_SERVER[ 'PHP_SELF' ] );
		}
		// Если передан ID, загружаем отзыв
		if ( $id = get_value( 'id' ) ) {

			$post_name = post_value( 'name' );
			$post_email = post_value( 'email' );
			$post_content = post_value( 'content' );
            // Если отправлена форма - сохраняем
			if ( $post_name && $post_email && $post_content ) {
				header( 'Location:' . $_SERVER[ 'PHP_SELF' ] );
				$this->post->Update( $id, $post_name, $post_email, $post_content );
			}		
			// Загружаем обновленные данные
			$this->post->Retrieve( $id, 'id, name, email, content' );
		}
    }
    
    function Out() 
	{   // Загружаем отзыв в форму
	
        if ( isset( $this->post->id ) ) {
            $values = array (
                'id' => $this->post->id, 
                'name' => $this->post->name, 
                'email' => $this->post->email, 
                'content' => $this->post->content        
            );
        } else $values = array();
	
		$content = new Content();
		$this->title = 'Редактирование отзыва';
		$this->content = $content->SetContent( 'edit', $values );
    }    
}
