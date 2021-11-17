<?php


$key = "eFHeazOT0whwbxkDULAi"; // your api key
$postdata = "key=$key&service=pulsa";


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://ilhpedia.xyz/api_service.php");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$chresult = curl_exec($ch);
curl_close($ch);
$json_result = json_decode($chresult, true);
print_r($json_result);



/* Api Sosmed
$key = "eFHeazOT0whwbxkDULAi"; // your api key
$postdata = "key=$key&action=add&service=224&link=amir.ofc01&quantity=100";


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://ilhpedia.xyz/api.php");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$chresult = curl_exec($ch);
curl_close($ch);
$json_result = json_decode($chresult, true);
echo $chresult;
*/


/* API PULSA
$key = "APIKEY ANDA"; // your api key
$postdata = "key=$key&action=add&service=$post_service&phone=$post_phone";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://ilhpedia.xyz/api_pulsa.php");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$chresult = curl_exec($ch);
curl_close($ch);
$json_result = json_decode($chresult, true);
*/


exit;
session_start();
$_SESSION['user']['username'] = 'ilhampedia';
print_r($_SESSION);