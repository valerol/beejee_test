selected_ids = document.getElementsByClassName( 'with-selected' );

window.onload = function() {
    // Инициализация сортировки по столбцам
    for ( i = 0; i < sort_keys.length; i++ ) {
        sortBy( sort_keys[ i ] );        
    }
    // Инициализация занесения ID отмеченных записей в скрытое поле
    if ( selected_ids ) {
        
        for ( i = 0; i < selected_ids.length; i++ ) {
            selected_ids[ i ].onclick = postIds;     
        }
    }
    // Инициализация выделения всех записей
	document.getElementById( 'check-all' ).onclick = toggleCheckboxes;
}
// Выделение всех записей
function toggleCheckboxes() {
	checkboxes = document.getElementsByClassName( 'cb' );	
	
	for ( i = 0; i < checkboxes.length; i++ ) {
	
		if ( document.getElementById( 'check-all' ).checked ) {
			checkboxes[ i ].checked = true;
		} else {
			checkboxes[ i ].checked = false;
		}
	}
}
// Занесение ID отмеченных записей в скрытое поле
function postIds() {
	rows = document.getElementsByClassName( 'post-row' );
	ids = [];
	
	for ( i = 0; i < rows.length; i++ ) {	
		row = rows[ i ];
		checkbox = row.getElementsByClassName( 'cb' )[ 0 ];
		
		if ( checkbox.checked ) {
            ids.push( row.id );
		}
		ids.join;
	}
	
	if ( ids ) {
		document.getElementById( 'chosen-ids' ).value = ids;
	}
}
