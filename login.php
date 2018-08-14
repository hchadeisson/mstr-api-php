<?php 

function rest_login($username, $password, $loginmode)
{
	$ch = curl_init();
	
	curl_setopt($ch, CURLOPT_URL, "https://tutorial.microstrategy.com/MicroStrategyLibrary/api/auth/login");
	curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"username\": \"$username\",\"password\": \"$password\",\"loginMode\": $loginmode}");
	curl_setopt($ch, CURLOPT_HEADER, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	
	$headers = array();
	$headers[] = "Content-Type: application/json";
	$headers[] = "Accept: application/json";
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	
	$result = curl_exec($ch);
	if (curl_errno($ch)) {
		echo 'Error:' . curl_error($ch);
	}
	
	curl_close ($ch);
	
	/* print_r($result); */
	
	$headers = explode("\r\n",$result);
	$cookie1 = explode(":",$headers[7])[1];
	$cookie2 = explode(":",$headers[3])[1];
	$session = trim(explode(":",$headers[8])[1]);

	$authentication[0] = trim($session);
	$authentication[1] = trim($cookie1);
	$authentication[2] = trim($cookie2);
	
    return $authentication;
}
$authentication = rest_login();
echo '

';
print_r($authentication);

?>