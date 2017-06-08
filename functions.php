<?php
function is_get( $param ) {
	
	if ( isset( $_GET[ $param ] ) ) {
		return true;
	}
}

function is_post( $param ) {
	
	if ( isset( $_POST[ $param ] ) ) {
		return true;
	}
}

function is_session( $param ) {
	
	if ( isset( $_SESSION[ $param ] ) ) {
		return true;
	}
}

function is_get_value( $param, $value = '' ) {
	
	if ( isset( $_GET[ $param ] ) && $_GET[ $param ] === $value ) {
		return true;
	}
}

function is_post_value( $param, $value = '' ) {
	
	if ( isset( $_POST[ $param ] ) && $_POST[ $param ] === $value ) {
		return true;
	}
}

function is_session_value( $param, $value = '' ) {
	
	if ( isset( $_SESSION[ $param ] ) && $_SESSION[ $param ] === $value ) {
		return $value;
	}
}

function get_value( $param ) {
	
	if ( isset( $_GET[ $param ] ) ) {
		return $_GET[ $param ];
	}
}

function post_value( $param ) {
	
	if ( isset( $_POST[ $param ] ) ) {
		return $_POST[ $param ];
	}
}

function session_value( $param ) {
	
	if ( isset( $_SESSION[ $param ] ) ) {
		return $_SESSION[ $param ];
	}
}

function set_controller( $template ) {	
	$controller = 'C' . mb_convert_case( $template, MB_CASE_TITLE );
	require( $_SERVER[ 'DOCUMENT_ROOT' ] . '/c/Class' . $controller . '.php' );
	return new $controller();
}

function image_upload( $img ) {
	$sizes = getimagesize( $img[ 'tmp_name' ] );
	$orig_w = $sizes[ 0 ];
	$orig_h = $sizes[ 1 ];
	$img_name_explode = explode( '.', $img[ 'name' ] );
	$ext = strtolower( end( $img_name_explode ) );
	
	if ( $ext == 'jpg' ) {
		$ext = 'jpeg';
	}
	
	$date = date_create();
	$new_name = date_timestamp_get( $date );
	$tar_src = $_SERVER[ 'DOCUMENT_ROOT' ] . '/uploads/' . $new_name . '.' . $ext;	
	$imagecreatefromext = 'imagecreatefrom' . $ext;
	$imageext = 'image' . $ext;	

	if ( $orig_w > 320 || $orig_h > 240 ) {		
		$ratio = $orig_w / $orig_h;
		
		if ( $ratio > 320 / 240 ) {
			$tar_w = 320;
			$tar_h = 320 / $ratio;
		} else {
			$tar_w = 240 * $ratio;
			$tar_h = 240;
		}
	} else {
		$tar_w = $orig_w;
		$tar_h = $orig_h;
	}
	
	if ( ! $tar = imagecreatetruecolor( $tar_w, $tar_h ) ) {
		throw new Exception( "Can't create image" );
	};
	
	if ( ! $src = $imagecreatefromext( $img[ 'tmp_name' ] ) ) {
		throw new Exception( "Can't create image from " . $ext );
	};

	if ( ! imagecopyresized( $tar, $src, 0, 0, 0, 0, $tar_w, $tar_h, $orig_w, $orig_h) ) {
		throw new Exception( "Can't resize image" );
	};
	
	if ( ! $imageext( $tar, $tar_src ) ) {
		throw new Exception( "Can't upload image" );
	};
	
	return $new_name . '.' . $ext;
}