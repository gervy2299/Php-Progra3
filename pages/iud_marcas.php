<?php 
    require'./conexion.php';
    $obj = new ConexionBD();

    $sqlins = 'select f_ins_marcas("'.
                $_POST['marca'].'");';
    $insert = $obj->conectar()->query($sqlins);

    if (mysqli_query($obj->conectar(), $sqlins)) {
        // echo "New record created successfully";
        header('location:./marcas.php');
    }else {
        echo "Error: " . $sqlins . "<br>" . mysqli_error($conn);
    }

?>