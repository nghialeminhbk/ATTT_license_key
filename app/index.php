<!DOCTYPE html>
<html>
<head>
 <title>Index Page</title>
</head>
<body>
 <?php
 $secret_code = 'nghiatitan'; // ma bi mat xac dinh cho moi
 $time_created = '2021-07-12 11:41:52';
 $username = 'username'; // username cua nguoi do
 $password = 'password'; // password nguoi do da dang ki

function decrypt($ivHashCiphertext, $password) {
    $method = "AES-256-CBC";
    $iv = substr($ivHashCiphertext, 0, 16);
    $hash = substr($ivHashCiphertext, 16, 32);
    $ciphertext = substr($ivHashCiphertext, 48);
    $key = hash('sha256', $password, true);

    if (!hash_equals(hash_hmac('sha256', $ciphertext . $iv, $key, true), $hash)) return null;

    return openssl_decrypt($ciphertext, $method, $key, OPENSSL_RAW_DATA, $iv);
}
 $license_hash_compare = sha1($username.$password.$time_created.$secret_code);

 $lisfile = $username.sha1($password).'.key';

// kiem tra file ton tai
 if(!file_exists(__DIR__.'/'.$lisfile))
 {
    header('Location: activator.html');
 }else{
    $data = file_get_contents(__DIR__.'/'.$lisfile);
    $license_hash = decrypt($data, $secret_code);
    if($license_hash != $license_hash_compare){
        header('Location: activator.html');
    }
 }
 ?>

 <h1>Welcome to web application</h1>
 <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
 tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
 quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
 consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
 cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
 proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
</body>
</html>