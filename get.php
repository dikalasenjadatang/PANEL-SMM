<?php
include('konek.php');
date_default_timezone_set('Asia/Jakarta');
 
 
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
$api = new Rest();
 
$wew = $api->get_method('GET',array('type'=>'get_service_sosmed'));
 
if($wew->error){
    echo $wew->error;
}else{
   
 for($x = 0 ; $x < count($wew); $x++){
    $name = trim(htmlentities(htmlspecialchars(str_replace('SOLOSMARTPEDIA',' ',$wew[$x]->name)),ENT-QUOTES,'UTF-8'));
    $note = trim(htmlentities(htmlspecialchars(str_replace('SOLOSMARTPEDIA',' ',$wew[$x]->note)),ENT-QUOTES,'UTF-8'));
    $category = trim(htmlentities(htmlspecialchars(str_replace('SOLOSMARTPEDIA',' ',$wew[$x]->kategori)),ENT-QUOTES,'UTF-8'));
    $price = $wew[$x]->price+2000; //OPSIONAL
   
    $cek = $db->querys("SELECT * FROM services WHERE sid = '".$wew[$x]->id."' AND provider='SMP'");
    if(mysqli_num_rows($cek)==1){
        echo 'DATA ID '.$wew[$x]->id.' SUDAH DIMASUKKAN <br \>';
    }else{
   
    $insert = $db->querys("INSERT INTO services (sid,category,service,note,min,max,price,status,pid,provider) VALUES ('".$wew[$x]->id."','$category','$name','$note','".$wew[$x]->min."','".$wew[$x]->max."','$price','Active','".$wew[$x]->id."','SMP') ");
    if($insert == TRUE){
    echo "<font color='green'><b>SUKSES INSERT</b></font> >  ID = ".$wew[$x]->id." , SERVICE = ".$name." <br \>";
    }else{
    echo "GAGAL MEMASUKAN DATA <br \>";
    }
flush();
ob_flush();
sleep(1);
}
}
}
?>