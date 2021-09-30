<?php
//Стартуем сессию
session_start();

//Данные для БД
$localhost = '127.0.0.1:3305';
$my_user = 'root';
$my_password = 'root';
$my_db = 'security';

//Записываем в переменные данные от нажатой кнопки
$log = $_POST["login"];
$pas = $_POST["pass"];

//Ищем в БД совпадения с введённым логином
$db = new PDO("mysql:host=$localhost;dbname=$my_db",$my_user,$my_password);
$stmt = $db->query("SELECT * FROM users WHERE LOGIN = '$log'");
$result = $stmt->FETCH(PDO::FETCH_LAZY);

include 'logger.php';
if($result[0] == 0 || $result[0] == ""){
	$token = hash('gost-crypto', random_int(0,999999));

	if (!empty($log) & !empty($pas)){
		$stmt = $db->prepare("INSERT INTO users (LOGIN, PASSWORD) VALUES (:name, :pass)");
		$stmt->bindParam(':name', $log);
		$stmt->bindParam(':pass', $pas);
		$stmt->execute();

		if ($stmt) {
			echo 'Данные успешно добавлены в таблицу';
			$_SESSION['user'] = 1;
		} 
		else {
			echo 'Произошла ошибка:';
			$log->error('Ошибка данные в БД не добавлены!');
		}
	}
	else {
		echo "Вы не ввели логин или пароль!";
		$log->warning('Предупреждение! Вы не ввели логин или пароль!');
	}
}
else{
	echo "<h3>Такой пользователь уже зарегистрирован, пройдите Авторизацию!</h3>";
	$log->warning('Предупреждение! Такой пользователь уже зарегистрирован, пройдите Авторизацию!');
}
?>