<?php
session_start();

ob_start();
try {
  $pdo = new PDO("mysql:dbname=new_project;host=localhost","root","");
}catch(PDOException $e){
  echo "Возникла ошибка соединения: ".$e->getMessage();
  exit;
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
<body>
<?php 
  if (!empty($_SESSION["users_id"])) { 
?>
  <?php  
    require_once 'include_admin/menu_admin.php';
  ?>
<?php }else{ ?>
      <a href='index.php'> Нужно Авторизироваться!</a>
    <?php } ?>
</body> 
</html>