<?php


// $city = (isset($_POST['city'])) ? trim($_POST['city']) : null;
// $num = (isset($_POST['num'])) ? trim($_POST['num']) : null;
// $fum = (isset($_POST['fum'])) ? trim($_POST['fum']) : null;
$c_name = (isset($_POST['name'])) ? trim($_POST['name']) : null;
$tel = (isset($_POST['tel'])) ? trim($_POST['tel']) : null;

// $db_host = 'localhost'; // адрес сервера 
// $db_base = 'u128175679_lili'; // имя базы данных
// $db_user = 'u128175679_lili'; // имя пользователя
// $db_password = '1092vfbh'; // пароль
// $db_table = "myorder"; // Имя Таблицы БД

// // подключаемся к серверу
// $mysqli = new mysqli($db_host,$db_user,$db_password,$db_base);

// // Если есть ошибка соединения, выводим её и убиваем подключение
// if ($mysqli->connect_error) {
// 	die('Ошибка : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
// }

// $date = date("Y-m-d H:i:s");

// $result_query = $mysqli->query("INSERT INTO ".$db_table." (city, num, fum, c_name,tel,dt) VALUES ('$city','$num','$fum', '$c_name','$tel', '$date')");

// if ($result_query == true){
// 	$result = "Заказ принят!";
// }
// else{
// 	$result = "Ошибка!";
// }

$to = "olhaklymas@gmail.com";
$subject = "ЗАЯВКА arkodan.ua";
$message = "ЗАЯВКА arkodan.ua\nИмя: $c_name\nТелефон: $tel";
$mailResult = mail($to, $subject, $message);

if ($mailResult == true){
	$result = "Заказ принят!";
}
else{
	$result = "Ошибка!";
}

// echo $result;
//закрываем подключение
mysqli_close($mysqli);
exit();

