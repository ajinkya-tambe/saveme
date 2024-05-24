<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Electricity Bill Calculator</title>

		<link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">

		<style>
			body {
			min-height: 100vh;
			display: flex;
			align-items: center;
			justify-content: center;
			padding: 20px;
			}
			.container {
			position: relative;
			max-width: 700px;
			width: 100%;
			background: #fff;
			padding: 25px;
			border-radius: 8px;
			box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
			position: fixed;
  background: rgba(0, 0, 0, 0.5);
  color: #f1f1f1;
  width: 100%;
  padding: 20px;
			}

			.heading, .row, .calcBtn{
				display:flex;
				justify-content:center;
				align-items:center;
			}

			#getUnits{
				margin: 20px;
			}

			#submitBtn{
				margin-top:25px;
			}

			.button-71 {
			background-color: #0078d0;
			border: 0;
			border-radius: 56px;
			color: #fff;
			cursor: pointer;
			display: inline-block;
			font-family: system-ui,-apple-system,system-ui,"Segoe UI",Roboto,Ubuntu,"Helvetica Neue",sans-serif;
			font-size: 18px;
			font-weight: 600;
			outline: 0;
			padding: 16px 21px;
			position: relative;
			text-align: center;
			text-decoration: none;
			transition: all .3s;
			user-select: none;
			-webkit-user-select: none;
			touch-action: manipulation;
			}

			.button-71:before {
			background-color: initial;
			background-image: linear-gradient(#fff 0, rgba(255, 255, 255, 0) 100%);
			border-radius: 125px;
			content: "";
			height: 50%;
			left: 4%;
			opacity: .5;
			position: absolute;
			top: 0;
			transition: all .3s;
			width: 92%;
			}

			.button-71:hover {
			box-shadow: rgba(255, 255, 255, .2) 0 3px 15px inset, rgba(0, 0, 0, .1) 0 3px 5px, rgba(0, 0, 0, .1) 0 10px 13px;
			transform: scale(1.05);
			}

			@media (min-width: 768px) {
			.button-71 {
				padding: 16px 48px;
			}
			}
			#myVideo {
  position: fixed;
  right: 0;
  bottom: 0;
  min-width: 100%; 
  min-height: 100%;
}

	</style>

		<script src="http://code.jquery.com/jquery.js"></script>
		
		<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
		
	</head>
	<body>
	<video autoplay muted loop id="myVideo">
  <source src="myVid.mp4" type="video/mp4">
</video>
	<div class="container">
		<h1 class="heading">Electricity Bill Calculator</h1>
		<form action="" method="POST" role="form">
		<div class="row">
			<div class="col-lg-6">
				<div class="form-group">
				<input type="text" id="getUnits" class="form-control" name="unit" placeholder="Input total Unit">
				</div>
			</div>
		</div>
		<div class="calcBtn">
				<button type="submit" class="btn btn-primary button-71">Calculate</button>
			</div>
		</form>

		<hr>

		
		<?php
		if(isset($_POST['unit']))
		{
			$total = 0;
			$unit = (int) $_POST['unit'];

			function calculate($unit,$range,$price)
			{
				$xunit = $range[1]-$range[0]+1;
				if($unit<=$xunit && $unit>0)
				{
					$bill = $unit  * $price;
					echo "
						<tr>
							<td>".implode("-", $range)."</td>
							<td>$price</td>
							<td>$unit</td>
							<td>$bill Rs.</td>
						</tr>
						";
					return array($unit-$xunit, $bill);
				}
				elseif($unit>$xunit)
				{
					$bill = $xunit * $price;
					$newUnit = $unit - $xunit;
					echo "
						<tr>
							<td>".implode("-", $range)."</td>
							<td>$price</td>
							<td>".$xunit."</td>
							<td>$bill Rs.</td>
						</tr>
						";
					return array($newUnit, $bill);
				}
			}

			echo "<h3>Bill for $unit Unit</h3>";

			echo "<table class=\"table table-hover\">
			<thead>
				<tr>
					<th>Range</th>
					<th>Price/Unit</th>
					<th>Unit</th>
					<th>Bill</th>
				</tr>
			</thead>
			<tbody>
				
			";

			$newUnit = 0;
			$meter = 0;
			if($unit>0)
			{
				$rep = calculate($unit,array(1,50),3.50);
				$newUnit = $rep[0];
				$total += $rep[1];
			}
			if($newUnit>0)
			{
				$rep = calculate($newUnit,array(51,150),4);
				$newUnit = $rep[0];
				$total += $rep[1];
			}
			if($newUnit>0)
			{
				$rep = calculate($newUnit,array(151,250),5.20);
				$newUnit = $rep[0];
				$total += $rep[1];
			}
			if($newUnit>0)
			{
				$rep = calculate($newUnit,array(251,1000000),6.50);
				$newUnit = $rep[0];
				$total += $rep[1];
			}
			$meter = $_POST['unit'];
			$newTotal = $total + $meter;
			echo "
				
			</tbody>
			<tfoot>
				<tr>
					<th></th>
					<th></th>
					<th>Bill</th>
					<th>$newTotal Rs.</th>
			</tfoot>
		</table>";
		}
		?>
	
	</div>	
	</body>
</html>