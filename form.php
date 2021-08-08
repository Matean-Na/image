<?php 
//чтобы файл не перезаписывался меняем ему имя
$loaded = 'loaded/';
$name = md5(rand(10,99));
$type = explode("/", $_FILES['filename']['type']);
$loadedfile = $loaded . $name . '.' . $type[1];

// загрузка файла на сервер, папка loaded
if (move_uploaded_file($_FILES['filename']['tmp_name'], $loadedfile)) {
$size = getimagesize($loadedfile);
 
 

 // Лимит на размер изображения
 if ($size[0] > 800 || $size[1] > 1200){
 	echo 'Превышен Размер';
 	unlink($loadedfile);
 	exit();
 }
	//условия для работы с различными расширениями
if ($type[1] == 'jpeg'){
   //коэфициент сжатия 
   $new_width = $size[0] * 0.5;
   $new_height = $size[1] * 0.5;
   // ресэмплирование
   $image_p = imagecreatetruecolor($new_width, $new_height);
   $src = imagecreatefromjpeg($loadedfile);
   imagecopyresampled($image_p, $src, 0, 0, 0, 0, $new_width, $new_height, $size[0], $size[1]);
   $im = imagejpeg($image_p, $loadedfile, 100);
   // Изображение уменьшено и загруженно в папку loaded

} else if ($type[1] == 'png'){
   //коэфициент сжатия 
   $new_width = $size[0] * 0.5;
   $new_height = $size[1] * 0.5;
     // ресэмплирование
   $image_p = imagecreatetruecolor($new_width, $new_height);
   $src = imagecreatefrompng($loadedfile);
   imagecopyresampled($image_p, $src, 0, 0, 0, 0, $new_width, $new_height, $size[0], $size[1]);
   imagejpeg($image_p, $loadedfile, 100);
   // Изображение уменьшено и загруженно в папку loaded
}

	echo 'Файл скопирован на сервер <br><br>';
	echo 'Характеристики файла <br>';
	echo 'Имя файла: ' . $_FILES['filename']['name'] . '<br>';
	echo 'Размер файла: ' . $_FILES['filename']['size'] . '<br>';
	echo 'Тип файла: ' . $_FILES['filename']['type'] . '<br><br>
	Изначальный размер: <br> Ширина: '.$size[0].'<br> Высота: '.$size[1].'<br><br>';
	echo "Оптимизированый: <br> Ширина: $new_width <br> Высота: $new_height";

} else {
	echo 'Файл не загружен на сервер так как не является изображением';
} 

?>