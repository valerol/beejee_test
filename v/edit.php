<section class="form-edit row">
    <form class="col-md-4" name="edit" action="" method="POST">
        <label>Имя:</label><br>
        <input name="name" value="%NAME%"><br>
        <label>Эл. адрес:</label><br>
        <input name="email" value="%EMAIL%"><br>
        <label>Текст сообщения:</label><br>
        <textarea name="content" rows="10">%CONTENT%</textarea><br>
        <input name="id" value="%ID%" type="hidden" /><br>
        <input value="Отправить" type="submit" />
        <p><a class="back glyphicon glyphicon-arrow-left" href="?back=1">Назад</a></p>
    </form>
</section>
