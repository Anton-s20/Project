<?php

 try{
    $pdo = new PDO("mysql:dbname=new_project;host=localhost","root","");
  }catch(PDOException $e) {
    echo "Возникла ошибка соединения: ".$e->getMessage();
    exit;
  }

$area = $_POST["area"];

$query = "SELECT * FROM vg_citys WHERE area = $area";
$result = $pdo->query($query);
$result->execute();
$qwe = $result->fetch(PDO::FETCH_ASSOC);
	echo "<option value=\"\">Выберите ваш город</option>";
while ( $result = $pdo->query($query)){
	echo "<option value=\"".$result["city_id"]."\">".$result["city"]."</option>";
}