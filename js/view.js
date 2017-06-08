feedback = {};

window.onload = function() {
    // Инициализация функции сортировки
    for ( i = 0; i < sort_keys.length; i++ ) {
        sortBy( sort_keys[ i ] );        
    }
    // Инициализация кнопки предпросмотра
	document.getElementById( 'feedback-preview' ).onclick = getPreview;
	document.getElementById( 'feedback' ).onsubmit = function() { // Инициализация функции проверки формы
		checkFeedback( 'send' );
		return false;
	};
}

// Установка значений полей формы отправки отзыва
function setFeedback() {
	feedback.name = document.getElementById( 'feedback-name' ).value;
	feedback.email = document.getElementById( 'feedback-email' ).value;
	feedback.content = document.getElementById( 'feedback-content' ).value;
}
// Проверка поля формы отправки отзыва
function checkFeedbackProperty( property_name ) {
	result_p = document.getElementById( 'result' );
	result_p.innerHTML = '';
	result_p.className = '';
	
	if ( feedback[property_name] === '' ) {
		result_p.innerHTML = 'Необходимо заполнить: ' + document.getElementById( 'feedback-' + property_name + '-label' ).innerHTML;
		result_p.className = 'error';
        result_p.style.display = 'block';
		return false;
	} else {
		return true;
	}
}
// Проверка полей формы и отправка/предпросмотр отзыва
function checkFeedback( action ) {
	setFeedback();

	if ( ! checkFeedbackProperty( 'name' ) || ! checkFeedbackProperty( 'email' ) || ! checkFeedbackProperty( 'content' ) ) {
		return false;
	} else {
		
		if ( action == 'send' ) {			
			document.getElementById( 'feedback' ).submit();
		}
		
		return true;
	}
}
// Заполнение полей формы предпросмотра
function setPreview() {
	document.getElementById( 'prev-name' ).innerHTML = feedback.name;
	document.getElementById( 'prev-email' ).innerHTML = feedback.email;
	document.getElementById( 'prev-content' ).innerHTML = feedback.content;
}
// Показ формы предпросмотра
function showPreview() {
	document.getElementById( 'prev' ).style.display = 'block';
	document.getElementById( 'feedbacks' ).style.display = 'none';
	document.getElementById( 'feedback-back' ).style.display = 'inline';
}
// Показ списка отзывов при нажатии кнопки "Назад"
function showList() {
	document.getElementById( 'prev' ).style.display = 'none';
	document.getElementById( 'feedbacks' ).style.display = 'block';
	document.getElementById( 'feedback-back' ).style.display = 'none';
}
// Инициализация формы предпросмотра
function getPreview() {

	if ( checkFeedback( 'preview' ) ) {
		setPreview();		
		showPreview();
		document.getElementById( 'feedback-back' ).onclick = showList;
	} else {
		return false;
	}
}
