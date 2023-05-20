<?php
//connection
$hostname = 'localhost';
$data_base ='a116152_ideal_bot';
$password = 'xt.RqQRkLKI~5&yi';
$username = 'a116152_idealbot';

$db = new mysqli($hostname,$username,$password,$data_base);

$db->set_charset("utf8mb4");
if($db->connect_errno){
    echo $db->connect_errno;
    exit();
}


