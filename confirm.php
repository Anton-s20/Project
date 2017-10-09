<?php

$hash = $_GET['hash'];

try{
	$pdo = new PDO("mysql:dbname=new_project;host=localhost","root","");
}catch(PDOException $e) {
	echo "Возникла ошибка соединения: ".$e->getMessage();
	exit;
}


$activated =1;

$query ="UPDATE users SET activated=:activated WHERE hash=:hash ";

$result = $pdo->prepare($query);

$result->bindParam(':activated',$activated, PDO:: PARAM_STR);
$result->bindParam(':hash',$hash, PDO:: PARAM_STR);
$result->execute();

echo "Поздравляем, Вы успешно активировали свою регистрацию!";
echo "Перейти к авторзации по <a href='index.php'>этой ссылке!</a><br />";


?>