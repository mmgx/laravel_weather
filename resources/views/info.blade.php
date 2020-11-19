<b>Стандартные логины и пароли:</b><br>
<b>admin@site.com:password</b> - имеются права на просмотр информации о пользователях, удаление пользователей
(кроме самого себя), редактирование, восстановление и конечное уничтожение<br>
<b>user1@site.com:password</b> (и все другие созданные пользователи) - могут просматривать информацию о
пользователях, редактировать информацию о себе <br>
<br>
<b>Команда на получение информации о погоде:</b>
<pre>php artisan weather:all</pre>
<br>
<b>Тестовые маршруты получения текущей погоды (без проверки существования токена):</b><br>
<a href="/test/weather/city/Саранск/current">Текущая погода в городе Саранск</a><br>
<a href="/test/weather/city/Саранск/all">История изменения погоды в городе Саранск</a>
<br><br>
<b>Получение временного токена:</b><br>
<b>Postman:</b>
<pre>url: /api/auth</pre>

Headers:<br>
Content-Type : application/x-www-form-urlencoded<br>
Accept : application/json<br>
<br>
Params:<br>
email : user1@site.com<br>
password : password<br>
<br>
<br>
<b>Адрес запроса текущей температуры (с токеном)</b><br>
<pre>/api/weather/city/{city}/current</pre><br>
<b>Адрес запроса истории изменения температур указанного города (с токеном)</b><br>
<pre>/api/weather/city/{city}/all</pre>
