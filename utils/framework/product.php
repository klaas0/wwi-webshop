<?php

/**
 * Class Product
 * Used to simplify product management
 *
 * @author Sebastiaan Dirks
 * @version 1.0
 */
class Product {
	public $id;
	public $reviewTitle;
    public $reviewRating;
    public $reviewMessage;
    
	protected $connection;

    /**
     * Product constructor.
     * Binds all the product variables from the database from the given product id.
     *
     * @param int $id
     * @throws Exception
     */
	public function __construct($id) {
		global $connection;
		if (!is_numeric($id)) {
		    throw new Exception("Invalid product! (Error 11)");
        }
		$this->connection =& $connection;
		$this->id = $id;
		
		$stmt = $this->connection->prepare("SELECT StockItemName, SupplierID, ColorID, UnitPackageID, OuterPackageID, Brand, Size, LeadTimeDays, QuantityPerOuter, IsChillerStock, Barcode, TaxRate, UnitPrice, RecommendedRetailPrice, TypicalWeightPerUnit, MarketingComments, InternalComments, Photo, Tags, SearchDetails, LastEditedBy, ValidFrom, ValidTo FROM stockitems WHERE StockItemID = ?;");
		$stmt->bind_param('i', $id);
		$stmt->execute();
		$stmt->store_result();
		if ($stmt->num_rows <= 0) {
			$stmt->close();
			throw new Exception("Item not found! (Error 12)");
		}
		
		$stmt->bind_result($this->name, $this->supplierId, $this->colorId, $this->unitPackageId, $this->outerPackageId, $this->brand, $this->size, $this->leadTimeDays, $this->quantityPerOuter, $this->isChillerStock, $this->barcode, $this->taxRate, $this->unitPrice, $this->recommendedRetailPrice, $this->typicalWeightPerUnit, $this->marketingComments, $this->internalComments, $this->photo, $this->tags, $this->searchDetails, $this->lastEditedBy, $this->validFrom, $this->validTo);
		$stmt->fetch();
		$stmt->close();
	}

    /**
     * Static method to return this product class by id.
     *
     * @param int $id
     * @return Product
     * @throws Exception
     */
	public static function getProduct($id) {
		return new Product($id);
	}

    /**
     * Return the price of the current product, formatted or as number.
     *
     * @param bool $withTax
     * @param bool $formated
     * @return int|string
     */
	public function getPrice($withTax = true, $formated = false) {
		$mon = ($withTax ? $this->unitPrice * ((100 - $this->taxRate)/100) : $this->unitPrice);
		return ($formated ? Utils::moneyString($mon) : $mon);
	}

    /**
     * Return the tags of the product as an array
     *
     * @return array
     */
	public function getTags() {
		return json_decode($this->tags, true);
	}

    /**
     * Get reviews from this product
     *
     * @return array
     */
	public function getReviews() {
        $sql = "SELECT * FROM reviews WHERE StockItemID = $this->id";
        $result = $this->connection->query($sql);
        $numRows = $result->num_rows;
        $data = array();
        if($numRows > 0){
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }
        }
        return $data;
    }

    /**
     * Push a review to the server
     *
     * @param String $reviewTitle
     * @param String $reviewMessage
     * @param int $reviewRating
     * @return bool
     */
    public function setReview($reviewTitle, $reviewDescription, $reviewRating) {
        $stmt = $this->connection->prepare("INSERT INTO reviews (Title,Description,Rating,Date,StockItemID)VALUES(?,?,?,?,?)");
        $reviewTitle = htmlspecialchars(strip_tags($reviewTitle));
        $reviewDescription = htmlspecialchars(strip_tags($reviewDescription));
        $reviewRating = htmlspecialchars(strip_tags($reviewRating));
        $date = date("Y-m-d H:i:s");

        $stmt->bind_param("ssisi",$reviewTitle,$reviewDescription, $reviewRating, $date, $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}