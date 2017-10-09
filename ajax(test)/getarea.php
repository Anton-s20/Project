<?php

 try{
    $pdo = new PDO("mysql:dbname=new_project;host=localhost","root","");
  }catch(PDOException $e) {
    echo "Возникла ошибка соединения: ".$e->getMessage();
    exit;
  }

$country = $_POST["country"];

$query = "SELECT * FROM vg_areas WHERE country = $country limit 5";
$result = $pdo->query($query);
$result->execute();
$qwe = $result->fetch(PDO::FETCH_ASSOC);
	echo "<option value=\"\">Выберите вашу область</option>";
while ( $result = $pdo->query($query))  {
	echo "<option value=\"".$qwe["area_id"]."\">".$qwe["area"]."</option>";
}
     