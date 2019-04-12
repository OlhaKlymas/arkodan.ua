<?php

$c_name = (isset($_POST['name'])) ? trim($_POST['name']) : null;
$tel = (isset($_POST['tel'])) ? trim($_POST['tel']) : null;

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

mysqli_close($mysqli);
exit();

