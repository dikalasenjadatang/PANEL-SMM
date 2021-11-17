<?php 

class koneksi{
    
protected $db;

function __construct(){
define('DB_NAME','redirped_117');
define('USER','redirped_117');
define('PASS','redirped_117');
define('HOST','localhost');
$this->db = new mysqli(HOST,USER,PASS,DB_NAME) OR die('AUTH DB IS NOT VALIDED'); 
}


function querys($query){
return $this->db->query($query);
}

}
$db = new koneksi();