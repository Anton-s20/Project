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
$users_login ='';
if (!empty($_POST)){
	$users_login = trim($_POST ['users_login']);

	if ($users_login==""){
		$message ="error";
		$array['null_login']="Поле Логин не заполнено!";
	}

	if ($message ==""){
		$query = "SELECT * FROM users WHERE users_login='$users_login'";
		$result = $pdo->query($query);
		$result->execute();
		$qwe = ($result->fetch(PDO::FETCH_ASSOC));

		$message_mail = "Для того, что бы изменить пароль, нажмите на эту<a href='http://mini-ticket.loc/confirm_rp.php?&users_id=$qwe[users_id]>ссылку</a>!";
		$to = "anton_goncharenko@mail.ru";
		$from = "$qwe[email]";
		$subject ="Замена пароля";
		$subject ="=?utf-8?B".base64_encode($subject)."?=";
		$headers = "From: $from\r\nReply-to: $from\r\nContent-type: text/html; charset=utf-8\r\n";
		mail($to, $subject, $message_mail, $headers);
		echo"Вам выслано сообщение на вашу почту, проверте Вашу почту для того что бы продолжить";
	}else{
		$message ="error";
		$array['null_login']="Такого пользователя нет!";
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
		var users_login = $('#users_login').val().trim();
		
		if (users_login==""){
			message = "error";
			$('#c_login').addClass('has-error');
			$('#users_login').tooltip({
    		title : 'Заполните поле логин',
    		placement: 'right',
  			});
  		}
		if (users_login!=""){
			$('#c_login').removeClass('has-error').addClass('has-success');
			$('#users_login').tooltip('destroy');
		}

		if (message == ""){
			$('#r_form').submit();
		}
	}
	</script>

</head>
<body>
 
 <div class="container">
 <div class="row">
 <div class="col-md-6 col-md-offset-3">
 <h3>Восстановление доступа к странице</h3>
 <h4 class="header"> Пожалуйста, введите ниже Ваш логин</h4>
 	
		<form class="form-horizontal" onSubmit="valid(); return false;" name="r_form" action="r_password.php" method="POST" id='r_form'>	 
	  		<div class="form-group">
	    		<label for="users_login" class="col-sm-2 control-label">Логин</label>
	    			<div class="col-sm-10" id="c_login">
	      				<input type="text" class="form-control" id="users_login" name="users_login" value="<?php echo $users_login ?>" placeholder="Логин" >
	    			</div>
	    	</div>
	  	 	<div class="error" id="error">
	  	 	<?php  
				echo $array['null_login'];
			?>

			</div>
	  		<div class="form-group">
	    			<div class="col-sm-offset-2 col-sm-10">
	    				<input type="submit"  value="Ok" class="btn btn-success">
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