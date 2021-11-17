<?php 
require_once("mainconfig.php");
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


$ez = $db->query("SELECT * FROM orders WHERE status IN ('Pending','Processing') AND provider IN ('SMP')"); 
print_r($ez);
while($x = mysqli_fetch_object($ez)) {
    $id_order = $x->poid;
    $id = $x->id;
 	$api = new Rest();
    $wew = $api->get_method('GET',array('type'=>'get_status_sosmed','id_order'=>$id_order));
    $status = $wew->data->status;
    if($status == 'Canceled'){
        $status = 'Error';
    }else if($status == 'Completed'){
        $status = 'Success';
    }
    $start_count = $wew->data->start_count;
    $remains = $wew->data->remains;
    
        $update = $db->query("UPDATE orders set status = '$status' ,remains = '$remains', start_count = '$start_count' where id = '$id'");
        if($update){echo 'sukses';}else{echo 'gagal';}

}

?>