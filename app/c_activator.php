<?php
if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) )
{	
	$method=$_POST['method'];
	if($method == 'online')
	{
		$nama=$_POST['nama'];
		$password=$_POST['password'];
		$url=$_POST['url'];
			function getIPAddress() {  
				//whether ip is from the share internet  
				if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
							$ip = $_SERVER['HTTP_CLIENT_IP'];  
					}  
				//whether ip is from the proxy  
				elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
							$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
				}  
			//whether ip is from the remote address  
				else{  
						$ip = $_SERVER['REMOTE_ADDR'];  
				}  
				return $ip;  
			} 
			$ip = getIPAddress();
		$ch = curl_init();  

		curl_setopt($ch,CURLOPT_URL,$url.'/index.php?nama='.$nama.'&password='.$password.'&ip='.$ip);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		$output=curl_exec($ch);
		curl_close($ch);
		$array= array();
		if(!$output)
		{
			$array['value'] = false;

		}else
		{
			$content=$output;
			$fileName = sha1($nama.$password).'.key';
			$fp = fopen($fileName,"wb");
			fwrite($fp,$content);
			fclose($fp);
			$array['value'] = true;
		}
		echo json_encode($array);
	}
	

} else {
	exit('No direct access allowed.');
}