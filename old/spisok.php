<?php
session_start();

define("DATABASE_HOST", "localhost");
define("DATABASE_NAME", "new_project");
// define("DATABASE_PASSWORD", "246814a0");
define("DATABASE_USERNAME", "root");

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
$con = mysql_connect(DATABASE_HOST, DATABASE_USERNAME); //DATABASE_PASSWORD
$db = mysql_select_db(DATABASE_NAME, $con);

$query_2 = "SELECT * FROM users";
$result_2 = mysql_query($query_2);
 
?>
<!DOCTYPE html>
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
<body>
<div class="vivod" >
	<?php
		echo "Вeсь список коментариев:".'<br />'.'<br />';
		while ($qwe = mysql_fetch_array($result_2)){

			$users_id =$qwe['users_id'];
		
			$query_3 = "SELECT * FROM users_coments WHERE users_id='$users_id' AND activated=1";

			$result_3 = mysql_query($query_3);

			$qwe_2 = mysql_fetch_array($result_3);
		 		echo $qwe_2['first_name'].'<br>'.
		 		 	$qwe['subject'].':'.'<p id="tema">'.' '.
		 		 	$qwe['coments'].' '.'<br /><br />'.' '.
		 		 	$qwe['date'].'<br />';
	};
	
	?>
</div>
<br />
<a href="coment.php">Назад</a><br /><br />
<a href="index.php">Главная</a>
</body>
</html>