<?php

$hostname = 'localhost';
$data_base ='botuzro1_ideal';
$password = '%=G&+ae}H[sQ';
$username = 'botuzro1_ideal_uz';
$db = new mysqli($hostname,$username,$password,$data_base);
$db->set_charset("utf8mb4");
if($db->connect_errno){
    echo $db->connect_errno;
    exit();
}


