<?php 
require_once("mainconfig.php");
date_default_timezone_set('Asia/Jakarta');

// $delete = $db->query("DELETE FROM services where provider ='SMP'");
// if($delete){echo 'SUKSES';}

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

$x=0;
while($x < count($wew)) {
 	$name = trim(str_replace('SOLOSMARTPEDIA',' ',$wew[$x]->name));
 	$note = trim(str_replace('SOLOSMARTPEDIA',' ',$wew[$x]->note));
 	$category = trim(str_replace('SOLOSMARTPEDIA',' ',$wew[$x]->kategori));;
 	$price = $wew[$x]->price+2000; //OPSIONAL
 	$id = $wew[$x]->id;
 	$min = $wew[$x]->min;
 	$max = $wew[$x]->max;
 	

  	$x++;
 	$cek = mysqli_query($db,"SELECT * FROM services WHERE sid = '$id' AND provider = 'SMP'");
 	if(mysqli_num_rows($cek) > 0 ){
 	    echo 'DATA ID '.$id.' SUDAH DIMASUKKAN <br \>';
 	}else{
 	
 	$insert = mysqli_query($db, "INSERT INTO services (sid, category, service, note, min, max, price, status, pid, provider) VALUES ('$id','$category','$name','$note','$min','$max','$price','Active','$id','SMP')");

    if($insert){
    echo "<font color='green'><b>SUKSES INSERT</b></font> >  ID = ".$id." , SERVICE = ".$name." <br \>";
    }else{
    echo "GAGAL MEMASUKAN DATA <br \>";
    }
    
  

}
}

?>