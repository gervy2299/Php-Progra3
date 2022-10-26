<?php

include_once './conexion.php';

$nm = "on";
    // array_key_exists('logina', $_POST){} cambio();

    function cambio($val){
        if($val = "on"){
            $val = "off";
        }elseif($val = "off"){
            $val = "on";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <input type="button" value="Esto es un boton" name="cambio" onclick='<?php cambio($nm)?>'>
    <?php
    
    if ($nm = "on") {
        include_once './almacen.php';
    } elseif ($nm = "off") {
        include_once './proveedores.php';
    }
    ?>
</body>

</html>