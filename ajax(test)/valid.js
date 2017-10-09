$(document).ready(function() {
	$("#countrydropdown").change(function() {
		var countryvalue = $("#countrydropdown option:selected").val();
		if (countryvalue == '') {clearlist();}
		getarea();
	})
	$("#areadropdown").change(function() {
		getcity();
	})
}

);

function getarea() {
	var countryvalue = $("#countrydropdown option:selected").val();
	var area = $("#areadropdown");
	if (countryvalue == 0) {
		area.attr("disabled",true);
		getcity();
	} else {

		area.attr("disabled",false);
		area.load('getarea.php',{country : countryvalue});
	}
	
}
function getcity() {
	var countryvalue = $("#countrydropdown option:selected").val();
	var areavalue = $("#areadropdown option:selected").val();
	var city = $("#citydropdown");
	if (countryvalue == 0) {
		city.attr("disabled",true);
	} else {
		city.attr("disabled",false);
		city.load('getcity.php',{area : areavalue});
	}
}
function clearlist() {
	$("#areadropdown").empty();
	$("#citydropdown").empty();
}