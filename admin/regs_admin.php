<?php

try{
	$pdo = new PDO("mysql:dbname=new_project;host=localhost","root","");
}catch(PDOException $e) {
	echo "Возникла ошибка соединения: ".$e->getMessage();
	exit;
}

$array=array();
$message ="";
$message_2 = "Вы теперь <a href=admin.php>Admin</a>";

if (!empty($_POST)){

	$email = trim($_POST ['email']);
	$email_length = strlen(trim($_POST['email']));

	$minEmail_length = 3;
	$maxEmail_length = 15;
	if (!filter_var($email , FILTER_VALIDATE_EMAIL)){
		$message ="error";
	 	$array['incorrect_email']="Cтрокa Адрес электронной почты должна быть правильной!<br />";

	}else if ($email_length <= $minEmail_length || $email_length >= $maxEmail_length){
		$message ="error";
		$array['incorrect_email']="Заполните полe Адрес электронной почты, не меньше 4-х символов и не больше 15!<br />";
	}
 

	$first_name = (trim($_POST ['first_name']));
	$first_name_length = strlen(trim($_POST['first_name']));
	$minfirst_name_length = 3;
	$maxfirst_name_length = 15;
	if ($first_name_length <= $minfirst_name_length || $first_name_length >= $maxfirst_name_length){
		$message ="error";
		$array['incorrect_first_name']="Строка Имя должна иметь не меньше 4-х символов и не больше 15!<br />";
	}
		
	$last_name = (trim($_POST ['last_name']));
	$last_name_length = strlen(trim($_POST['last_name']));
	$minlast_name_length = 3;
	$maxlast_name_length = 15;
	if ($last_name_length <= $minlast_name_length || $last_name_length >= $maxlast_name_length){
		$message ="error";
		$array['incorrect_last_name']="Строка 'Фамилия' должна иметь не меньше 4-х символов и не больше 15!<br />";
	}
	 	
	$users_login = (trim($_POST ['users_login']));
	$login_length = strlen(trim($_POST['users_login']));
	$minlogin_length = 3;
	$maxlogin_length = 15;
	if ($login_length <= $minlogin_length || $login_length >= $maxlogin_length){
		$message ="error";
			$array['incorrect_login']="Строка 'Логин' должна иметь не меньше 4-х символов и не больше 15!<br />";
	}
	 	
	$users_password = (trim($_POST ['users_password']));
	$password_length = strlen(trim($_POST['users_password']));
	$minpassword_length = 3;
	$maxpassword_length = 15;
	if ($password_length <= $minpassword_length || $password_length >= $maxpassword_length){
		$message ="error";
		$array['incorrect_password']="Строка 'Пароль' должна иметь не меньше 4-х символов и не больше 15!<br />";
	}
	 
	$users_password_2 = (trim($_POST ['users_password_2']));
	$password_2_length = strlen(trim($_POST['users_password_2']));
	$minpassword_2_length = 3;
	$maxpassword_2_length = 15;
	if ($password_2_length <= $minpassword_2_length || $password_2_length >= $maxpassword_2_length){
		$message ="error";
		$array['incorrect_password']="Строка Повторить пароль должна иметь не меньше 4-х символов и не больше 15!<br />";
	}
	
		

	if ($users_password != $users_password_2){
		$message ="error";
				$array['incorrect_password_2']="Повторите пароль правильно!<br />";
	}
	if ($email ==""){
		$message ="error";
				$array['incorrect_email']="Заполните поле Адрес электронной почты!<br />";
	}
	if ($first_name==""){
		$message ="error";
				$array['incorrect_first_name']="Заполните полe Имя!<br />";
	}
	if ($last_name==""){
		$message ="error";
				$array['incorrect_last_name']="Заполните полe Фамилия!<br />";
	}
	if ($users_login==""){
		$message ="error";
				$array['incorrect_login']="Заполните поле Логин!<br />";				
	} 
	if ($users_password==""){
		$message ="error";
				$array['incorrect_password']="Заполните поле Пароль!<br />";
	}
	if ($message ==""){

		$query = " INSERT INTO users_admin (first_name , last_name , email , users_login , users_password) 
		 		   VALUES (:first_name , :last_name , :email , :users_login , :users_password)";
			$result = $pdo->prepare($query);
			$result->bindParam(':first_name', $first_name , PDO:: PARAM_STR);
			$result->bindParam(':last_name', $last_name , PDO:: PARAM_STR);
			$result->bindParam(':email', $email , PDO:: PARAM_STR);
			$result->bindParam(':users_login', $users_login , PDO:: PARAM_STR);
			$result->bindParam(':users_password', $users_password , PDO:: PARAM_STR);
			$result->execute();
			echo $message_2;
  
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<head>
	<html lang="ru">
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="../viewport" content="width=device-width, initial-scale=1">
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

	<script type="text/javascript">
		function valid() {
			var message ="";
			var email = $('#email_2').val().trim();
			var first_name = $('#first_name_2').val().trim();
			var last_name = $('#last_name_2').val().trim();
			var users_login = $('#users_login_2').val().trim();
			var users_password = $('#users_password_2').val().trim();
			var users_password_2 = $('#users_password_2_2').val().trim();

			
			var email_length = email.length;
			var minEmail_length = 3;
			var maxEmail_length = 15;
		

			var first_name_length = first_name.length;
			var minfirst_name_length = 3;
			var maxfirst_name_length = 15;


			var last_name_length = last_name.length;
			var minlast_name_length = 3;
 			var maxlast_name_length = 15;


 			var login_length = users_login.length;
			var minlogin_length = 3;
			var maxlogin_length = 15;


			var password_length = users_password.length;
			var minpassword_length = 3;
			var maxpassword_length = 15;


			var password_2_length = users_password_2.length; 
			var minpassword_2_length = 3;
			var maxpassword_2_length = 15;


		if (email==""){
			message = "error";
			$('#r_email').addClass('has-error');
			$('#email_2').tooltip({
    		title : 'Заполните поле Email!',
    		placement: 'right',
  			});
  			$('#email').html("Заполните поле Email!");
  		}else if (email_length <= minEmail_length || email_length >= maxEmail_length){
			message = "error";
			$('#email').html("Заполните полe Адрес электронной почты правильно, не меньше 4-х символов и не больше 15!<br />");
		 	$('#r_email').addClass('has-error');
			$('#email_2').tooltip({
    		title : 'Заполните поле Email!',
    		placement: 'right',
  			});
		}else if (email!=""){
			$('#email').html("");
			$('#r_email').removeClass('has-error').addClass('has-success')
			$('#email_2').tooltip('destroy');
		}


		if (first_name==""){
			message = "error";
			$('#r_first_name').addClass('has-error');
			$('#first_name_2').tooltip({
    		title : 'Заполните поле Имя!',
    		placement: 'right',
  			});
  			$('#first_name').html("Заполните поле Имя!");
  		}else if (first_name_length <= minfirst_name_length || first_name_length >= maxfirst_name_length){
			message = "error";
			$('#first_name').html("Заполните полe Имя правильно, не меньше 4-х символов и не больше 15!<br />");
		 	$('#r_first_name').addClass('has-error');
			$('#first_name_2').tooltip({
    		title : 'Заполните поле Имя!',
    		placement: 'right',
  			});
		}else if (first_name!=""){
			$('#first_name').html("");
			$('#r_first_name').removeClass('has-error').addClass('has-success');
			$('#first_name_2').tooltip('destroy');
		}


		if (last_name==""){
			message = "error";
			$('#r_last_name').addClass('has-error');
			$('#last_name_2').tooltip({
    		title : 'Заполните поле Фамилия!',
    		placement: 'right',
  			});
  			$('#last_name').html("Заполните поле Фамилия!");
  		}else if (last_name_length <= minlast_name_length || last_name_length >= maxlast_name_length){
			message = "error";
			$('#r_last_name').addClass('has-error');
			$('#last_name_2').tooltip({
    		title : 'Заполните поле Фамилия!',
    		placement: 'right',
  			});
			$('#last_name').html("Заполните полe Фамилия правильно, не меньше 4-х символов и не больше 15!<br />"); 	
		}else if (last_name!=""){
			$('#last_name').html("");
			$('#r_last_name').removeClass('has-error').addClass('has-success');
			$('#last_name_2').tooltip('destroy');
		}


		if (users_login==""){
			message = "error";
			$('#r_users_login').addClass('has-error');
			$('#users_login_2').tooltip({
    		title : 'Заполните поле Логин!',
    		placement: 'right',
  			});
  			$('#users_login').html("Заполните поле Логин!");
  		}else if (login_length <= minlogin_length || login_length >= maxlogin_length){
			message = "error";
			$('#r_users_login').addClass('has-error');
			$('#users_login_2').tooltip({
    		title : 'Заполните поле Логин!',
    		placement: 'right',
  			});
			$('#users_login').html("Заполните полe Логин правильно, не меньше 4-х символов и не больше 15!<br />"); 	
		}else if (users_login!=""){
			$('#users_login').html("");
			$('#r_users_login').removeClass('has-error').addClass('has-success');
			$('#users_login_2').tooltip('destroy');
		}

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
		}else if (password_length > 0 && password_2_length> 0 && users_password == users_password_2){
			$('#r_users_password_2').removeClass('has-error').addClass('has-success');
			$('#users_password_2_2').tooltip('destroy');
			$('#users_password_3').html("");
		}

		if (message == ""){
		  $("#formregs").submit();
		}

	}
	 </script>

</head>
<body role="document">

 <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<?php  
  			require_once 'include_admin/menu_admin.php';
		?>
 </div>

 <div class="container theme-showcase" role="main">
 <div class="jumbotron">
 <div class="row">
 <div class="col-md-6 col-md-offset-3"> 
 	<h3>Регистрация Админа</h3>
 	<h4>Пожалуйста, введите ниже свои данные для регистрации:</h4>
 	
	<form class="form-horizontal" onSubmit="valid(); return false;" method="POST" id='formregs'>

		<div class="form-group">
			<div class="col-sm-10"  id="r_email">
				<div class="inputregs">
					<label for="email" class="control-label">Адрес электронной почты:</label>
					<input class="form-control" id="email_2" type="email" name="email" value="<?php echo $email ?>" size="15" placeholder="Email" />
					<div class="regserror" id="email"></div>
 				</div>
 			</div>
 		</div>
			<div class="error">
			<?php 
				echo $array['incorrect_email'];
			?>
			</div>
		<div class="form-group">
			<div class="col-sm-10" id="r_first_name">
				<div class="inputregs">
					<label for="first_name" class="control-label">Имя:</label>
					<input class="form-control" id="first_name_2" type="text" name="first_name" value="<?php echo $first_name ?>" size="15" placeholder="Имя"/>
					<div class="regserror" id="first_name"></div>
				</div>			
			</div>
		</div>
			<div class="error"><?php 
			
				 echo $array['incorrect_first_name'];
			
				?>
			</div>
		<div class="form-group">
			<div class="col-sm-10" id="r_last_name">
				<div class="inputregs">
				<label for="last_name" class="control-label">Фамилия:</label>
				<input class="form-control" id="last_name_2" type="text" name="last_name" value="<?php echo $last_name ?>" size="15" placeholder="Фамилия"/>
				<div class="regserror" id="last_name"></div>
				</div>
			</div>
		</div>
			<div class="error">
			<?php 
					 echo $array['incorrect_last_name'];
			?>
			</div>
		<div class="form-group">
			<div class="col-sm-10" id="r_users_login">
				<div class="inputregs">
				<label for="users_login" class="control-label">Ваш логин:</label>
				<input class="form-control" id="users_login_2" type="text" name="users_login" value="<?php echo $users_login ?>" size="15" placeholder="Логин" />
				<div class="regserror" id="users_login"></div>
				</div>
			</div>
		</div>
			<div class="error">
			<?php 
					    echo $array['incorrect_login']; 
				
				?>
			</div>
		<div class="form-group">
			<div class="col-sm-10" id="r_users_password">
				<div class="inputregs">
				<label for="users_password" class="control-label">Ваш пароль:</label>
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
				<label for="users_password_2" class="control-label">Повторите Ваш пароль пожалуйста:</label>
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
		<br />
		<input type="submit" class="btn btn-success" name="button"  value="Регистрация">
			<br />
			<br />
		<a href="index.php"  class="btn btn-link">Главная </a>

	</form>
 </div>
 </div>
 </div>
 </div>
<div id="footer"></div>
</body>
</html>