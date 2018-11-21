<?php
require ('../utils/framework.php');

$productQuery = $connection->query("SELECT * FROM people LIMIT 0,5");

if ($productQuery->num_rows > 0) {
    while($row = $productQuery->fetch_assoc()) {
        echo "id: " . $row["PersonID"]. " - Name: " . $row["FullName"] . "<br>";
    }
} else {
    echo "0 results";
}
		
		print('<br><br><br><br>');
		
$product = new Product(1);
echo $product->name . ": " . $product->getPrice(true, true) . "";

$_SESSION['cart'] = array ("0" => "appel", "1" => "peer");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Fokke</title>
	<?php require_once('../utils/snippets/header.php'); ?>
</head>
<body>
	<div class="row col-md-12 text-center">
  <div class="col-md-4">.col-md-4</div>
  <div class="col-md-4">.col-md-4</div>
  <div class="col-md-4">.col-md-4</div>
  </div>
  <?php require_once('../utils/snippets/footer.php');?>
</body>
</html>
<?php $connection->close(); ?>