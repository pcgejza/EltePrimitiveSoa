<html>
    <head>
        <title>Termék és készlet információk</title>
        <meta charset="UTF-8">
    </head>
    <body>
        <?php
            $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $whoosalerLink = $actual_link;// rtrim($realpath, "reatiler")."wholesaler/restful.php";
            $whoosalerLink = substr($whoosalerLink, 0, strpos($whoosalerLink, 'retailer')).'wholesaler/restful.php';
            
        ?>
        <h1>Termék és készlet információk lekérdezése</h1>
        <form method="POST" action="get-info.php">
            <div>
                <span>URL:</span>
                <input type="text" name="url" value="<?php echo $whoosalerLink; ?>">
            </div>
            <div>
                <span>Termék ID:</span>
                <input type="text" name="product_id" value="<?php echo $_POST['product_id'] ?>">
                <input type="submit">
            </div>
        </form>
        <?php 
            $data = null;
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $id = $_POST['product_id'];
                
                if($id != null){
                    $whoosalerLink = $_POST['url'];
                    $whoosalerLink .= "?type=product&id=$id";
                    $data = file_get_contents($whoosalerLink);
                }
            }
        ?>
        
        <?php   
            if($data != null){
                echo "Web szolgáltatástól visszaérkezett adat : <br><b>$data</b>";
            }
        ?>
    </body>
</html>