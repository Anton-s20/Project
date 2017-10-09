<?php
  try{
    $pdo = new PDO("mysql:dbname=new_project;host=localhost","root","");
  }catch(PDOException $e) {
    echo "Возникла ошибка соединения: ".$e->getMessage();
    exit;
  }
?>
<!DOCTYPE html>
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

      $("#countrydropdown").on('change', function(){
        var countryvalue = $("#countrydropdown option:selected").val();
        $.ajax({
          url: 'country_test.php',
          method: 'post',
          dataType: 'json',
          data: {country: countryvalue},
          success: function(res) {
            var str = '';
            for (var i = 0; i <= res.length - 1; i++) {
            str += '<option value="' + i + '">' + i + '</option>';
            };
            $('#areadropdown').html(str);
            }
        });
      });
    });

  </script>
</head>
<body>
<form action="" id="forma">
	<div id="Container">
		<div>
      <label>Выберите страну:</label><br/>
      <select id="countrydropdown">
        <option value="country_id"></option>
        <?php     
          $query = "SELECT * FROM vg_countrys";
          $result = $pdo->query($query);
          $result->execute();
          while ($zap = ($result->fetch(PDO::FETCH_ASSOC))){
            echo "<option value=\"".$zap["country_id"]."\">".$zap["country"]."</option>";
          }
        ?>
      </select>
    </div>
      <div id="divarea">
        <label>Область:</label><br/>
          <select id="areadropdown" disabled="disabled"></select>
          <option value="area_id"></option>
      </div>
        <div>
          <label>Город:</label><br/>
          <select id="citydropdown" disabled="disabled"></select>
        </div>
	</div>
</body>
</html>