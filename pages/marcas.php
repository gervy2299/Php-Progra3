<?php
session_start();
require './conexion.php';
$obj = new ConexionBD();
if ($_SESSION['usuario'] == null || $_SESSION['usuario'] == '') {
    header('Location:../index.php');
}

$idmarca = (isset($_POST['idmarca']))?$_POST['idmarca']:"";
$txtnommar = (isset($_POST['nom_marca']))?$_POST['nom_marca']:"";

$accion = (isset($_POST['accion']))?$_POST['accion']:"";

switch ($accion) {
    case 'Seleccionar':
        echo 'seleccionando';
        $sentenciaSQL = "SELECT * FROM marcas where idmarca = '".$idmarca."';";
        if(mysqli_query($obj->conectar(), $sentenciaSQL)){
            foreach (($obj->conectar()->query($sentenciaSQL)) as $mar) {
                $txtnommar = $mar['nom_marca'];
            }
        }
        break;
    
    case 'Borrar':
        $sentenciaSQL = "DELETE FROM marcas where idmarca = '".$idmarca."';";
        if(mysqli_query($obj->conectar(), $sentenciaSQL)){
            header('location: ./marcas.php');
        }
        break;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php $obj->header(); ?>
</head>

<body>
    <?php $obj->Menus($_SESSION['usuario']); ?>

    <!--Main layout-->
    <main style="margin-top: 7vh">
        <div class="container pt-4">
            <form action="./iud_marcas.php" method="post" enctype="multipart/form-data">
                <!-- <form method="post" enctype="multipart/form-data"> -->
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">MARCAS</label>
                    <div class="col-sm-10">
                        <input type="number" value="<?php echo $txtnommar?>" class="form-control" id="inputEmail3" name="marca" placeholder="Ingresar nombre de marca...">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10 text-center">
                        <button type="submit" <?php if($accion=='Seleccionar'){echo 'disabled';}?> class="btn btn-primary">Insertar</button>
                        <button type="submit" <?php if($accion!='Seleccionar'){echo 'disabled';}?> class="btn btn-warning">Modificar</button>
                        <button type="submit" <?php if($accion!='Seleccionar'){echo 'disabled';}?> class="btn btn-secondary">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="container pt-4">
            <table class="table table-striped table">
                <thead>
                    <tr>
                        <th scope="col">N°</th>
                        <th scope="col">Marcas</th>
                        <th scope="col">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = 'select nom_marca from marcas where nom_marca like "%%" order by nom_marca;';
                    $item = 0;

                    foreach ($obj->conectar()->query($sql) as $row) {
                        $item++;
                    ?>
                        <tr>
                            <th scope="row"><?php echo $item ?></th>
                            <td><?php echo $row["nom_marca"] ?></td>
                            <td>
                                <form method="post">
                                    <input type='hidden' name="idmarca" value="<?php echo $row['idmarca']?>">
                                    <input type='submit' class="btn btn-warning" name="accion" value="Seleccionar"></input>
                                    <input type='submit' class="btn btn-danger" name="accion" value="Borrar"></input>
                                </form>
                            </td>
                        </tr>

                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
    <!--Main layout-->


</body>

</html>