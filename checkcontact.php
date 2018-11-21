<?php

// define variables and set to empty values
$naam_error = $email_error = $onderwerp_error = $bericht_error =  "";
$naam = $email = $bericht = $success = $onderwerp = $telefoon = "";
$telefoon_error = NULL;

//form is submitted with POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["naam"])) {
        $naam_error = "Naam moet ingevuld worden.";
    } else {
        $naam = test_input($_POST["naam"]);
        // check if naam only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/",$naam)) {
            $naam_error = "Alleen letters en spaties toegestaan.";
        }
        //checks if naam is within our terms
        $num_lengthNaam = strlen((string)$naam);
        if($num_lengthNaam>50){
            $naam_error = "Naam bevat teveel tekens.";
        }
    }
    if (empty($_POST["email"])) {
        $email_error = "Email moet ingevuld worden.";
    } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_error = "E-mail adres is niet correct.";
        }
        //checks if email is within our terms
        $num_lengthEmail = strlen((string)$email);
        if($num_lengthEmail>50){
            $email_error = "E-mail adres bevat teveel tekens.";
        }
    }
    if (empty($_POST["telefoon"])) {
        $telefoon_error = NULL;
    } else {
        $telefoon = test_input($_POST["telefoon"]);
        //check is telefoon is within our terms
        $num_length= strlen((string)$telefoon);
        if(!is_numeric($telefoon) || $telefoon <0600000000 || !$num_length==10){
            $telefoon_error= "Telefoon is niet correct.";
        }
    }

    if(empty($_POST["onderwerp"])){
        $onderwerp_error = "Onderwerp moet ingevuld worden.";
    } else {
        $onderwerp = test_input($_POST["onderwerp"]);
        //checks if onderwerp is within our terms
        $num_lengthOnderwerp = strlen((string)$onderwerp);
        if($num_lengthOnderwerp>100){
            $onderwerp_error = "Onderwerp bevat teveel tekens.";
        }
    }

    if (empty($_POST["bericht"])) {
        $bericht_error = "Bericht moet ingevuld worden.";
    } else {
        $bericht = test_input($_POST["bericht"]);
        //checks if bericht is within our terms
        $num_lengthBericht = strlen((string)$bericht);
        if($num_lengthBericht>2500){
            $bericht_error = "Bericht bevat teveel tekens.";
        }
    }

    if ($naam_error == '' and $email_error == '' and $bericht_error == '' and $onderwerp_error == '' and $telefoon_error == NULL ){
            $success = "Bericht is verstuurd, Wij proberen zo spoedig mogelijk te reageren!";
            
            //send input to database
            // $statement = $connection->prepare("INSERT INTO contact_messages(SenderName, SenderEmail, Subject, Message, SenderPhone) VALUES (?,?,?,?,?)");
            // $statement->bind_param("sssss", $naam, $email, $onderwerp, $bericht, $telefoon);
            // $statement->execute();
            // $statement->close();
            
            $naam = $email = $telefoon = $bericht = $onderwerp = "";

    }

}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}