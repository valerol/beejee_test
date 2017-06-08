<section class="feedbacks">
    %POSTS_LIST%
</section>
<section class="row feedback">
	<section class="col-md-5 form">
		<h2>Оставить отзыв</h2>
		<form name="feedback" id="feedback" method="POST" enctype="multipart/form-data">
			<label id="feedback-name-label">Ваше имя</label> *:<br />
			<input name="name" id="feedback-name" type="text" /><br />
			<label id="feedback-email-label">Электронная почта</label> *:<br />
			<input name="email" id="feedback-email" type="email" /><br />
			<label id="feedback-content-label">Текст сообщения</label> *:<br />
			<textarea name="content" id="feedback-content" rows="10"></textarea><br />
			<label>Прикрепить изображение:</label><br />
			<input type="file" name="image" accept="image/jpeg,image/png,image/gif">
			<input id="submit" value="Отправить" type="submit" />
			<input id="feedback-preview" value="Предварительный просмотр" type="button"/>
			<input id="feedback-back" class="feedback-back" value="Назад к списку" type="button"/>
			<p id="result"></p>
		</form>
	</section>
    <section id="prev" class="col-md-7 prev">
        <h2>Имя</h2>
        <p id="prev-name"></p>
        <h2>Эл. адрес</h2>
        <p id="prev-email"></p>
        <h2>Отзыв</h2>
        <p id="prev-content"></p>
    </section>
</section>
