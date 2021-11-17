
<?php

require("../mainconfig.php");
$poin = "12928";

 $api_postdata = "api_key=HLo5kJRdUaGPlsBKjgzmuWMn3wi0tV&action=status&id=$poin";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://medanpedia.co.id/pulsa-v2/json.php');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $api_postdata);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $chresult = curl_exec($ch);
    curl_close($ch);
    $json_result = json_decode($chresult);
    print_r($json_result);
   $u_status = $json_result->data->status;
   $u_start = $json_result->data->start_count;
   $u_remains = $json_result->data->remains;
   if($u_status == "Success"){
  die("benar kobtol");
     } else {
   die("error govlok");
   }