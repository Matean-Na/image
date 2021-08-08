
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Сжатие изображения</title>
</head>
<body>
	<p>Форма для отправки на сервер</p>
	 <p>Максимальная ширина: 1200</p>
	 <p>Максимальная высота: 800</p>
	<form action="form.php" method="post" enctype="multipart/form-data">
		<!-- Загрузка файла на сервер -->
		<input type="file" name="filename"><br>
		<input type="submit"  value="Отправить">
	</form>
</body>
</html>