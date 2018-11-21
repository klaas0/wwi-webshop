<?php
require('utils/framework.php');
try {
	$product = new Product($_GET['id']);
} catch (Exception $e) {
	echo $e->getMessage();
	die();
 
}

$reviews = $product->getReviews();

// Functie voor het ophalen van Tags bij de bijbehorende producten
function tags(){
	global $product;
	foreach ($product->getTags() as $value){
		echo '<span class="badge badge-primary mr-1">'.$value.'</span>';
	}
 
}
// Functie voor het berekenen van de korting
function discount(){
	global $product;
	return round(($product->recommendedRetailPrice - $product->getPrice(true,false)) / $product->recommendedRetailPrice * 100, 1);
}

function aantalBezoekers(){
	return rand(20,100);
}

// Pop up voor het review systeem
if($_POST){
	if (empty($_POST['title'])){

	}
	$reviewTitle = $_POST['title'];
	$reviewRating = $_POST['rating'];
	$reviewMessage = $_POST['message'];

	if($product->setReview($reviewTitle, $reviewMessage, $reviewRating)){
		echo "<div class='alert alert-success'>Product was created.</div>";
	} else {
		echo "<div class='alert alert-danger'>Unable to create product.</div>";
	}
}

$cookie_value = 0;
$cookie_name = "bezoekers";
if(!isset($_COOKIE[$cookie_name])){
	$cookie_value = " nog niet ";
} else {
	$cookie_value = intval($_COOKIE[$cookie_name]) +1;
	$cookie_keer = $cookie_value . " keer";
}
setcookie($cookie_name, $cookie_value, time() + (86400), "/");

?>
<html>
	<head>
		<?php require_once('utils/snippets/header.php');?>
	</head>
	<body class="product-page">
		<?php require_once('utils/snippets/navbar.php'); ?>
		<div class="page-header header-filter" data-parallax="true" filter-color="rose" style="background-image: url('<?=Text::URL;?>/assets/images/bg1.jpg'); background-position: center; transform: translate3d(0px, 0px, 0px);">
			<div class="container">
				<div class="row title-row">
					
				</div>
			</div>
		</div>
		<div class="section section-gray">
			<div class="container">
				<div class="main main-raised main-product">
					<div class="row">
						<div class="col-md-4 col-12 align-items-stretch d-flex">
							<div class="card card-product card-plain no-shadow" data-colored-shadow="false">
								<div class="card-header card-header-image" style="position: relative;">
									<span class="badge badge-success d-inline-block text-right mb-0" style="position: absolute;"><h6><strong><?=discount();?></strong>% goedkoper </h6></span>
									<img src="https://en.meming.world/images/en/thumb/2/2c/Surprised_Pikachu_HD.jpg/300px-Surprised_Pikachu_HD.jpg" alt="...">
									
								</div>
							</div>
						</div>
						<!--In deze div wordt alle product informatie weergeven-->
						<div class="col-md-8 col-12">
							<h2 class="title"><?=$product->name;?></h2>
							<div class="">
								<h3 class="main-price d-inline-block mb-0"><?=$product->getPrice(true, true);?> </h3> <h5 class="d-inline-block mb-0"><strike class="text-danger"><?=utils::moneystring($product->recommendedRetailPrice);?></strike></h5><br>
								<h5 class="d-inline-block">Dit product is vandaag <?=$cookie_keer;?> bekeken.</h5> <h6 class="text-primary d-inline-block">Wees dus snel en bestel!</h6>
							</div>
  							<h4 class="text-success col-md-7"></h4>
							<div id="accordion" role="tablist">
								<div class="card card-collapse">
									<div class="card-header" role="tab" id="headingOne">
										<h4 class="mb-0">
											<a data-toggle="collapse" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="collapsed">
												Beschrijving
												<i class="material-icons">keyboard_arrow_down</i>
											</a>
										</h4>
									</div>
									<div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion" style="">
						  				<div class="card-body">
											<p><?=$product->searchDetails;?></p>
						  				</div>
									</div>									
								</div>
								<div class="card card-collapse">
									<div class="card-header" role="tab" id="headingOne">
										<h4 class="mb-0">
											<a data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseOne" class="collapsed">
												Tags
												<i class="material-icons">keyboard_arrow_down</i>
											</a>
										</h4>
									</div>
									<div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion" style="">
						  				<div class="card-body">
											<?=tags();?>
						  				</div>
									</div>									
								</div>
								<div class="mb-5"></div>
							</div>
							<?php
							$hasProduct = $cart->hasProduct($product->id);
							if($hasProduct){ ?>
								 <h6 class="text-warning">Het product bevind zich al in uw winkelmandje</h6>
							<?php }
							else{ ?>
								<div class="float-right row" id="add-to-cart">
								<div class="form-group col-md-3 pt-3 text-right">Aantal:</div>
								<div class="form-group col-md-3 pt-2"><input class="form-control product-amount" type="number" value="1" min="1"></div>
								<div class="form-group col-md-6"><button class="btn btn-success float-right add-to-shoppingcart" id="buy_button" product-id="<?=$product->id;?>">Add to Cart <i class="material-icons">add_shopping_cart</i></button></div>
							</div>
							<?php }	?>
						</div>
					</div>
				</div>
			<div class="section section-blog">
                    <div class="container" id="reviewcontainer">
                    	<div class="row">
                    		<div class="col-xs-6">
                    			<h2 class="section-title">Reviews</h2>
                    		</div>
                    		<div class="col-xs-6 ml-auto">
								<button class="btn btn-info" data-toggle="modal" data-target="#reviewModal">Laat een review achter.</button>
                    		</div>
                    	</div>
                        <div class="row">
                            <div class="col-12 card">
								<?php
								if(!empty($reviews)) {
								foreach ($reviews as $review) {
								?>
								<div class="card-body">
									<h4 class="card-title"><?=$review['Title'];?></h4>
									<h6 class="card-subtitle"><?=$review['Rating'];?></h6>
									<p class="card-text"><?=$review['Description'];?></p>
								</div><hr>
								<?php
								} ?>
								</div>
								<?php
								} else {
									echo "<div class=\"card-body\">
												<h4 class=\"card-title\">Er zijn nog geen reviews voor dit product!</h4>
											</div>";
								}
								?>
                        </div>
                    </div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="reviewModal" tabindex="-1" role="dialog">
			<div class="modal-dialog modal-signup" role="document">
				<div class="modal-content">
					<div class="card card-signup card-plain">
						<div class="modal-header">
							<h5 class="modal-title card-title">Review</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<i class="material-icons">clear</i>
							</button>
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="col-md-12 ml-auto">
										<div class="card-body">
											<div class="input-group">
												<div class="col-md-8">
													<label for="titelReview">Titel</label>
													<input name="title" type="text" id="reviewTitle" class="form-control">
												</div>
												<div class="col-md-4">
													<label for="ratingReview">Rating</label>
													<select name="rating" class="selectpicker" data-style="btn btn-link" id="reviewRating">
														<option value="10">10</option>
														<option value="9">9</option>
														<option value="8">8</option>
														<option value="7">7</option>
														<option value="6">6</option>
														<option value="5">5</option>
														<option value="4">4</option>
														<option value="3">3</option>
														<option value="2">2</option>
														<option value="1">1</option>

													</select>
												</div>
											</div>
												<div class="input-group">
													<div class="col-md-12">
													<label for="messageReview">Bericht</label>
													<textarea name="message" rows="5" id="reviewMessage" class="form-control"></textarea>
													</div>
												</div>
										</div>
										<input type="hidden" value="<?=$_GET['id']?>" id="reviewItemID">
										<div class="modal-footer justify-content-center">
											<button type="submit" id="reviewSubmit" class="btn btn-primary btn-round">Verstuur review</button>
										</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php require_once('utils/snippets/footer.php');?>
		<script src="<?=Text::URL;?>/assets/js/add-to-cart.js" type="text/javascript"></script>
		<script src="<?=Text::URL;?>/assets/js/add-review.js" type="text/javascript"></script>
	</body>
</html>