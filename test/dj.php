<?php
include("../utils/framework.php");

$cookie_value = 0;
$cookie_name = "bezoekers";
if(!isset($_COOKIE[$cookie_name])){
	$cookie_value = 0;
} else {
	$cookie_value = intval($_COOKIE[$cookie_name]) +1;
}
setcookie($cookie_name, $cookie_value, time() + (86400), "/");
	
?>

<html>
	<head>
		<title>Test page DJ</title>
		<?php require_once('../utils/snippets/header.php');?>
	</head>
	<body>
		<h1>Test page DJ</h1>
		<!--Querys-->
		<?php
			$sql = "SELECT * FROM customers ORDER BY CustomerName LIMIT 0,10";
			$result = $connection->query($sql);
			$sql1 = "SELECT * FROM deliverymethods";
			$result1 = $connection->query($sql1);
			echo"$cookie_value";
		?>
		<!-- Or let Bootstrap automatically handle the layout -->
		
		<div class="row col-sm-12">
			<div class="col-sm-2 text-right"> Product: </div>
			<div class="col-sm-8 text-center">
				<form action="" method="get">
		  		<input class="form-control" type="text" name="product" autocomplete="off">
		  		<button type="submit" class="btn btn-success">Zoek</button>
		  	</form>
		  	<?php
		  	if (!empty($_GET['product'])) {
		  		$invoer = $_GET['product'];
		  		$zoek = "SELECT * FROM stockitems WHERE SearchDetails LIKE '%$invoer%'";
		  		echo "<br>";
				$result2 = $connection->query($zoek);
			?>
			</div>
		</div>
		
		
<!--HIER TERUG PLAATSEN-->
			<!--collom 2-->
			
			<div class="container">
			<?php	
				if ($result2->num_rows > 0){
			?>
		  	<h2>Producten</h2>
		  	Zoekresultaten voor: <?php echo "$invoer"; ?>
		  	<table class="table table-striped table-hover">
		  		<thead>
		  			<tr>
		  				<th>ItemID</th>
		  				<th>ItemName</th>
		  				<th>Prijs</th>
		  				<th>Details</th>
		  				<th>BTW</th>
		  				<th>Advies Prijs</th>
		  			</tr>
		  		</thead>
		  		<tbody>			
					<?php  foreach($result2 as $row2): ?>
					<tr>
						<td><?=$row2['StockItemID'];?></td>
					   	<td><?=$row2['StockItemName'];?></td>
					   	<td><?=$row2['UnitPrice'];?></td>
					   	<td><?=$row2['SearchDetails'];?></td>
					  	<td><?=$row2['TaxRate'];?></td>
					  	<td><?=$row2['RecommendedRetailPrice'];?></td>
					</tr>
					<?php endforeach;?>					
		  		</tbody>
		  	</table>
						
						
			<?php
				}else{
					echo "0 Resultaten voor: $invoer";
				}
		  	}
		  	?>
			</div>
			
		  <div class="row col-sm-6">
					  	<h2>Bezorgmethodes</h2>
		  	<table class="table table-hover table-striped">
		  		<thead>
		  			<tr>
		  				<th>ID</th>
		  				<th>Bezorgmethode</th>
		  			</tr>
		  		</thead>
		  		<tbody>
					<?php  foreach($result1 as $row1): ?>
					        <tr>
					            <td><?=$row1['DeliveryMethodID'];?></td>
					            <td><?=$row1['DeliveryMethodName'];?></td>
					        </tr>
					<?php endforeach;?>					
		  		</tbody>
		  	</table>
		  	</div>
		  <div class="row col-sm text-left">

		  	</div>
		</div>
		<?php

		?>
		<?php require_once('../utils/snippets/footer.php');?>
	</body>
</html>

		

