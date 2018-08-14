<?php
include 'login.php';

function getCoverPage($authentication, $projectId, $dossierId)
{
	$session = $authentication[0];
	$cookie1 = $authentication[1];
	$cookie2 = $authentication[2];
	
	$ch = curl_init();
	
	curl_setopt($ch, CURLOPT_URL, "https://tutorial.microstrategy.com/MicroStrategyLibrary/api/objects/".$dossierId."?type=55");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
	
	
	$headers = array();
	$headers[] = "Accept: application/json";
	$headers[] = "X-Mstr-Authtoken: ".$session;
	$headers[] = "X-Mstr-Projectid: ".$projectId;
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_COOKIE, $cookie1.';'.$cookie2);
	
	$result = curl_exec($ch);
	if (curl_errno($ch)) {
		echo 'Error:' . curl_error($ch);
	}
	curl_close ($ch);
	
	$cover_page = (json_decode($result))->iconPath;
	return $cover_page;
}

?>