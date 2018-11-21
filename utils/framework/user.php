<?php
/**
 * Created by PhpStorm.
 * User: sebastiaandirks
 * Date: 19/11/2018
 * Time: 10:45
 */
class User {
    private $id;

    protected $connection;

    public function __construct() {
        global $connection;
        $this->connection =& $connection;

        if (isset($_SESSION['wwi-user'])) {

        } else {

        }


    }

    public function login($email, $password) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            return false;
        }
        $passwordHash = hash("sha256", $password);
        $stmt = $this->connection->prepare("SELECT PersonID, FullName, PreferredName, SearchName, LogonName, IsExternalLogonProvider, HashedPassword, IsSystemUser, IsEmployee, IsSalesperson, UserPreferences, PhoneNumber, FaxNumber, EmailAddress, Photo, CustomFields, OtherLanguages, LastEditedBy, ValidFrom, ValidTo FROM people WHERE HashedPassword = ? AND IsPermittedToLogon = 1;");
        $stmt->bind_param('s', $passwordHash);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows <= 0) {
            $stmt->close();
            return false;
        }

        $stmt->bind_result($this->id, $this->fullName, $this->preferredName, $this->searchName, $this->logonName, $this->isSystemUser, $this->isEmployee, $this->isSalesperson, $this->userPreferences, $this->phoneNumber, $this->faxNumber, $this->emailAddress, $this->photo, $this->customFields, $this->otherLanguages, $this->lastEditedBy, $this->validFrom, $this->validTo);
        $stmt->fetch();
        $stmt->close();

        $this->setUserVar('id', $this->id);
        $this->setUserVar('fullName', $this->fullName);
        $this->setUserVar('prefferedName', $this->prefferedName);
        $this->setUserVar('searchName', $this->searchName);
        $this->setUserVar('username', $this->logonName);
        $this->setUserVar('isSystemUser', $this->isSystemUser);
        $this->setUserVar('isEmployee', $this->isEmployee);
        $this->setUserVar('isSalesperson', $this->isSalesperson);
        $this->setUserVar('userPreferences', $this->userPreferences);
        $this->setUserVar('emailAddress', $this->emailAddress);
        $this->setUserVar('phoneNumber', $this->phoneNumber);
        return true;
    }

    public function logout() {
        if (!isset($_SESSION['wwi-user'])) {
            return false;
        }
        unset($_SESSION['wwi-user']);
        return true;
    }

    public function register($fullName, $email, $password, $phone) {
        if (!preg_match("/^[a-zA-Z ]*$/", $fullName) || strlen($fullName) > 100) {
            return [false, "Naam mag alleen letters en spaties bevatten."];
        }
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            return [false, "Email adres klopt niet!"];
        }

    }

    private function setUserVar($name, $data) {
        $_SESSION['wwi-user'][$name] = $data;
    }

    private function getUserVar($name) {
        return $_SESSION['wwi-user'][$name];
    }
}