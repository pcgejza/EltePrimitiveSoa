<html>
    <head>
        <title>Termék és készlet értékesítés</title>
        <meta charset="UTF-8">
    </head>
    <body>
        <?php
            $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $whoosalerLink = $actual_link;
            $whoosalerLink = substr($whoosalerLink, 0, strpos($whoosalerLink, 'retailer')).'wholesaler/soap.php';
        ?>
        <h1>Kiskereskedő vásárol a nagykereskedőtől</h1>
        <form method="POST" action="set-info.php">
            <div>
                <span>URL:</span>
                <input type="text" name="url" value="<?php echo $whoosalerLink; ?>">
            </div>
            <div>
                <span>Kiskereskedő ID:</span>
                <input type="text" name="customer_id_1" value="<?php echo $_POST['customer_id_1'] ? $_POST['customer_id_1'] : '2' ?>">
                <small>Megj.:Ez a valóságban úgy működne, hogy minden egyes kiskereskedő kap egy ilyen felületet, így a kiskereskedő ID eltűnne</small>
            </div>
            <div>
                <span>Termék ID:</span>
                <input type="text" name="product_id_1" value="<?php echo $_POST['product_id_1'] ?>">
            </div>
            <div>
                <span>Darabszám:</span>
                <input type="text" name="stock_1" value="<?php echo $_POST['stock_1'] ?>">
            </div>
            <input type="hidden" name="type" value="1">
            <input type="submit">
        </form>
        <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $options = array('location' => $_POST['url'], 
                                  'uri' => $_SERVER[HTTP_HOST]);
                //create an instante of the SOAPClient (the API will be available)
                $api = new SoapClient(NULL, $options);
                //call an API method
                
                $type = $_POST['type'];
                if($type == 1){
                    $buy = $api->buying($_POST['customer_id_1'], $_POST['product_id_1'], $_POST['stock_1']);
                    if($buy['success'] === true){
                        echo "<br>Sikeres vásárlás a nagykereskedőtől! ".$buy['message'];
                    }else{
                        echo "<br><p style='color: red;'>Sikertelen vásárlás : <b>".$buy['message']."</b></p>";
                    }
                }
            }
        ?>
    </body>
</html>

