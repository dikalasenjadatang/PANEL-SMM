<?php

require_once("mainconfig.php");//koneksi kepada database
final class Rest{
    public  $url = 'https://solosmartpedia.com/api/';
    public  $apikey = 'OTg2NWMyN2QyNmYxNWY5ZWFhNmM1NGEyM2FjZjczYWI1NTBlNzdjZA==';
    
    public function get_method($method,$data){
        return json_decode($this->curl($method,$this->url.'/user?'.http_build_query($data)));
    }
    
    public function order_sosmed($method,$data){
        return json_decode($this->curl($method,$this->url.'/sosmed',array_merge(array('X-API-KEY'=>trim($this->apikey)),$data)));
    }
    
    public function order_pulsa($method,$data){
        return json_decode($this->curl($method,$this->url.'/pulsa',array_merge(array('X-API-KEY'=>trim($this->apikey)),$data)));
    }

    
    private function curl($method,$end_point,$data=''){
        //inisialisasi;
        $ch = curl_init($end_point);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
        curl_setopt($ch, CURLOPT_HEADER,0);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST,$method);
        curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT x.y; Win64; x64; rv:10.0) Gecko/20100101 Firefox/10.0');
        switch($method){
            case 'POST':
            curl_setopt($ch,CURLOPT_POST,1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));
            break;
            case 'GET':
            curl_setopt($ch, CURLOPT_HTTPHEADER,array('X-API-KEY:'.$this->apikey));
            break;
        }
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}

#ALL IN ONE
$api = new Rest();
$json_result = $api->get_method('GET',array('type'=>'get_service_pulsa'));
$indeks=0; 
$i = 1;

// echo "<pre>";
// print_r($json_result);
// die;
// get data service
while($indeks < count($json_result)){ 
    

$id =$json_result[$indeks]->id;
$name =$json_result[$indeks]->service;
$price = $json_result[$indeks]->harga;
$oprator =$json_result[$indeks]->operator;
$operator_subs =$json_result[$indeks]->operator_subcode;
$desc = $json_result[$indeks]->deskripsi;
#die($id.$name.$price.$oprator.$operator_subs);
$indeks++; 
$i++;
// end get data service 
// setting price 
$rate = $price; 
$rate_asli = $rate + 2000; //setting penambahan harga
// setting price 
 $check_services = mysqli_query($db, "SELECT * FROM services_pulsa WHERE pid = '$id' AND provider='SMP'");
            $data_services = mysqli_fetch_assoc($check_orders);
        if(mysqli_num_rows($check_services) > 0) {
            echo "Service Sudah Ada Di database => $name | $id \n <br />";
        } else {
            
$insert=mysqli_query($db, "INSERT INTO services_pulsa (name,category, code,price, status, provider) VALUES ('$name','$oprator','$id','$rate_asli','Active','SMP')");//Memasukan Kepada Database (OPTIONAL)
if($insert == TRUE){
echo"SUKSES INSERT -> Kategori : $name || SID : $id || Oprator :$oprator <br />";
}else{
    echo "GAGAL MEMASUKAN DATA";
    
}
}
}
?>