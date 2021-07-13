<?php 
$secret_key = 'nghiatitan'; 
$time_created = '2021-07-12 11:41:52'; // dinh dang ngay ...
$nama = trim($_GET['nama']); 
$password = trim($_GET['password']); 


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

if(!isset($_GET['nama']) OR !isset($_GET['nama'])) 
{ 
    $licensi = 'error'; 
}
else 
{ 
if($nama == 'username') 
{ 
       if($password == 'password') 
       { 
           $as = true; 
       }else{ 
           $as = false; 
       } 
}
else
{ 
   $as = false; 
} 
if($as == true) 
{ 
    $licensi_hash = sha1($nama.$password.$time_created.$secret_key); 
    $licensi = encrypt($licensi_hash, $secret_key);
}
else 
{ 
    $licensi = 'error'; 
} 
} 
echo $licensi;
?>
