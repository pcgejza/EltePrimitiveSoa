<?php

require_once './config.php';


$link = mysqli_connect($MYSQL_HOST,$MYSQL_DATABASE_USER,$MYSQL_DATABASE_PASS, $MYSQL_DATABASE_NAME) or die('Cannot connect to the DB');
$link->set_charset("utf8");

try{
    $type = $_GET['type'];
    $id = $_GET['id'];
    
    if($type == null || !in_array($type, ['product'])){
        throw new Exception("Invalid type!");
    }
    
    if($id == null){
        throw new Exception("Invalid id!");
    }
    
    $json = array(
        'data' => [],
        'dateTime' => date('Y-m-d H:i:s')
    );
    
    if($type == 'product'){
        $q = "SELECT * FROM $type  WHERE id = $id LIMIT 1"; 
        $r = mysqli_query($link, $q);
        while($i = mysqli_fetch_array($r)) {
           $json['data'] = $i;
        }
    }
    echo json_encode($json, JSON_UNESCAPED_UNICODE);
}  catch (Exception $e){
    echo json_encode(array(
        'error' => "Error : ".$e->getMessage()
    ));
}