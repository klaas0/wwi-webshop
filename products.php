<?php
require('utils/framework.php');


if (!empty($_GET['search'])){
	$input = $_GET['search'];
	$sql= "SELECT * FROM stockitems WHERE SearchDetails LIKE '%$input%'";
	$result = $connection->query($sql);
} else if(!empty($_GET['categorie'])){
	$categorie = $_GET['categorie'];
	$sql= "SELECT * FROM stockitems Si JOIN stockitemstockgroups Ss ON Si.StockItemID = Ss.StockItemID JOIN stockgroups Sg ON Sg.StockGroupID = Ss.StockGroupID WHERE Ss.StockGroupID = '$categorie'";
	$result = $connection->query($sql);
} else {
	$sql= "SELECT * FROM stockitems";
	$result = $connection->query($sql);
}


?>

<html>
	<head>
		<?php require_once('utils/snippets/header.php');?>
	</head>
	<body class="blog-posts">
		<?php require_once('utils/snippets/navbar.php'); ?>
		<div class="page-header header-filter header-small" data-parallax="true" style="background-image: url('<?=Text::URL;?>/assets/images/bg1.jpg'); transform: translate3d(0px, 0px, 0px);">
			<div class="container">
				<div class="row">
					<div class="col-md-8 ml-auto mr-auto text-center">
						<h2 class="title">Product Pagina</h2>
					</div>
				</div>
			</div>
		</div>
		<div class="main main-raised mb-3">
			<div class="container">
				<div class="section">
					<div>
						<label for="categorie">Categorie</label>
						<select name="categorie" class="selectpicker" data-style="btn btn-link" id="categorie">
							<?php
								$query="SELECT DISTINCT Ss.StockGroupID ,Sg.StockGroupName FROM stockgroups Sg JOIN stockitemstockgroups Ss ON Sg.StockGroupID = Ss.StockGroupID ORDER BY Ss.StockGroupID";
								$result2= $connection->query($query);
								$row2= $result2->fetch_assoc();
								while($row2 = $result2->fetch_assoc()){ ?>
									<option value="<?= $row2['StockGroupID']; ?>"><?= $row2['StockGroupName']; ?></option>	
							<?php	
								}
								
							?>
						</select>
					</div>
					<div class="row">
					<?php
						if ($result->num_rows >0) {
							// output data for each row
							while($row = $result->fetch_assoc()) { ?>
							
									<div class="col-md-3 align-items-stretch d-flex">
									 <div class="card card-product card-plain no-shadow" data-colored-shadow="false">
										 <div class="card-header card-header-image">
											<a href="<?=Text::URL;?>/product/<?=$row['StockItemID']?>/">
											<img src="<?=Text::URL;?>/assets/images/placeholder.png" alt="...">
											</a>
										 </div>
										 <div class="card-body">
									 		<a href="<?=Text::URL;?>/product/<?=$row['StockItemID']?>/">
											<h4 class="card-title"><?=$row['StockItemName']; ?></h4>
											<p class="description"><?php echo strlen($row['SearchDetails']) > 50 ? substr($row['SearchDetails'],0,50)."..." : $row['SearchDetails']; ?>											 </p>
										 	</a>
										 </div>
										 <div class="card-footer justify-content-between">
                                             <div class="pull-left">
                                                 <div class="price-container">
                                                     <span class="price"><?=Utils::moneyString($row['UnitPrice']); ?></span>
                                                 </div>
                                             </div>
                                             <div class="pull-right">
                                                 <button class="btn btn-success btn-link btn-fab btn-fab-mini btn-round pull-right add-to-shoppingcart" product-id="<?=$row['StockItemID'];?>" title="" data-placement="left" data-original-title="Toevoegen aan winkelmand">
                                                     <i class="material-icons">add_shopping_cart</i>
                                                 </button>
                                                 <button class="btn btn-rose btn-link btn-fab btn-fab-mini btn-round pull-right" rel="tooltip" title="" data-placement="left" data-original-title="Remove from wishlist">
                                                     <i class="material-icons">favorite_border</i>
                                                 </button>
                                             </div>
										</div>
									 </div> <!-- end card -->
								  </div>
								
								<?php
								echo "<br>";
								}
						} else {
							echo "<h2>0 results</h2>";
						}
					?>
					</div>
				</div>
			</div>
		</div>
		<?php require_once('utils/snippets/footer.php');?>
		<script src="<?=Text::URL;?>/assets/js/add-to-cart.js" type="text/javascript"></script>
	</body>
</html>