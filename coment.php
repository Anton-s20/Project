<?php
session_start();
ob_start();

// try{
// 	$pdo = new PDO("mysql:dbname=new_project;host=localhost;charset=utf-8","root","");
// }catch(PDOException $e) {
// 	echo "Возникла ошибка соединения: ".$e->getMessage();
// 	exit;
// }

class Database {
	public $datab;
    public function __construct($username, $password){
        try {
             $this->datab = new PDO('mysql:dbname=new_project;host=localhost;charset=utf-8',$username, $password);
        } catch (PDOException $e) {
            echo "Возникла ошибка соединения: ".$e->getMessage();
			exit;
        }
    }
	public function test($data){
			 $array=array();
			 $subject = trim($data ['subject']);
			 $coments = trim($data ['coments']);
			 $data_time = date('Y-m-d H:i:s');
			 $activated =0;
			 if ($subject!="" && $coments!=""){
				 $users_id = $_SESSION['users_id'];
				 $query = "INSERT INTO users_coments (subject, coments, date, users_id, activated) 
		 		 VALUES (:subject, :coments, :data_time, :users_id, :activated)";
				 $result = $this->datab->prepare($query);
				 $result->bindParam(':users_id', $users_id, PDO:: PARAM_INT);
				 $result->bindParam(':subject',  $subject,  PDO:: PARAM_STR);
				 $result->bindParam(':coments',  $coments,  PDO:: PARAM_STR);
				 $result->bindParam(':data_time',$data_time,PDO:: PARAM_STR);
				 $result->bindParam(':activated',$activated,PDO:: PARAM_INT);
				 $result->execute();
			 }else{
			 	 $array['null_tema_coment'] ="Заполните все поля формы!";
			 }
			 if ($result != false){
			 	 	$array['otpravil'] ="Вы успешно отправили коментарий!".'<br />'."Он будет добавлен администрацией в скором времени.";
			 }
			 return $array;
			 
	}
}
$con = new Database('root','');

$array = array('null_tema_coment' => '', 'otpravil' => '');

if(!empty($_SESSION["users_id"])){
	if (!empty($_POST)){
		$array=$con->test($_POST);

	}
}
$query_2 = "SELECT * FROM users_coments WHERE activated=1";
$result_2 = $con->datab->prepare($query_2);
$result_2->execute();
?>
<!DOCTYPE html>
<html>
<head>
    <html lang="ru">
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- jQuery -->
	<script src="vendors/jquery/jquery.js"></script>
    <!-- Bootstrap -->
    <link href="vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="vendors/bootstrap/js/bootstrap.min.js"></script>
	<!-- moi css-->
	<link href="comon/comon.css" rel="stylesheet type="/>
	<!-- moi js-->
	<script type="text/javascript">
	$(document).ready(function(){
		
	});
	</script>
</head>
	<script type="text/javascript">

		function valid () {
			var message = "";
			var subject = $('#subject').val().trim();
			var coments = $('#coment').val().trim();

			if (subject==""){
				message = "error";
				$('#u_subject').addClass('has-error');
				$('#subject').tooltip({
    			title : 'Поле Тема не заполнено!',
    			placement: 'right',
  				});
  				$('#subject_info').html("Заполните поле Тема!");
		 			
			}
			if (subject!=""){
				$('#u_subject').removeClass('has-error').addClass('has-success');
				$('#subject').tooltip('destroy');
				$('#subject_info').html("");
			}

			if (coments==""){
				message = "error";
				$('#u_coment').addClass('has-error');
				$('#coment').tooltip({
    			title : 'Поле Коментарий не заполнено!',
    			placement: 'right',
  				});
  				$('#coment_info').html("Заполните поле Коментарий!");
			}
			if (coments!=""){
				$('#u_coment').removeClass('has-error').addClass('has-success');
				$('#coment').tooltip('destroy');
				$('#coment_info').html("");
			}

			if (message =="") {
		 		$("#comentform").submit();
			}
		}

	</script>
<body role="document">
	<div class="container"><br /><br />
	<h2>Страница коментариев</h2>
	<div class="row">
	
		<?php  if (!empty($_SESSION["users_id"])) { ?>
	<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<?php  
  			 require_once 'include/menu.php';
		?>
	</div>
	<div class="col-sm-6 ">
		<form class="form-horizontal" onSubmit="valid(); return false;" action="coment.php" method="POST" id='comentform'>
			<div class="form-group">
				<label for="subject" class="control-label" >Тема коментария:</label>
				<div class="col-sm-10" id="u_subject">
					<input class="form-control " type="text" id="subject" name="subject" value="<?php echo $subject ?>" size="50"  placeholder="Тема:">
				<div class="regserror" id="subject_info"></div>
				</div>
			</div>
			<div class="form-group">	
				<label for="coments" class="control-label" >Коментарий:</label><br />
				<div class="col-sm-10" id="u_coment">
					<textarea class="form-control" rows="3" type="text" id="coment" name="coments" size="100"  placeholder="Коментарий:"><?php echo $coments ?></textarea>
					<div class="regserror" id="coment_info"></div>
				</div>
			<br /><br />
			</div>
			<div class="error">
				<?php
					echo $array['null_tema_coment'];
					
				?>
			</div>
			<div class="success">
				<?php
					echo $array['otpravil'];
				?>
			</div>
			<br />
			<input type="submit" class="btn btn-success" name="button" value="Отправить"><br /><br />
			<input type="reset" class="btn btn-danger" value="Очистить все поля формы" /><br /><br />
		</form>
		<?php }else{ ?>
			<a href='index.php'>Для отправки сообщений нужно Авторизироваться!</a>
		<?php } ?>
 	</div>
		<div class="col-sm-6">
			<div class="table-responsive">
          		<table class="table">
            		<thead>
                		<tr>
		                  <th>Дата</th>
		                  <th>Логин</th>
		                  <th>Тема</th>
		                  <th>Коментарий</th>
		                </tr>
		        	</thead>
						<?php
							echo "<h4 class='col-md-6 col-md-offset-3'>Вeсь список коментариев:<h4>";

							while ($qwe =  $result_2->fetch(PDO::FETCH_ASSOC)){

								$users_id = $qwe['users_id'];
		
								$query_3 = "SELECT * FROM users WHERE users_id='$users_id' AND activated=1";

								$result_3 = $con->datab->prepare($query_3);
								$result_3->execute();

								$qwe_2 = ($result_3->fetch(PDO::FETCH_ASSOC));

						?>     
					<tbody>
                  		<tr>
							<?php
					 			echo
					 				'<td>'.$qwe['date'].'</td>'.
					 				'<td>'.$qwe_2['users_login'].'</td>'.
					 		 		'<td>'.$qwe['subject'].':'.'<p id="tema">'.'</td>'.
					 		 		'<td>'.$qwe['coments'].'</td>'
					 		 		;
								};
							?>
						</tr>
              		</tbody>
            	</div>
			</div>
		</div>
	<div id="footer"></div>
</body>
</html>