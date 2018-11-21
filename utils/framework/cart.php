<?php

/**
 * Class Cart
 * Used to manage someones cart
 *
 * @author Sebastiaan Dirks
 * @version 1.0
 */
class Cart {
	private $productIds;

    /**
     * Cart constructor.
     */
	public function __construct() {
		$this->productIds = array();
	}

    /**
     * Load a users cart data from a string stored in cookies.
     *
     * @param String $data
     * @return array|bool|null
     */
	public function loadData($data) {
		if ($data == null) {
			return false;
		}
		return $this->productIds = Utils::stringToArray($data);
	}

    /**
     * Add a product to a users cart.
     *
     * @param int $id
     * @param int $quantity
     * @return int
     */
	public function addProduct($id, $quantity = 1) {
		return $this->productIds[$id] = (isset($this->productIds[$id]) ? $this->productIds[$id] + $quantity : $quantity);
	}

    /**
     * Remove a product from someones cart. A quantity of -1 will remove the whole product from the cart.
     *
     * @param int $id
     * @param int $quantity
     * @return bool|int|mixed
     */
	public function removeProduct($id, $quantity = 1) {
		if (!isset($this->productIds[$id])) {
			return false;
		}
		if ($quantity == -1 || $quantity >= $this->productIds[$id]) {
			unset($this->productIds[$id]);
			return true;
		}
		return $this->productIds[$id] = $this->productIds[$id] - $quantity;
	}

    /**
     * Edit a product and set the new values.
     *
     * @param int $id
     * @param int $quantity
     * @return bool|int
     */
	public function editProduct($id, $quantity = 1) {
        if (!isset($this->productIds[$id])) {
            return false;
        }
        if ($quantity < 1) {
            return false;
        }
        return $this->productIds[$id] = $quantity;
    }

    /**
     * Check if a cart contains a product with $id
     *
     * @param int $id
     * @return bool
     */
	public function hasProduct($id) {
		return isset($this->productIds[$id]);
	}

    /**
     * Return all products in the cart
     *
     * @return array
     */
	public function getProducts() {
		return $this->productIds;
	}

    /**
     * Return the amount of products in the cart
     *
     * @return int
     */
	public function getProductCount() {
		return count($this->getProducts());
	}

    /**
     * Save the data to the users cookies.
     *
     * @return bool
     */
	public function saveData() {
		$data = Utils::arrayToString($this->productIds);
		return Utils::saveCookie('wwi-cart', $data);
	}
}