<?php
class Utils {

    public static $private_key = "37sdb37dqgf8dscn32nj934";

    /**
     * Convert an array to a string
     *
     * @param Array $array
     * @param bool $values
     * @return string
     */
	public static function arrayToString($array, $values = true) {
		$str = "";
		foreach ($array as $key => $value) {
			$str .= "$key" . (isset($value) && $values ? ":$value" : "") . ",";
		}
		return rtrim($str, ',');
	}

    /**
     * Convert a string to an array.
     *
     * @param String $str
     * @return array|null
     */
	public static function stringToArray($str) {
		if (preg_match('/[^A-Za-z0-9,:]/', $str)) {
			return null;
		}
		$array = array();
		foreach (explode(",", $str) as $arr) {
			if (strpos($arr, ":") !== false) {
				$arr = explode(":", $arr);
				$array[$arr[0]] = $arr[1];
			} else {
				$array[] = $arr;
			}
		}
		return $array;
	}

    /**
     * Save a cookie to the client.
     *
     * @param String $name
     * @param String $data
     * @return bool
     */
	public static function saveCookie($name, $data) {
		$_COOKIE[$name] = $data;
		return setcookie($name, $data, time() + (86400 * 30), "/");
	}

    /**
     * Return the value of a cookie if it exists.
     *
     * @param String $name
     * @return String|null
     */
	public static function getCookie($name) {
		return isset($_COOKIE[$name]) ? $_COOKIE[$name] : null;
	}

    /**
     * Delete a cookie.
     *
     * @param String $name
     * @return bool
     */
	public static function deleteCookie($name) {
		unset($_COOKIE[$name]);
		return setcookie($name, null, -1, '/');
	}

    /**
     * Convert money to a readable string.
     *
     * @param $money
     * @return string
     */
	public static function moneyString($money) {
		return "€" . money_format("%.2n", $money);
	}

    /**
     * Return a json friendly string.
     *
     * @param boolean $error
     * @param String $message
     * @return false|string
     */
	public static function jsonReturn($error, $message, $encrypted = "") {
	    return json_encode(array("error" => $error, "message" => $message, "data" => $encrypted));
    }

    /**
     * Encrypt a string using the private key.
     *
     * @param String $str
     * @return string
     */
    public static function encryptString($str) {
        $key = Utils::$private_key;
        $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
        $iv = openssl_random_pseudo_bytes($ivlen);
        $enc = openssl_encrypt($str, "aes-256-ctr", $key, $options=OPENSSL_RAW_DATA, $iv);
        $hmac = hash_hmac('sha256', $enc, $key, $as_binary=true);
        $dat64 = base64_encode($iv.$hmac.$enc);
        return $dat64;
    }

    /**
     * Decrypt a string using the private key.
     *
     * @param String $str
     * @return null|string
     */
    public static function decryptString($str) {
	    $key = Utils::$private_key;
        $c = base64_decode($str);
        $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
        $iv = substr($c, 0, $ivlen);
        $hmac = substr($c, $ivlen, $sha2len=32);
        $ciphertext_raw = substr($c, $ivlen+$sha2len);
        $calcmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
        if (!hash_equals($hmac, $calcmac)) {
            return null;
        }
        $dec = openssl_decrypt($ciphertext_raw, "aes-256-ctr", $key, $options=OPENSSL_RAW_DATA, $iv);
        return $dec;
    }
}

class Text {
	const TITLE = "WWI Webshop";
	const DESC = "Chocoladerepen in overvloed";
	const URL = "https://wwi-webshop.fifarenderz.com";
	
	const CARTNAME = "wwi-cart";
}