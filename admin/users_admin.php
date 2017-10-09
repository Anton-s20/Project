<?php

session_start();

ob_start();

try{
  $pdo = new PDO("mysql:dbname=new_project;host=localhost","root","");
}catch(PDOException $e) {
  echo "Возникла ошибка соединения: ".$e->getMessage();
  exit;
}

$query_2 = "SELECT * FROM users_admin";
$result_2 = $pdo->prepare($query_2);
$result_2->execute();


$message="";

if (!empty($_GET) && isset($_GET['action']) && isset($_GET['id'])) {
  if ($_GET['action'] == 'delete') {
    $id = $_GET['id'];
    $query_3 = "DELETE FROM users_admin WHERE users_id =:users_id";
    $result_3 = $pdo->prepare($query_3);
    $result_3->bindParam(':users_id',$id, PDO:: PARAM_STR);
    $result_3->execute();
    $message = "Admin № $id удален!";
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
                  <th>Id</th>
                  <th>Имя</th>
                  <th>Фамилия</th>
                  <th>Email</th>
                  <th>Логин</th>
                  <th>Пароль</th>
                  <th>Действие</th>
                </tr>
            </thead>

              <?php
                echo "<p class='col-md-6 col-md-offset-3'>Cписок Админов:<p/>";
                while ($qwe = $result_2->fetch(PDO::FETCH_ASSOC)){
              ?>
                  
              <tbody>
                  <tr>
                    <?php 
                     echo
                            '<td>'.$qwe['users_id'].'</td>'.
                            '<td>'.$qwe['first_name'].'</td>'.
                            '<td>'.$qwe['last_name'].'</td>'.
                            '<td>'.$qwe['email'].'</td>'.
                            '<td>'.$qwe['users_login'].'</td>'.
                            '<td>'.$qwe['users_password'].'</td>'.
                            '<td>'.
                                  '<a href="?action=delete&id=' . $qwe['users_id'] . '" class="btn btn-danger">Удалить</a> <br/>' .
                            '</td>'
                            ;
                     };
                     echo  $message;
                    ?>
                  </tr>
              </tbody>
          </table>
          </div>      
        </div>
    </div>
  </div>
<div id="footer"></div>
</body>
<?php }else{ ?>
      <a href='admin/index.php'>Нужно Авторизироваться!</a>
<?php } ?>
</html>