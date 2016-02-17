<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to Weather managment</title>

	
</head>


<body>
<a href="<?php echo site_url('imageupload'); ?>">For Rest api </a>
<div id="container">
	<center><h1>Welcome to Weather managment</h1></center>

	<form>
	<center><div id="body">
		<label>Select your City : </label>
		<select class="zipcode" name="zipcode">
				<option value="">Select Cities</option>
				<option value="INXX0012">Banglore</option>
				<option value="INXX0382">Mumbai</option>
				<option value="INXX0102">Pune</option>
				<option value="INXX0202">Chennai</option>
				<option value="INXX0032">Kochi</option>
		</select>


		<div>
			<input type="button" class="submit_city" value="submit">
		</div>
	</div>
	</center>
	</form>
	
	<center><p class="result_page">

	</p></center>
</div>

</body>

<script src="<?php echo base_url(); ?>js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {

	$('.submit_city').click(function(event) {

		var pincode = $('.zipcode').val();

		$.ajax({
                        url: '<?php echo site_url("weathers/get_weather_condition") ?>',
                        type: 'POST',
                        data: {zipcode:pincode},
                        success:function(msg){
                         
                         $('.result_page').html(msg);
                            
                        }
        });



	});


});
</script>
</html>

