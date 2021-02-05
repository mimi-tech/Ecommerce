

<?php
	
	if (isset($_POST['length'])) {
		include 'class.coupon.php';
		$no_of_coupons = $_POST['no_of_coupons'];
		$length = $_POST['length'];
		$prefix = $_POST['prefix'];
		$suffix = $_POST['suffix'];
		$numbers = $_POST['numbers'];
		$letters = $_POST['letters'];
		$symbols = $_POST['symbols'];
		$random_register = $_POST['random_register'] == 'false' ? false : true;
		$mask = $_POST['mask'] == '' ? false : $_POST['mask'];
		$coupons = coupon::generate_coupons($no_of_coupons, $length, $prefix, $suffix, $numbers, $letters, $symbols, $random_register, $mask);
		foreach ($coupons as $key => $value) {
			echo $value."\n ";
		}
		die();
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>PHP - Coupon Code Generator</title>
	 <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2>PHP - Coupon Code Generator</h2>
				
				
				<form action="index.php" method="post" id="coupon_form">
				 <div class="form-group">
                                            <label>Email</label>
                                            <input name="email" type="email" class="form-control" placeholder="Your Email Address" required>
											</div>
                                       
										
                                            <div class="form-group">
                                            <label>Subject</label>
                                            <input name="subject" type="text" class="form-control" placeholder="Enter Subject" required>
											</div>
                                       
										
										<div class="form-group">
										  <label for="comment">News</label>
										  <textarea name="news" class="form-control" rows="10" id="comment" required></textarea>
										 </div>
										<td><a href=coupon-code/index.php?<?php echo $citem['user_id'];?>><button class="btn btn-lg" >
                              Send 
                            </button></a></td>
											
                                           
					<table class="table table-striped hidden">
						<tr>
							<th>Parameter</th>
							<th>Type</th>
							<th>Default</th>
							<th>Custom value</th>
						</tr>
						<tr>
							<th>Number of coupons</th>
							<td>number</td>
							<td>1</td>
							<td><input class="form-control hidden" type="number" name="no_of_coupons" value="1" min="1"/></td>
						</tr>
						<tr>
							<th>Length</th>
							<td>number</td>
							<td>6</td>
							<td><input class="form-control hidden" type="number" name="length" value="6" min="1" /></td>
						</tr>
						<tr>
							<th>Prefix</th>
							<td>string</td>
							<td></td>
							<td><input class="form-control hidden" type="text" name="prefix" value="prefix-" /></td>
						</tr>
						<tr>
							<th>Suffix</th>
							<td>string</td>
							<td></td>
							<td><input class="form-control hidden" type="text" name="suffix" value="-suffix" /></td>
						</tr>
						<tr>
							<th>Numbers</th>
							<td>boolean</td>
							<td>true</td>
							<td>
								<select class="form-control hidden" name="numbers">
								  	<option value="false">False</option>
								  	<option selected value="true">True</option>
								</select>
							</td>
						</tr>
						<tr>
							<th>Letters</th>
							<td>boolean</td>
							<td>true</td>
							<td>
								<select class="form-control hidden" name="letters">
								  	<option value="false">False</option>
								  	<option selected value="true">True</option>
								</select>
							</td>
						</tr>
						<tr>
							<th>Symbols</th>
							<td>boolean</td>
							<td>false</td>
							<td>
								<select class="form-control hidden" name="symbols">
								  	<option selected value="false">False</option>
								  	<option value="true">True</option>
								</select>
							</td>
						</tr>
						<tr>
							<th>Random register</th>
							<td>boolean</td>
							<td>false</td>
							<td>
								<select class="form-control hidden" name="random_register">
								  	<option selected value="false">False</option>
								  	<option value="true">True</option>
								</select>
							</td>
						</tr>
						<tr>
							<th>Mask</th>
							<td>string or boolean</td>
							<td>false</td>
							<td><input class="form-control hidden" type="text" name="mask" value="XXX-XXX" /></td>
						</tr>
					</table>
					
					
					<div class="col-md-offset-8 col-md-4">
						<button type="submit" class="btn btn-success pull-right">Generate</button>
						<br/><br/>
					</div>
					<hr />
						<textarea class="form-control" placeholder="Result here" id="result" rows="3" readonly="" name="result"></textarea>
					<hr />
					<input type="submit" name="log" value="Send" class="btn btn-primary btn-lg">
					<br/><br/><br/><br/><br/>
				</form>
			</div>
		</div>
	</div>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>

    <script type="text/javascript">
	$(document).ready(function(){
		$('#coupon_form').submit(function() {
			var no_of_coupons = $('input[name="no_of_coupons"]').val();
			var length = $('input[name="length"]').val();
			var prefix = $('input[name="prefix"]').val();
			var suffix = $('input[name="suffix"]').val();
			var numbers = $('select[name="numbers"]').val();
			var letters = $('select[name="letters"]').val();
			var symbols = $('select[name="symbols"]').val();
			var random_register = $('select[name="random_register"]').val();
			var mask = $('input[name="mask"]').val();

			$('#result').load('index.php', {
				no_of_coupons: no_of_coupons,
				length: length,
				prefix: prefix,
				suffix: suffix,
				numbers: numbers,
				letters: letters,
				symbols: symbols,
				random_register: random_register,
				mask: mask
			});
			return false;
		});
	});

	function exporttocsv() {
		if ($('#result').val()) {
			var a = document.createElement('a');
			with (a) {
				href='data:text/csv;base64,' + btoa($('#result').val());
				download='csvfile.csv';
			}
			document.body.appendChild(a);
			a.click();
			document.body.removeChild(a);
	        }
        };
	</script>
</body>
</html>
