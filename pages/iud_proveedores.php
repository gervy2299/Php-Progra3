<?php 
    require'./conexion.php';
    $obj = new ConexionBD();

    $sqlins = 'select f_ins_proveedores("'.
                $_POST['dni'].'", "'.
                $_POST['nombres'].'", "'.
                $_POST['apepat'].'", "'.
                $_POST['apemat'].'", "'.
                $_POST['ruc'].'", "'.
                $_POST['nomemp'].'", "'.
                $_POST['diremp'].'");';
    $insert = $obj->conectar()->query($sqlins);

    if (mysqli_query($obj->conectar(), $sqlins)) {
        echo "New record created successfully";
    }else {
        echo "Error: " . $sqlins . "<br>" . mysqli_error($conn);
    }

?>