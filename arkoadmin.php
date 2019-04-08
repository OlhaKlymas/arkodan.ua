<?php
session_start();
$login='arkouser';
$pass='123passarko'; // Пароль для входа в CMS
$adm=0; // Если в переменной $adm==1 то мы успешно авторизованы
$badAuth = "";
function showLoginPage($result){//Показать страницу входа передай в нее надпись для пользователья
	echo '
			<!DOCTYPE html>
			<html lang="ru">
			<head>
			<meta charset="UTF-8">
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="icon" href="img/logo-icon.png">
			</head>
			<body>
			<center>
			<img src="img/logo.png" width="150px" center>
			<form method="POST" action="arkoadmin.php" style="box-shadow: 0 0 10px rgba(0,0,0,0.5);margin-top: 30px;padding: 10px;width: 350px;background: #3ce961;border-radius: 5px">
			<p style="color: #04182f;font-size: 24px;font-family:sans-serif; font-weight: 600">Авторизация</p>
			'.$result.'
			<div style="width: 100%;height: 100%;;padding: 20px 0px;">
			<p style="margin: 0px;font-size: 20px; color: #04182f;font-family:sans-serif;text-align: left;width: 90%;font-weight: 400">Пользователь</p>
			<input type="text" placeholder="Имя пользователя" name="imia" size="100" style="margin-top: 10px;background: #eee;color: #04182f;font-size: 18px;width: 90%;height: 20px;line-height: 1.5">
			<p style="margin: 0px;font-size: 20px; color: #04182f;font-family:sans-serif;text-align: left; width: 90%;    margin-top: 40px;font-weight: 400">Пароль</p>
			<input type="password" placeholder="Введите пароль" name="slovo" size="100" style="margin-top: 10px;background: #eee;color: #04182f;font-size: 18px;width: 90%;height: 20px;line-height: 1.5">
			</div>
			<input type=submit name="save" value="Войти в систему" style="width: 70%; background: #04182f; font-size: 16px; display: block; height: 37px; color: #fff; text-decoration: none; cursor: pointer; vertical-align: middle; text-align: center; border-radius: 5px;border: none; margin: 10px 0px">
			</form></center></body></html>';
}


if((isset($_POST['slovo'])||isset($_POST['sekret']))||($_SESSION['sekret']==md5($pass))){
	if ((($_POST['slovo']==$pass)&&($_POST['imia']==$login))||(($_SESSION['sekret']==md5($pass))&&($_SESSION['vhod']==md5($login)))){
		$_SESSION['sekret']=md5($pass); // Если пароль совпадает добавляем в сессию переменную secret с его md5 хэшем
		$_SESSION['vhod']=md5($login);
		$adm=1;
	}
	else{
		$badAuth = '<p style="margin: 0px;font-size: 14px; color: red;font-family:sans-serif;text-align: center;width: 90%;font-weight: 400">Неверное Имя пользователя или Пароль</p>'; //Сообщение пользователю
		// $badAuth = $_SESSION['vhod'];
		showLoginPage($badAuth);//Показать форму входа с сообщением
	}
}else {
			// Если пароля нет показываем форму входа без сообщения
	showLoginPage("");
};

if($adm==1){
	if(isset($_POST['pagename'])){
	$_SESSION['pagename']=$_POST['pagename']; // Получаем имя страницы для редактирования
};	
if(isset($_SESSION['pagename'])){	
	$pagename=$_SESSION['pagename'];
} else {
	$pagename='index.html';	// Если его нет в куках и нет в POST запросе то ставим его=index.html	
};

// В переменную $template поместим код редактируемой странички
$template=file_get_contents($pagename);

// Выводим шапку админки
echo('
	<html>
	<head>
	<link rel="icon" href="img/logo-icon.png">
	<style>
	body, html {
		padding: 0px; margin: 0px;
		background: #eee; 
		text-align: center;
		font-family: sans-serif;
	}
	textarea {
		padding: 10px; 
		width: 600px; height: 400px;
	}
	a {
		text-decoration: none;
	}
	.kartinka {
		display: inline-block; 
		text-decoration: none;
		padding: 20px; padding-bottom: 5px;
		text-align: center; 
		cursor: pointer;
	}
	.kartinka:hover {
		background: #fffff0; 
		border-radius: 5px;
	}
	.kartinka img {
		height: 100px; 
		margin-bottom: 10px;
	}
	.bigkartinka {
		height: 300px; 
		padding: 50px;
	}
#menu {
	display: flex;
	align-items: center;
	justify-content: center;
	background: #04182f;
	padding-top: 15px; padding-bottom: 10px; padding-left: 10px;
	margin-bottom: 30px;
	height: 50px;
	line-height: 50px;
	text-align: center;
	font-size: 20px;
	border-bottom: 1px solid silver;
}
#myform {
height: 40px; line-height: 40px;
display: inline-block;
vertical-align: top;
padding-left: 20px; padding-right: 20px;
margin-right: 3px;
text-align: center;
font-size: 90%;
}
#menu img {
width: 120px;
height: 60px;
position: absolute;
left: 50px;
}
#menu a {
height: 40px; line-height: 40px;
text-decoration: none;
display: inline-block;
vertical-align: top;
background: #3ce961;
padding-left: 20px; padding-right: 20px;
color: #04182f;
margin-right: 3px;
text-align: center;
width: 80px;
font-size: 90%;
}
.mytext, .cssjs {
	display: block;
	border-radius: 5px;
	padding: 10px; padding-left: 20px; padding-right: 20px;
	margin: 20px;
	background: #fffff9;
	color: black;
}
.mytext:hover, .cssjs:hover {
	background: #fffff0;
	cursor: pointer;
}
#help {
max-width: 700px; margin: 0 auto; text-align: center; font-size: 120%;
}
#help p {
	margin-bottom: 20px;
}
</style>
</head>
<body>
<div id="menu">
<img src="img/logo.png" width="120px" height="60px" position="absolute" left="50px">
<div>
<a href="arkoadmin.php?mode=0">Тексты</a>
<a href="arkoadmin.php?mode=7">Картинки</a>
<a href="arkoadmin.php?mode=5">HTML</a>
<a href="arkoadmin.php?mode=8">CSS и JS</a>
<a href="index.html" target="_blank">На сайт</a>
</div>
</div>
');

//******************************************************************************************
// Список картинок
if($_GET['mode']=='7'){
	// Вытаскиваем список картинок из HTML кода
	$imgreg = "/[\"|\(']((.*\\/\\/|)([\\/a-z0-9_%]+\\.(jpg|png|gif)))[\"|\)']/"; 
	preg_match_all($imgreg, $template, $imgmas);
	for ($j=0; $j< count($imgmas[1]); $j++) {
		$imgname=trim($imgmas[1][$j]);
		echo('<div class="kartinka"><a href="arkoadmin.php?mode=1&img='.$imgname.'"><img src="'.$imgname.'?'.rand(1, 32000).'"></a><br>'.$imgname.'<br>');
		if(file_exists($imgname)){
			$size = getimagesize ($imgname); echo "Размер картинки: $size[0] * $size[1]"."<p>";
		} else { echo("Картинка не загружена"); };
		echo("</div>");
	};
	// Получаем список CSS файлов в массив $mycss	
	$mycss = array();
	$cssreg = "/[\"']((.*\\/\\/|)([\\/a-z0-9_%]+\\.(css)))[\"']/"; 
	preg_match_all($cssreg, $template, $cssmas);
	for ($j=0; $j< count($cssmas[1]); $j++) {
		array_push($mycss, trim($cssmas[1][$j]));
	};
	echo('<hr>');
	// Вытаскиваем с каждого CSS файла адреса картинок
	for ($i=0; $i< count($mycss); $i++) {
		$template=file_get_contents($mycss[$i]);
		$imgreg = "/[.\(]((.*\\/\\/|)([\\/a-z0-9_%]+\\.(jpg|png|gif)))[\)]/"; 
		preg_match_all($imgreg, $template, $imgmas);
		for ($j=0; $j< count($imgmas[1]); $j++) {
			$imgname=trim($imgmas[1][$j]);
			echo('<div class="kartinka"><a href="arkoadmin.php?mode=1&img='.$imgname.'"><img src="'.$imgname.'?'.rand(1, 32000).'"></a><br>'.$imgname.'<br>');
			if(file_exists($imgname)){
				$size = getimagesize ($imgname); echo "Размер картинки: $size[0] * $size[1]"."<p>";
			} else { 
				if(file_exists(substr($imgname,1))){
					$size = getimagesize(substr($imgname,1)); echo "Размер картинки: $size[0] * $size[1]"."<p>";
				} else { 
					echo("Картинка не загружена"); 
				};		
			};
			echo("</div>");
		};
	};
};

//******************************************************************************************
// Одна картинка
if($_GET['mode']=='1'){
	$imgname=$_GET['img'];
	if($imgname[0]=='/'){
		$imgname=substr($imgname,1);
	};
	echo('<center><img src="'.$imgname.'" class="bigkartinka"><br>'.$imgname.'<p>');
	if(file_exists($imgname)){
		$size = getimagesize ($imgname); echo "Размер картинки: $size[0] * $size[1]"."<p>";
	} else { 
		if(file_exists(substr($imgname,1))){
			$size = getimagesize(substr($imgname,1)); echo "Размер картинки: $size[0] * $size[1]"."<p>";
		} else { 
			echo("Картинка не загружена"); 
		};		
	};
	echo('<form enctype="multipart/form-data" action="arkoadmin.php?mode=2&img='.$imgname.'" method="POST">Загрузить картинку с компьютера: <p><input name="userfile" type="file" required><p><input type="submit" style="width: 250px; height: 40px;" value="Начать загрузку" /></form>');	
};


//******************************************************************************************
// Замена картинки
if($_GET['mode']=='2'){
	$imgname=$_GET['img'];
	if (move_uploaded_file($_FILES['userfile']['tmp_name'], $imgname)) {
		echo "<br><br><center>Файл был успешно загружен.<p><a href='arkoadmin.php?mode=7'>Вернуться к списку картинок</a><p>ПРИ ПРОСМОТРЕ ИЗМЕНЕНИЙ НА САЙТЕ ИСПОЛЬЗУЙТЕ БРАУЗЕР В РЕЖИМЕ ИНКОГНИТО";
	};
};


//******************************************************************************************
// Список текстовых фрагментов
if($_GET['mode']=='0'){
	// Помещаем в массив $ff все тексты из HTML кода
	$ff=array(); $content=preg_replace('/<[^>]+>/', '^', $template); $teksta = explode('^', $content);
	for ($j=0; $j< count($teksta); $j++) { if(strlen(trim($teksta[$j]))>1) $ff[]=(trim($teksta[$j])); };
		for ($j=0; $j< count($ff); $j++) { 
			echo('<a href="arkoadmin.php?mode=3&j='.$j.'" class="mytext">'.$ff[$j].'</a>');
		};
	};


//******************************************************************************************
// Текстовый фрагмент
	if($_GET['mode']=='3'){
	// Помещаем в массив $ff все текстовые фрагменты из HTML кода
		$ff=array(); $content=preg_replace('/<[^>]+>/', '^', $template); $teksta = explode('^', $content);
		for ($j=0; $j< count($teksta); $j++) { if(strlen(trim($teksta[$j]))>1) $ff[]=(trim($teksta[$j])); };
			$jj=$_GET['j'];
		$tektekst=$ff[$jj];
		$kol=1;
		for ($j=0; $j<$jj; $j++) { 
			$kol=$kol + substr_count($ff[$j],$tektekst);
		};
		echo('<div style="margin: 0 auto; text-align: center;"><form method="POST" action="arkoadmin.php?mode=4&j='.$jj.'"><br><br><h2>Редактирование текстового фрагмента</h2><br><br><textarea name="mytext">'.$tektekst.'</textarea><br><input style="width: 600px; margin-top: 10px; height: 50px;" type="submit" value="Заменить текст" title="Заменить текст"></form></div>');
	};


//******************************************************************************************
// Редактирование текстового фрагмента
	if($_GET['mode']=='4'){
	// Помещаем в массив $ff все текста из HTML кода
		$ff=array(); $content=preg_replace('/<[^>]+>/', '^', $template); $teksta = explode('^', $content);
		for ($j=0; $j< count($teksta); $j++) { if(strlen(trim($teksta[$j]))>1) $ff[]=(trim($teksta[$j])); };
			$jj=$_GET['j'];
		$tektekst=$ff[$jj];
		$kol=1;
		for ($j=0; $j<$jj; $j++) { 
			$kol=$kol + substr_count($ff[$j],$tektekst);
		};
		$subject=file_get_contents($pagename);
		function str_replace_nth($search, $replace, $subject, $nth)
		{
			$found = preg_match_all('/'.preg_quote($search).'/', $subject, $matches, PREG_OFFSET_CAPTURE);
			if (false !== $found && $found > $nth) {
				return substr_replace($subject, $replace, $matches[0][$nth][1], strlen($search));
			}
			return $subject;
		};
		$rez=str_replace_nth($tektekst, $_POST['mytext'], $subject, $kol-1);
		file_put_contents($pagename, $rez);
		echo "<br><br><center>Текст был успешно изменен.<p><a href='arkoadmin.php?mode=0'>Вернуться к списку текстов</a><p>ПРИ ПРОСМОТРЕ ИЗМЕНЕНИЙ НА САЙТЕ НЕ ЗАБУДЬТЕ ОБНОВИТЬ ЕГО СТРАНИЦУ В БРАУЗЕРЕ";
	};


//******************************************************************************************
// Форма для HTML кода
	if($_GET['mode']=='5'){
		$template=htmlspecialchars(file_get_contents($pagename));
		echo('<div style="margin: 0 auto; text-align: center;"><form method="POST" action="arkoadmin.php?mode=6"><br><br><h2>Редактирование HTML кода</h2><br><br><textarea name="mytext" style="width: 90%; height: 500px;">'.$template.'</textarea><br><input style="width: 90%; margin-top: 10px; height: 50px;" type="submit" value="Заменить текст" title="Заменить текст"></form></div>');
	};


//******************************************************************************************
//Редактирование HTML кода
	if($_GET['mode']=='6'){

		// $fopen = fopen($pagename, "w");
		// $saveText = $_POST['mytext'];
		// $cont = fwrite($fopen, $saveText);
		// fclose($fopen);

		file_put_contents($pagename, $_POST['mytext'],LOCK_EX);
		// file_put_contents($pagename, $_POST['mytext'],FILE_APPEND | LOCK_EX);
		// echo $pagename."\n\n";
		// echo $_POST['mytext'];
	};

//******************************************************************************************
// Получаем список CSS и JS файлов
	if($_GET['mode']=='8'){
		echo('<br><h2>CSS и JS файлы относящиеся к '.$pagename.'</h2><p><br>');
		$cssreg = "/[\"']((.*\\/\\/|)([\\/a-z0-9_%]+\\.(css)))[\"']/"; 
		preg_match_all($cssreg, $template, $cssmas);
		for ($j=0; $j< count($cssmas[1]); $j++) {
			$rrr=trim($cssmas[1][$j]);
			if (!(strstr($rrr, "http"))) {
				echo('<a class="cssjs" href="arkoadmin.php?mode=9&fl='.$rrr.'">'.$rrr.'</a><p>');
			};
		};
		$cssreg = "/[\"']((.*\\/\\/|)([\\/a-z0-9_%]+\\.(js)))[\"']/"; 
		preg_match_all($cssreg, $template, $cssmas);
		for ($j=0; $j< count($cssmas[1]); $j++) {
			$rrr=trim($cssmas[1][$j]);
			if (!(strstr($rrr, "http"))) {
				echo('<a class="cssjs"  href="arkoadmin.php?mode=9&fl='.$rrr.'">'.$rrr.'</a><p>');
			};
		};
	};

//******************************************************************************************
// Форма для HTML кода
	if($_GET['mode']=='9'){
		$template=htmlspecialchars(file_get_contents($_GET['fl']));
		echo('<div style="margin: 0 auto; text-align: center;"><form method="POST" action="arkoadmin.php?mode=10&fl='.$_GET['fl'].'"><br><br><h2>Редактирование кода</h2><br><br><textarea name="mytext" style="width: 90%; height: 500px;">'.$template.'</textarea><br><input style="width: 90%; margin-top: 10px; height: 50px;" type="submit" value="Заменить текст" title="Заменить текст"></form></div>');
	};

//******************************************************************************************
//Редактирование всего HTML кода
	if($_GET['mode']=='10'){
		file_put_contents($_GET['fl'], $_POST['mytext'],LOCK_EX);
		// file_put_contents($_GET['fl'], $_POST['mytext'],FILE_APPEND | LOCK_EX);
	};

//******************************************************************************************
// Помощь
	if(!isset($_GET['mode'])){
		echo('<div id="help"><p><br><h2>Привет!</h2><p>Здесь ты сможешь отредактировать картинки и тексты на сайте.</p><p>Все просто и понятно.</p><p>Успехов!</p>');
	};

	echo('</body></html>');
};
?>
