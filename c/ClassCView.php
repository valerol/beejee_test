<?php
class CView extends C
{
	public $title;
	public $content;
    
    function __construct() 
	{

    }
     
    function In() 
	{	// Если получены данные с формы, создаем отзыв
		$post_name = post_value( 'name' );
		$post_email = post_value( 'email' );
		$post_content = post_value( 'content' );

		if ( $post_name && $post_email && $post_content ) {
			$this->post = new Post();
			$this->post->name = filter_var( $post_name, FILTER_SANITIZE_STRING );
			$this->post->email = filter_var( $post_email, FILTER_SANITIZE_STRING );
			$this->post->content = filter_var( $post_content, FILTER_SANITIZE_STRING );
			$this->post->Add();
            header( 'Location: ' . $_SERVER[ 'PHP_SELF' ] );
		}
    }
    
    function Out() 
	{		
		$content = new Content();
		$posts = new Posts();
		$posts_arr = $posts->Retrieve( 'name, email, date, content, published, img' ); // Запрашиваем отзывы
		$rows = array();

		if ( $posts_arr ) {
			
			foreach ( $posts_arr as $post ) {
				if ( $post[ 'published' ] == 0 ) { // Если не опубликован - исключаем
					continue;
				}
                // Установка изображения
				if ( $post[ 'img' ] != '' ) {
					$post[ 'img' ] = '/uploads/' . $post[ 'img' ];
				} else {
					$post[ 'img' ] = '/i/noimage.jpg';
				}
						
				$rows[ $post[ 'date' ] ] = $content->SetContentPart( 'post_view', $post ); // Ключ массива - дата
			}
		}
			
		if ( $rows ) {
			krsort( $rows ); // Сортируем по дате
			$rows = implode( '', $rows );
			$table = $content->SetContentPart( 'posts_view', array( 'posts' => $rows ) );
		} else $table = 'Пока опубликованных отзывов нет.';
		
		$this->title = 'Отзывы';		
		$this->content = $content->SetContent( 'view', array ( 'title' => $this->title, 'posts_list' => $table ) );	
    }    
}
