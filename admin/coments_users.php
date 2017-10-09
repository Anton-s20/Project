<?php
session_start();

ob_start();

try{
	$pdo = new PDO("mysql:dbname=new_project;host=localhost","root","");
}catch(PDOException $e) {
	echo "Возникла ошибка соединения: ".$e->getMessage();
	exit;
}

$query_2 = "SELECT * FROM users_coments";
$result_2 = $pdo->prepare($query_2);
$result_2->execute();

$message="";

if (!empty($_GET) && isset($_GET['action']) && isset($_GET['id'])) {
	if ($_GET['action'] == 'delete') {
		$id = $_GET['id'];
		$query_3 = "DELETE FROM users_coments WHERE id =:id";
		$result_3 = $pdo->prepare($query_3);
		$result_3->bindParam(':id',$id, PDO:: PARAM_STR);
		$result_3->execute();
		$message = "Коментарий № $id удален!";
	}

	if ($_GET['action'] == 'approve') {
		$activated ='1';
		$id = $_GET['id'];
	 	$query = "UPDATE users_coments SET activated=:activated WHERE id=:id";
	 	$result_3 = $pdo->prepare($query);
	 	$result_3->bindParam(':activated',$activated, PDO:: PARAM_STR);
	 	$result_3->bindParam(':id',$id, PDO:: PARAM_STR);
	 	$result_3->execute();
	 	$message = "Коментарий № $id добавлен!";
	}
}

?>

<!DOCTYPE html>
<html>
  <html lang="ru">
<head>  
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- jQuery -->
  <script src="../vendors/jquery/jquery.js"></script>
    <!-- Bootstrap -->
  <link href="../vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <script src="../vendors/bootstrap/js/bootstrap.min.js"></script>
  <!-- moi css-->
  <link href="../comon/comon.css" rel="stylesheet type="/>
  <!-- moi js-->
  <script type="text/javascript">
    $(document).ready(function(){
    
    });
  </script>
</head>

<body role="document"><br /><br />
	<?php  if (!empty($_SESSION["users_id"])) { ?>
	<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<?php  
  			require_once 'include_admin/menu_admin.php';
		?>
	</div>
	<div class="container theme-showcase" role="main">
		<div class="jumbotron">
  			<div class="vivod">
  				<div class="table-responsive">
          		<table class="table">
            		<thead>
                		<tr>
		                  <th>Id coment</th>
		                  <th>Дата</th>
		                  <th>user id</th>
		                  <th>Логин</th>
		                  <th>Тема</th>
		                  <th>Коментарий</th>
		                  <th>Действие</th>
		                </tr>
		            </thead>
						<?php
							echo "<p class='col-md-6 col-md-offset-3'>Вeсь список коментариев:<p/>";

							while ($qwe =  $result_2->fetch(PDO::FETCH_ASSOC)){
								// var_dump($qwe);
								 // die(123);
								$users_id =$qwe['users_id'];
		
								$query_3 = "SELECT * FROM users WHERE users_id='$users_id' AND activated=1";
									
								$result_3 =$pdo->prepare($query_3);
								$result_3->execute();
								$qwe_2 = ($result_3->fetch(PDO::FETCH_ASSOC));
								$activated =$qwe['activated'];
								
						?>     
					<tbody>
                  		<tr>
							<?php
					 				echo '<td>'.$qwe['id'].'</td>';
					 				echo '<td>'.$qwe['date'].'</td>';
					 				echo '<td>'.$qwe['users_id'].'</td>';
					 				echo '<td>'.$qwe_2['users_login'].'</td>';
					 		 		echo '<td>'.$qwe['subject'].':'.'<p id="tema">'.'</td>';
					 		 		echo '<td>'.$qwe['coments'].'</td>';
					 		 		echo '<td>';
					 		 		 if ($activated==0) {
										echo '<a href="?action=approve&id=' . $qwe['id'] . '" name="Добавить" class="btn btn-success">Новый добавить</a> <br/>'.'<br/>';
									}
					 		 			echo '<a href="?action=delete&id=' . $qwe['id'] . '" class="btn btn-danger">Удалить</a> <br/>' .'</td>';
								};
							 	echo  $message;
							?>
						</tr>
					</tody>;
			</div>
		</div>
	</div>
<div id="footer"></div>
</body>
<?php }else{ ?>
			<a href='admin/index.php'>Нужно Авторизироваться!</a>
		<?php } ?>
</html>