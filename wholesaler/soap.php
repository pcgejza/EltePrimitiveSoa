<?php

require_once './config.php';

$link = mysqli_connect($MYSQL_HOST,$MYSQL_DATABASE_USER,$MYSQL_DATABASE_PASS, $MYSQL_DATABASE_NAME) or die('Cannot connect to the DB');
$link->set_charset("utf8");

//a basic API class
class MyAPI {
    
    // kiskereskedő vásárol a nagykereskedőtől
    public function buying($customerId, $productId, $stock){
        global $link;
        try{
            $customer = $this->getCustomer($customerId);
            if($customer == null){
                throw new Exception("Customer $customerId not exists!");
            }
            
            $product = $this->getProduct($productId);
            if($product == null){
                throw new Exception("Procuct $productId not exists!");
            }
            
            if($product['stock'] < $stock){
                throw new Exception("A termékből nincs ennyi($stock) raktáron!");
            }
            
            $q = "UPDATE product SET stock = stock - $stock WHERE id = $productId";
            mysqli_query($link, $q);
            
            $price = $stock * $product['price'];
            
            $q = "INSERT INTO sale (product_id, customer_id, stock, price) VALUES "
                    . "($productId, $customerId, $stock, $price)";
            mysqli_query($link, $q);
            
            $message = "<br>A(z) ";
            $message .= "<b>".$customer['name']."</b> kiskereskedő (melynek címe : <b>".$customer['address']."</b>)";
            $message .= " sikeresen vásárolt $stock darabot a ";
            $message .= "<b>".$product['name']."</b> termékből (melynek ára : <b>".$product['price']."</b>/db)";
            
            return array(
                'success' => true,
                'message' => $message
            );
        } catch (Exception $ex) {
            return array(
                'success' => false,
                'message' => $ex->getMessage()
            );
        }
    }
    
    private function getProduct($id){
        global $link;
        $product = null;
        $q = "SELECT * FROM product WHERE id = $id LIMIT 1"; 
        $r = mysqli_query($link, $q);
        while($i = mysqli_fetch_array($r)) {
           $product = $i;
        }
        return $product;  
    }
    
    private function getCustomer($id){
        global $link;
        $customer = null;
        $q = "SELECT * FROM customer WHERE id = $id LIMIT 1"; 
        $r = mysqli_query($link, $q);
        while($i = mysqli_fetch_array($r)) {
           $customer = $i;
        }
        return $customer;  
    }
    
}
//when in non-wsdl mode the uri option must be specified
$options=array('uri'=>'http://localhost/');
//create a new SOAP server
$server = new SoapServer(NULL,$options);
//attach the API class to the SOAP Server
$server->setClass('MyAPI');
//start the SOAP requests handler
$server->handle();
?>
