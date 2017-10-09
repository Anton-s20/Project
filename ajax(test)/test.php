<?php

	$qwe = $_POST['name'];
	$qwe = 'Privet ' . $qwe;

	echo json_encode(
		array('result' => $qwe)
	);
?>



<!--  echo "<option value=\"".$zap["area_id"]."\">".$zap["area"]."</option>"; -->
<?php     
		// $query = "SELECT * FROM vg_countrys";
  //         $result = $pdo->query($query);
  //         $result->execute();
  //         while ($qwe = ($result->fetch(PDO::FETCH_ASSOC))){
  //           echo "<option value=\"".$qwe["country_id"]."\">".$qwe["country"]."</option>";
  //         }
        ?>

       <!--   // $('#button-click-me').on('click', function(){
      //   $.ajax({
      //     url: 'test.php',
      //     method: 'post',
      //     dataType: 'json',
      //     data: {
      //       name: 'Antoha'
      //     },
      //     success: function(res) {
      //       //console.log(res);
      //       $('#ajax-result').html(
      //           res.result
      //         );
      //     }
      //   });
      // }); -->