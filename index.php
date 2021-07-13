<?php
// if(strtoupper(PHP_OS) == strtoupper("LINUX"))
// {
// 	$ds=shell_exec('udevadm info --query=all --name=/dev/sda | grep ID_SERIAL_SHORT');
// 	$serialx = explode("=", $ds);
// 	$serial = $serialx[1];
// }
// else
// {
// 	function encrypt($plaintext, $password) {
// 		$method = "AES-256-CBC";
// 		$key = hash('sha256', $password, true);
// 		$iv = openssl_random_pseudo_bytes(16);
	
// 		$ciphertext = openssl_encrypt($plaintext, $method, $key, OPENSSL_RAW_DATA, $iv);
// 		$hash = hash_hmac('sha256', $ciphertext . $iv, $key, true);
	
// 		return $iv . $hash . $ciphertext;
// 	}
	
// 	function GetVolumeLabel($drive) {
// 		if (preg_match('#Volume Serial Number is (.*)\n#i', shell_exec('dir '.$drive.':'), $m)) {
// 		$volname = ' ('.$m[1].')'; } else { $volname = ''; }
// 		return $volname;
// 	}
// 	$serial = str_replace("(","",str_replace(")","",GetVolumeLabel("c")));
//     echo $serial;
// }
// function getIPAddress() {  
//     //whether ip is from the share internet  
//      if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
//                 $ip = $_SERVER['HTTP_CLIENT_IP'];  
//         }  
//     //whether ip is from the proxy  
//     elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
//                 $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
//      }  
// //whether ip is from the remote address  
//     else{  
//             $ip = $_SERVER['REMOTE_ADDR'];  
//      }  
//      return $ip;  
// }  
// $ip = getIPAddress();  
// echo 'User Real IP Address - '.$ip;  

function encrypt($plaintext, $password) {
    $method = "AES-256-CBC";
    $key = hash('sha256', $password, true);
    $iv = openssl_random_pseudo_bytes(16);

    $ciphertext = openssl_encrypt($plaintext, $method, $key, OPENSSL_RAW_DATA, $iv);
    $hash = hash_hmac('sha256', $ciphertext . $iv, $key, true);

    return $iv . $hash . $ciphertext;
}

function decrypt($ivHashCiphertext, $password) {
    $method = "AES-256-CBC";
    $iv = substr($ivHashCiphertext, 0, 16);
    $hash = substr($ivHashCiphertext, 16, 32);
    $ciphertext = substr($ivHashCiphertext, 48);
    $key = hash('sha256', $password, true);

    if (!hash_equals(hash_hmac('sha256', $ciphertext . $iv, $key, true), $hash)) return null;

    return openssl_decrypt($ciphertext, $method, $key, OPENSSL_RAW_DATA, $iv);
}

$plaintext = "I love you so much";
$password = "nghiatitan";
$ciphertext = encrypt($plaintext, $password);
var_dump(file_get_contents("text.txt"));
?>

