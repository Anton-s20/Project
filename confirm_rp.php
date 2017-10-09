<?php

ob_start();
try {
	$pdo = new PDO("mysql:dbname=new_project;host=localhost","root","");
}catch(PDOException $e){
	echo "Возникла ошибка соединения: ".$e->getMessage();
	exit;
}

$array=array();
$message ='';
if (!empty($_POST)){

	$users_password = (trim($_POST ['users_password']));

	$password_length = strlen(trim($_POST['users_password']));
	$minpassword_length = 3;
	$maxpassword_length = 15;
	if ($password_length <= $minpassword_length || $password_length >= $maxpassword_length){
		$array['incorrect_password']="Строка 'Пароль' должна иметь не меньше 4-х символов и не больше 15!<br />";
	}
	 
	$users_password_2 = (trim($_POST ['users_password_2']));
	$password_2_length = strlen(trim($_POST['users_password_2']));
	$minpassword_2_length = 3;
	$maxpassword_2_length = 15;
	if ($password_2_length <= $minpassword_2_length || $password_2_length >= $maxpassword_2_length){
		$array['incorrect_password']="Строка Повторить пароль должна иметь не меньше 4-х символов и не больше 15!<br />";
	}
				
	if ($users_password != $users_password_2){
			$array['incorrect_password_2']="Повторите пароль правильно!<br />";
	}

	if ($users_password==""){
		$message ="error";
		$array['incorrect_password']="Поле не заполнено!";
	}
	if ($users_password_2==""){
		$message ="error";
		$array['incorrect_password']="Поле не заполнено!";
	}

	if ($message ==""){
		$users_id = ($_POST ['users_id']);
		$query ="UPDATE users SET users_password=:users_password WHERE users_id=:users_id";

		$result = $pdo->prepare($query);

		$result->bindParam(':users_password', $users_password , PDO:: PARAM_STR);
		$result->bindParam(':users_id', $users_id , PDO:: PARAM_STR);
		$result->execute();

		echo "Поздравляем, Вы успешно изменили свой пароль!";
		echo "Перейти к авторзации по <a href='index.php'>этой ссылке!</a><br />";
		
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
	function valid() {
		var message ="";

		var users_password = $('#users_password_2').val().trim();
		var users_password_2 = $('#users_password_2_2').val().trim();


		var password_length = users_password.length;
		var minpassword_length = 3;
		var maxpassword_length = 15;


		var password_2_length = users_password_2.length; 
		var minpassword_2_length = 3;
		var maxpassword_2_length = 15;



		if (users_password==""){
			message = "error";
			$('#r_users_password').addClass('has-error');
			$('#users_password_2').tooltip({
    		title : 'Заполните поле Пароль!',
    		placement: 'right',
  			});
  			$('#users_password').html("Заполните поле Пароль!");
  		}else if (password_length <= minpassword_length || password_length >= maxpassword_length){
			message = "error";
			$('#r_users_password').addClass('has-error');
			$('#users_password_2').tooltip({
    		title : 'Заполните поле Пароль!',
    		placement: 'right',
  			});
			$('#users_password').html("Заполните полe Пароль правильно, не меньше 4-х символов и не больше 15!<br />"); 	
		}else if (users_password!=""){
			$('#users_password').html("");
			$('#r_users_password').removeClass('has-error').addClass('has-success');
			$('#users_password_2').tooltip('destroy');
		}
	
		if (users_password_2==""){
			message = "error";
			$('#r_users_password_2').addClass('has-error');
			$('#users_password_2_2').tooltip({
    		title : 'Заполните поле Повторить Пароль!',
    		placement: 'right',
  			});
  			$('#users_password_3').html("Заполните поле Повторить Пароль!");
  		}else if (password_2_length <= minpassword_2_length || password_2_length >= maxpassword_2_length){
			message = "error";
			$('#r_users_password_2').addClass('has-error');
			$('#users_password_2_2').tooltip({
    		title : 'Заполните поле Повторить Пароль!',
    		placement: 'right',
  			});
			$('#users_password_3').html("Заполните полe Повторить Пароль правильно, не меньше 4-х символов и не больше 15!<br />"); 	
		}else if (users_password_2!=""){
			$('#r_users_password_2').removeClass('has-error').addClass('has-success');
			$('#users_password_2_2').tooltip('destroy');
			$('#users_password_3').html("");
		}

		if (users_password!=users_password_2){
			message = "error";
			$('#r_users_password_2').addClass('has-error');
			$('#users_password_2_2').tooltip({
    		title : 'Пароли не совпадают!',
    		placement: 'right',
  			});
			$('#users_password_3').html("Пароли не совпадают!");
		}else if (password_length >0 && password_2_length>0 && users_password == users_password_2){
			$('#r_users_password_2').removeClass('has-error').addClass('has-success');
			$('#users_password_2_2').tooltip('destroy');
			$('#users_password_3').html("");
		}

		if (message == ""){
			$('#con_form').submit();
		}
	}
	</script>

</head>
<body>
 
 <div class="container">
 <div class="row">
 <div class="col-md-6 col-md-offset-3">
 <h3>Изменить пароль</h3>
 <h4 class="header"> Пожалуйста, введите ниже Ваш новый Пароль</h4>
		<form class="form-horizontal" onSubmit="valid(); return false;" name="con_form" action="confirm_rp.php" method="POST" id='con_form'>
		<input type="hidden" name="users_id" value=<?php echo $_GET['users_id']; ?>>
			<div class="form-group">
			<div class="col-sm-10" id="r_users_password">
				<div class="inputregs">
					<label for="users_password" class="control-label">Ваш новый пароль:</label>
					<input class="form-control" id="users_password_2" type="password" name="users_password"  size="15"  placeholder="Пароль"/>
					<div class="regserror" id="users_password"></div>
				</div>
			</div>
		</div>	
			<div class="error">
			<?php 
				echo $array['incorrect_password'];	
			?>
			</div>
		<div class="form-group">
			<div class="col-sm-10" id="r_users_password_2">
				<div class="inputregs">
					<label for="users_password_2" class="control-label">Повторите Ваш новый пароль:</label>
					<input class="form-control" id="users_password_2_2" type="password" name="users_password_2"  size="15"  placeholder="Повторить Пароль"/>
					<div class="regserror" id="users_password_3"></div>
				</div>			
			</div>
		</div>	
			<div class="error">
			<?php 
				echo $array['incorrect_password_2'];
			?>
			</div>

	  		<div class="form-group">
	    		<div class="col-sm-10">
	    			<input type="submit"  value="Save" class="btn btn-success">
	     		</div>
	     	<a class="btn btn-link" href="coment.php">Перейти к списку коментарий</a><br />
	     	<a href="index.php"  class="btn btn-link">Главная</a>
			</div>
		</form>
	</div>
</div>
</div>
	<div id="footer"></div>
</body>
</html>