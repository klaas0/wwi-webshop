<?php
// hier updaten we de cart, hiervoor hebben we nodig of het gaat om een verandering, een toevoeging of een product dat verwijderd moet worden
require('../utils/framework.php');
function reviewProcess() {

    $reviewTitle = filter_input(INPUT_POST, "reviewTitle", FILTER_SANITIZE_STRING);
    $reviewRating = filter_input(INPUT_POST, "reviewRating", FILTER_VALIDATE_INT, array("options" => array("min-range"=>1,"max_range"=>10)));//if !empty check
    $reviewDescription = filter_input(INPUT_POST, "reviewDescription", FILTER_SANITIZE_STRING);
    $type = filter_input(INPUT_POST, "type", FILTER_SANITIZE_STRING);
    $productID = filter_input(INPUT_POST, "reviewItemID", FILTER_VALIDATE_INT);
    
    if ($type == "add") {
        if ($productID == NULL || $productID == FALSE){
            return Utils::jsonReturn(TRUE, "Product ID is niet correct. (Error 00)");
        }
        if ($reviewTitle == NULL) {
            return Utils::jsonReturn(TRUE, "Titel mag niet leeg zijn. (Error 01)");
        }
        if (!$reviewRating){
            return Utils::jsonReturn(TRUE, "Rating is niet correct. (Error 02)");
        }
        if ($reviewDescription == NULL){
            return Utils::jsonReturn(TRUE, "Review beschijving mag niet leeg zijn. (Error 03)");
        }
        try {
            $product = new Product($productID);
        } catch (Exception $e) {
            return Utils::jsonReturn(TRUE, $e->getMessage());
        }
        $product->setReview($reviewTitle, $reviewDescription, $reviewRating);
        return Utils::jsonReturn(FALSE, "Review is succesvol toegevoegd.");
    } 
}

echo reviewProcess();