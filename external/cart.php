<?php
// hier updaten we de cart, hiervoor hebben we nodig of het gaat om een verandering, een toevoeging of een product dat verwijderd moet worden
require('../utils/framework.php');
function process() {
    global $cart;
    $productString = filter_input(INPUT_POST, "productString", FILTER_SANITIZE_STRING);
    $product = filter_input(INPUT_POST, "productId", FILTER_SANITIZE_STRING);
    $quantity = filter_input(INPUT_POST, "quantity", FILTER_SANITIZE_STRING);//if !empty check
    $type = filter_input(INPUT_POST, "type", FILTER_SANITIZE_STRING);

    if ($type == "add") {
        if ($product == NULL || ($quantity == NULL && $quantity <= 0)) {
            return Utils::jsonReturn(TRUE, "Het product kan niet worden toegevoegd. (Error 01)");
        }
        if (!is_numeric($product) || !is_numeric($quantity)) {
            return Utils::jsonReturn(TRUE, "Het product kan niet gevonden worden. (Error 02)");
        }
        try {
            new Product($product);
        } catch (Exception $e) {
            return Utils::jsonReturn(TRUE, $e->getMessage());
        }
        $cart->addProduct($product, $quantity);
        $cart->saveData();
        return Utils::jsonReturn(FALSE, "Het product is toegevoed aan uw winkelwagen.");
    } else if ($type == "edit") {
        $encounteredError = FALSE;
        if ($productString == NULL) {
            return Utils::jsonReturn(TRUE, "De producten konden niet gewijzigd worden. (Error 03)");
        }
        $array = Utils::stringToArray($productString);
        if ($array == NULL) {
            return Utils::jsonReturn(TRUE, "Er is een onverwachtte fout opgetreden. (Error 04)");
        }
        foreach ($array as $productId => $amount) {
            if (!is_numeric($productId) || !is_numeric($amount)) {
                $encounteredError = TRUE;
                continue;
            }
            if (!$cart->editProduct($productId, $amount)) {
                $encounteredError = TRUE;
                continue;
            }
        }
        if ($cart->saveData() && !$encounteredError) {
            return Utils::jsonReturn(FALSE, "De producten zijn succesvol gewijzigd.");
        }
        return Utils::jsonReturn(TRUE, "De producten konden niet gewijzigd worden. (Error 05)");
    } else if ($type == "delete") {
        if ($product == NULL) {
            return Utils::jsonReturn(TRUE, "Het product kan niet worden verwijderd. (Error 06)");
        }
        if (!$cart->removeProduct($product, -1)) {
            return Utils::jsonReturn(TRUE, "Het product zit niet in uw winkelmandje. (Error 07)");
        }
        $cart->saveData();
        return Utils::jsonReturn(FALSE, "Het product is verwijderd uit uw winkelmandje.", Utils::encryptString("external/suggestions.php"));
    }
}

echo process();