<?php
if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) )
{	
	$method=$_POST['method'];
	if($method == 'online')
	{
		$nama=$_POST['nama'];
		$password=$_POST['password'];
		$url=$_POST['url'];
		$ch = curl_init();  

		curl_setopt($ch,CURLOPT_URL,$url.'/index.php?nama='.$nama.'&password='.$password);
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
			$fileName = $nama.sha1($password).'.key';
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