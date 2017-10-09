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
$users_login = '';
if (!empty($_POST)){
	$users_login = trim($_POST ['users_login']);
	$users_password = trim($_POST ['users_password']);

	if ($users_login==""){
		$message ="error";
		$array['null_login']="Поле Логин не заполнено!";
	} 
	if ($users_password==""){
		$message ="error";
		$array['null_password']="Поле Пароль не заполнено!";
	}

	if ($message ==""){
		$query = "SELECT * FROM users WHERE users_login='$users_login' AND users_password='$users_password' AND activated=1";
		$result = $pdo->query($query);
		$a = $result->fetch(PDO::FETCH_ASSOC);
		if(!empty($a)){
			session_start();
			$_SESSION['users_id'] = $a['users_id'];
			$_SESSION['users_login'] = $users_login;
		  	header('Location: coment.php');
		}
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
		var users_login =  $('#users_login').val().trim();
		var users_password = $('#users_password').val().trim();
		
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
		if (users_password==""){
			message = "error";
			$('#c_password').addClass('has-error');
			$('#users_password').tooltip({
    		title : 'Заполните поле пароль',
    		placement: 'right',
  			});
  			
		}
		if(users_password!=""){
			$('#c_password').removeClass('has-error').addClass('has-success');
			$('#users_password').tooltip('destroy');
		}

		if (message === ""){
			$('#form').submit();
		}
	}
	</script>

</head>
<body>
 
 <div class="container">
 <div class="row">
 <div class="col-md-6 col-md-offset-3">
 <h1>Добро пожаловать на наш сайт!</h1>
 <h4 class="header"> Пожалуйста, введите ниже Ваш логин и пароль или <a href="regs.php">зарегистрируйтесь!</a></h4>
 	
		<form class="form-horizontal" onSubmit="valid(); return false;" name="form" action="index.php" method="POST" id='form'>	 
	  		<div class="form-group">
	    		<label for="users_login" class="col-sm-2 control-label">Логин</label>
	    			<div class="col-sm-10" id="c_login">
	      				<input type="text" class="form-control" id="users_login" name="users_login" value="<?php echo $users_login ?>" placeholder="Логин" >
	    			</div>
	    	</div>
	  		<div class="form-group">
	    		<label for="users_password" class="col-sm-2 control-label">Пароль</label>
	    			<div class="col-sm-10" id="c_password">
	      				<input type="password" class="form-control" id="users_password" name="users_password" placeholder="Пароль" >
	    			</div>
	  	 	</div>
	   
	  	 	<div class="error" id="error">
	  	 	<?php  
				echo $array['null_password']."<br />";
				echo $array['null_login'];
			?>

			</div>
	  		
	  		<div class="form-group">
	    			<div class="col-sm-offset-2 col-sm-10">
	    				<input type="submit"  value="Вход" class="btn btn-success">
	    				
	     			</div>
	     	<a class="btn btn-link" href="coment.php">Перейти к списку коментарий</a><br />
	     	<a class="btn btn-link" href="r_password.php">Забыли пароль?</a>
			</div>
		</form>
	</div>
</div>
</div>
	<div id="footer"></div>
</body>
</html>