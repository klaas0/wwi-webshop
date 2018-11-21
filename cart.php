<?php
require('utils/framework.php');

function getCartHtml() {
	global $connection, $cart, $noProducts;
	$returnStr = "<tbody>";
	$totalPrice = 0;
	$productsArray = $cart->getProducts();
	if ($productsArray == null) {
		return '';
	}
	$productsString = Utils::arrayToString($productsArray, false);
	$query = $connection->query("SELECT StockItemId, StockItemName, SupplierID, ColorID, UnitPackageID, OuterPackageID, Brand, Size, LeadTimeDays, QuantityPerOuter, IsChillerStock, Barcode, TaxRate, UnitPrice, RecommendedRetailPrice, TypicalWeightPerUnit, MarketingComments, InternalComments, Photo, Tags, SearchDetails, LastEditedBy, ValidFrom, ValidTo FROM stockitems WHERE StockItemId IN ($productsString)");
	if ($query->num_rows <= 0) {
		return '';
	}
	while ($row = $query->fetch_assoc()) {
		$price = $row['UnitPrice'];
		$productId = $row['StockItemId'];
		$amount = $productsArray[$productId];
		$totalPrice += ($amount * $price);
		$returnStr .= '<tr class="product-tr" product-id="'.$productId.'" product-unit-price="'.money_format("%.2n", $price).'" product-amount="'.$amount.'">
            			    <td>
                  				<div class="img-container">
                   					<img src="' . Text::URL . '/assets/images/placeholder.png">
                  				</div>
                			</td>
                			<td class="td-name">
                  				<a href="' . Text::URL . '/product/' . $productId . '/">' . $row['StockItemName'] . '</a>
                			</td>
                			<td class="td-number text-right cart-product-unitprice">
                				' . Utils::moneyString($price) . '
                			</td>
                			<td class="td-number">
                			    <div class="row">
                				    <div class="col-md-4 offset-md-6 pr-0">
                					    <input type="number" class="form-control text-right cart-product-amount" product-id="' . $productId . '" value="' . $amount . '" min="1" max="999">
                				    </div>
                				</div>
                			</td>
                			<td class="td-number cart-product-totalprice">
	               				' . Utils::moneyString($price * $amount) . '
                			</td>
                			<td class="td-actions">
                  				<button type="button" rel="tooltip" data-placement="left" title="" class="btn btn-link cart-product-remove" product-id="' . $productId . '" data-original-title="Remove item">
                   					x
                  				</button>
                			</td>
                		</tr>';
	}

	$returnStr .= '<tr>
                <td></td>
                <td class="td-total">
                  Total
                </td>
                <td colspan="1" class="td-price">
                  '.Utils::moneyString($totalPrice).'
                </td>
                <td colspan="1">
                    <button type="button" class="btn btn-success btn-round float-right save-btn">Opslaan <i class="material-icons">save</i></button>
                </td>
                <td colspan="2" class="text-right">
                    <button type="button" class="btn btn-info btn-round checkout-btn">Afrekenen <i class="material-icons">keyboard_arrow_right</i></button>
                </td>
              </tr>';
	return $returnStr . "</tbody>";
}
?>
<html>
	<head>
		<?php require_once('utils/snippets/header.php');?>
	</head>
	<body class="profile-page">
		<?php require_once('utils/snippets/navbar.php'); ?>
		<div class="page-header header-filter" data-parallax="true" filter-color="rose" style="background-image: url('<?=Text::URL;?>/assets/images/bg1.jpg'); background-position: center;">
			<div class="container">
				<div class="row">
					<div class="col-md-8 ml-auto mr-auto text-center">
						<div class="brand">
							<h1 class="title">Uw winkelmand</h1>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="main main-raised">
			<div class="container">
				<div class="card card-plain">
					<div class="card-body">
						<h3 class="card-title mb-3">Winkelmandje</h3>
                        <div class="cart-table-div">
                        <?php if ($cart->getProductCount() == 0) {
                            include('external/suggestions.php');
                        } else { ?>
                            <div class="table-responsive">
                                <table class="table table-shopping">
                                    <thead>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th>Product</th>
                                        <th class="text-right">Prijs</th>
                                        <th class="text-right">Aantal</th>
                                        <th class="text-right">Totaal</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <?=getCartHtml();?>
                                </table>
                            </div>
                        <?php } ?>
                        </div>
					</div>
				</div>
			</div>
		</div>
		<?php require_once('utils/snippets/footer.php');?>
        <script src="<?=Text::URL;?>/assets/js/cart-page.js" type="text/javascript"></script>
	</body>
</html>