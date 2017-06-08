// Ключи сортировки столбцов
sort_keys = [ 'name', 'email', 'date' ];

function sortBy( key ) {
    link = document.getElementById( 'sort-by-' + key );
    
    if ( link ) {
        link.onclick = function() { 
            toggleSort( key );            
        }
    }  
}
// Переключение сортировки
function toggleSort( key ) {
	rows = document.getElementsByClassName( 'post-row' );
	sort_link = document.getElementById( 'sort-by-' + key );
	sort_links = document.getElementsByClassName( 'sort-by' );
	chevron = sort_link.getElementsByTagName( 'span' )[ 0 ];
	posts = [];
	new_posts = '';
	// Записи - в массив
	for ( i = 0; i < rows.length; i++ ) {
		post = {};
		post.val = rows[ i ].getElementsByClassName( key )[ 0 ].innerHTML;
		post.content = rows[ i ].outerHTML;
		posts.push( post );
	}
	// Переключение стрелок
	if ( sort_link.className.search( 'sorted-asc' ) < 0 ) {
		posts.sort( rowsASC );		
		chevron.className = chevron.className.replace( 'glyphicon-chevron-down', 'glyphicon-chevron-up' );		
		sort_link.className += ' sorted-asc';
	} else {
		posts.sort( rowsDESC );		
		chevron.className = chevron.className.replace( 'glyphicon-chevron-up', 'glyphicon-chevron-down' );
		
		for	( i = 0; i < sort_links.length; i++ ) {
			sort_links[ i ].className = sort_links[ i ].className.replace( ' sorted-asc', '' );
		}		
	}
	// Составление тела записей
	for ( i = 0; i < posts.length; i++ ) {
		new_posts += posts[ i ].content;
	}
	
	document.getElementById( 'posts' ).innerHTML = new_posts;
}
// Сортирока по возрастанию
function rowsASC( a, b ) {
	if ( a.val > b.val ) {
	return 1;
	} else if ( a.val < b.val ) {
	return -1;
	} else return 0;
}
// Сортирока по убыванию
function rowsDESC( a, b ) {
	if ( a.val > b.val ) {
	return -1;
	} else if ( a.val < b.val ) {
	return 1;
	} else return 0;
}
