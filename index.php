<?php
require( $_SERVER[ 'DOCUMENT_ROOT' ] . '/functions.php' );
require( $_SERVER[ 'DOCUMENT_ROOT' ] . '/m/ClassConfig.php' );
require( $_SERVER[ 'DOCUMENT_ROOT' ] . '/m/ClassDB.php' );
require( $_SERVER[ 'DOCUMENT_ROOT' ] . '/m/ClassAuth.php' );
require( $_SERVER[ 'DOCUMENT_ROOT' ] . '/m/ClassContent.php' );
require( $_SERVER[ 'DOCUMENT_ROOT' ] . '/m/ClassPost.php' );
require( $_SERVER[ 'DOCUMENT_ROOT' ] . '/m/ClassPosts.php' );
require( $_SERVER[ 'DOCUMENT_ROOT' ] . '/c/ClassC.php' );
require( $_SERVER[ 'DOCUMENT_ROOT' ] . '/c/ClassCMain.php' );
  
$main = new CMain();
$main->In();
$main->Out();
print $main->content;
?>
