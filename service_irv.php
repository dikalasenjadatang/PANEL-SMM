<?php
require_once("mainconfig.php");
$key = "6d2e9c-2734fe-b7c4ad-bea748-e3ce87"; // your api key
$postdata = "api_id=3459&api_key=$key";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://irvankede-smm.co.id/api/services");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$chresult = curl_exec($ch);
echo $chresult;
curl_close($ch);
$json_result = json_decode($chresult, true);
$indeks=0;
while($indeks < count($json_result['data'])) {

$sid = $json_result['data'][$indeks][id];
$category = $json_result['data'][$indeks][category];
$name = $json_result['data'][$indeks][name];
$note = $json_result['data'][$indeks][note];
$min = $json_result['data'][$indeks][min];
$max = $json_result['data'][$indeks][max];
$price = $json_result['data'][$indeks][price];
$status = $json_result['data'][$indeks][status];
$indeks++;
$rate_aslinya = $price+1250;
$rate_asli=round($rate_aslinya);

mysqli_query($db, "INSERT INTO services(sid, category, service, note, min, max, price, status, pid, provider) VALUES ('$sid','$category','$name','$note','$min','$max','$rate_asli','Active','$sid','IRVANKEDE')");
}











?>