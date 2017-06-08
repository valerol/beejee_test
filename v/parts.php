<?php
DEFINE( 'TPL_POSTS_VIEW', '
<div class="tools-top">
    <b>Сортировать по:</b>
    <a class="sort-by" id="sort-by-name">Имени<span class="glyphicon glyphicon-chevron-up"></span></a>
    <a class="sort-by" id="sort-by-email">Адресу<span class="glyphicon glyphicon-chevron-up"></span></a>
    <a class="sort-by" id="sort-by-date">Дате<span class="glyphicon glyphicon-chevron-up"></span></a>
</div>
<section id="posts">    
    %POSTS%
</section>
',
false );

DEFINE( 'TPL_POSTS_MODERATE', '
<div class="row tools-top">
    <div class="col-md-2">
        <input type="checkbox" id="check-all"><label class="check-all" for="check-all">Выделить всё</label>
    </div>
    <div class="col-md-9">
        <b>Сортировать по:</b>
        <a class="sort-by" id="sort-by-name">Имени<span class="glyphicon glyphicon-chevron-up"></span></a>
        <a class="sort-by" id="sort-by-email">Адресу<span class="glyphicon glyphicon-chevron-up"></span></a>
        <a class="sort-by" id="sort-by-date">Дате<span class="glyphicon glyphicon-chevron-up"></span></a>
    </div>
</div>
<section id="posts">
    %POSTS%
</section>
<form method="POST" class="tools-bottom">
    Отмеченные: 
    <input type="hidden" id="chosen-ids" name="chosen-ids" value="">
    <input type="submit" id="publish-selected" name="publish-selected" class="with-selected" value="Опубликовать">
    <input type="submit" id="reject-selected" name="reject-selected" class="with-selected" value="Отклонить">
    <input type="submit" id="remove-selected" name="remove-selected" class="with-selected" value="Удалить">
</form>
',
false );

DEFINE( 'TPL_POST_VIEW', '
<article id="%ID%" class="row post-row">
	<div class="col-md-3">
		<p class="name">%NAME%</p>
		<p class="email">%EMAIL%</p>
		<p class="date">%DATE%</p>
	</div>
	<div class="col-md-5 content">%CONTENT%</div>
	<div class="col-md-4"><img src="%IMG%" alt="%NAME%"></div>
</article>
',
false );

DEFINE( 'TPL_POST_MODERATE', '
<article id="%ID%" class="row post-row moderated_%MODERATED%">
	<div class="col-md-3">
		<div class="row">
			<div class="col-md-1">
				<input type="checkbox" class="cb">
			</div>
			<div class="col-md-10 info">
				<p class="glyphicon status published_%PUBLISHED% %ICON_CLASS%"></p>
				<p><a class="edit glyphicon glyphicon-edit" href="?action=edit&amp;id=%ID%">Редактировать</a></p>
				<p class="name">%NAME%</p>
				<p class="email">%EMAIL%</p>
				<p class="date">%DATE%</p>
			</div>
		</div>
	</div>
	<div class="col-md-5 content">%CONTENT%</div>
	<div class="col-md-4"><img src="%IMG%" alt="%NAME%"></div>
</article>
',
false );

DEFINE( 'TPL_AUTHORIZED', '
<p>Вы вошли как <b>%LOGIN%</b>. <a href="?logout=1">Выйти</a></p>
',
false );

DEFINE( 'TPL_LOGIN_FORM', '
<form method="POST">
	<p>
		<label for="login">Логин</label>
		<input name="login" type="text" />
	</p>
	<p>
		<label for="pass">Пароль</label>
		<input name="pass" type="text" />
	</p>
	<input value="Войти" type="submit" />
</form>
',
false );

DEFINE( 'TPL_SCRIPT', '
<script src="/js/%SCRIPT%.js"></script>
',
false );
