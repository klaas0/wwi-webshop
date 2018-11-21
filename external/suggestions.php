<?php
$sql = "SELECT * FROM stockitems ORDER BY rand() LIMIT 4;";
$result = $connection->query($sql);
?>

Het lijkt erop dat u geen producten in uw winkelmandje heeft. Misschien heeft u intresse in een van de volgende producten?
<div class="row">
<?php
while ($row = $result->fetch_assoc()) { ?>
    <div class="col-md-3 align-items-stretch d-inline-block">
        <div class="card card-product card-plain no-shadow" data-colored-shadow="false">
            <div class="card-header card-header-image">
                <a href="<?= Text::URL; ?>/product/<?= $row['StockItemID'] ?>/">
                    <img src="<?= Text::URL; ?>/assets/images/placeholder.png" alt="...">
                </a>
            </div>
            <div class="card-body">
                <a href="<?= Text::URL; ?>/product/<?= $row['StockItemID'] ?>/">
                    <h4 class="card-title"><?= $row['StockItemName']; ?></h4>
                    <p class="description"><?php echo strlen($row['SearchDetails']) > 50 ? substr($row['SearchDetails'], 0, 50) . "..." : $row['SearchDetails']; ?>                                             </p>
                </a>
            </div>
            <div class="card-footer justify-content-between">
                <div class="pull-left">
                    <div class="price-container">
                        <span class="price"><?= Utils::moneyString($row['UnitPrice']); ?></span>
                    </div>
                </div>
            </div>
        </div> <!-- end card -->
    </div>
    <?php } ?>
</div>
