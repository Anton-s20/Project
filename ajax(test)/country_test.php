<?php

 try{
    $pdo = new PDO("mysql:dbname=new_project;host=localhost","root","");
  }catch(PDOException $e) {
    echo "Возникла ошибка соединения: ".$e->getMessage();
    exit;
  }

	$country = $_POST["country"];
	// var_dump($country );
	// die(123);

	$query = "SELECT * FROM vg_areas WHERE country = '$country'";
	$result = $pdo->query($query);
	$result->execute();
	$array = array();
	while ($zap = ($result->fetch(PDO::FETCH_ASSOC))){
		array_push($array,$zap);
    }
	echo json_encode(
		array($array)
	);
?>