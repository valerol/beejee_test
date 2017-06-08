<?php
class CModerate extends C
{
	public $title;
	public $content;
	public $posts;
    
    function __construct() 
	{
		$this->posts = new Posts();
    }
     
    function In() 
	{		
		if ( is_get( 'back' ) ) { // Если нажата кнопка назад на странице редактирования
			header( 'Location: ' . $_SERVER[ 'PHP_SELF' ] );
		}
		
		if ( $ids = post_value( 'chosen-ids' ) ) { // Манипуляции с отмеченными отзывами
			
			if ( is_post( 'publish-selected' ) ) {
				$this->posts->Publish( $ids );
			} elseif ( is_post( 'reject-selected' ) ) {
				$this->posts->Reject( $ids );
			} elseif ( is_post( 'remove-selected' ) ) {
				$this->posts->Remove( $ids );
			}
			
			header( 'Location: ' . $_SERVER[ 'PHP_SELF' ] );
		}
    }
    
    function Out() 
	{		
		$content = new Content();
		$posts = $this->posts->Retrieve( 'id, name, email, date, content, published, moderated, img' ); // Запрос отзывов
		$rows = array();

		if ( $posts ) {
			
			foreach ( $posts as $post ) {
                // Установка изображения
				if ( $post[ 'img' ] != '' ) {
					$post[ 'img' ] = '/uploads/' . $post[ 'img' ];
				} else {
					$post[ 'img' ] = '/i/noimage.jpg';
				}
				// Установка иконки статуса
				if ( $post[ 'published' ] === '0' ) {
                    $post[ 'icon_class' ] = ' glyphicon-thumbs-down';
                } elseif ( $post[ 'published' ] === '1' ) {
                    $post[ 'icon_class' ] = ' glyphicon-thumbs-up';
                } else {
                    $post[ 'icon_class' ] = ' glyphicon-fire';
                }
								
				$rows[ $post[ 'date' ] ] = $content->SetContentPart( 'post_moderate', $post ); // Ключ - дата
			}
		}
			
		if ( $rows ) {
			krsort( $rows ); // Сортировка по дате
			$rows = implode( '', $rows );
			$table = $content->SetContentPart( 'posts_moderate', array( 'posts' => $rows ) );
		} else $table = 'Пока отзывов нет.';

		$this->title = 'Модерирование отзывов';
		$this->content = $content->SetContent( 'moderate', array ( 'title' => $this->title, 'posts_list' => $table ) );
    }    
}
