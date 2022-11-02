<?php
session_start();
require './conexion.php';
$obj = new ConexionBD();
if ($_SESSION['usuario'] == null || $_SESSION['usuario'] == '') {
    header('Location:../index.php');
}

$idprov = (isset($_POST['idprod']))?$_POST['idprod']:"";
$txtNomProd = (isset($_POST['producto']))?$_POST['producto']:"";
// $txtRuc = (isset($_POST['ruc']))?$_POST['ruc']:"";

$accion = (isset($_POST['accion']))?$_POST['accion']:"";

switch ($accion) {
    case 'Seleccionar':
        echo 'seleccionando';
        $sentenciaSQL = "SELECT * FROM productos where idproducto = '".$idprov."';";
        if(mysqli_query($obj->conectar(), $sentenciaSQL)){
            foreach (($obj->conectar()->query($sentenciaSQL)) as $prov) {
                $txtNomProd = $prov['nom_prod'];
                // $txtRuc = $prov['RUC']; 
            }
        }
        break;
    
    case 'Borrar':
        $sentenciaSQL = "DELETE FROM proveedor where idproveedor = '".$idprov."';";
        if(mysqli_query($obj->conectar(), $sentenciaSQL)){
            header('location: ./proveedores.php');
        }
        break;
}

?>

<?php
  $mysqli = new mysqli('containers-us-west-108.railway.app', 'root', 'HkVNr6yKdrGZI74P03Rk', 'railway', '7450');
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
            <form action="./iud_proveedores.php" method="post" enctype="multipart/form-data">
                <!-- <form method="post" enctype="multipart/form-data"> -->
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Producto</label>
                    <div class="col-sm-10">
                        <input type="text" value="<?php echo $txtNomProd?>" class="form-control" id="inputEmail3" name="producto" placeholder="Ingresar nombre de producto...">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Precio</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="inputEmail3" name="precio" placeholder="Ingresar precio...">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Marca</label>
                    <div class="col-sm-10">
                        <select class="form-select" id="inputEmail3">
                        <option value="0">Seleccione:</option>
                              <?php
                                $query = $mysqli -> query ("SELECT * FROM marcas");
                                while ($valores = mysqli_fetch_array($query)) {
                                  echo '<option value="'.$valores['idmarca'].'">'.$valores['nom_marca'].'</option>';
                                }
                              ?>
                        </select>
                        <!-- <input type="text" class="form-control" id="inputEmail3" name="apepat" placeholder="APELLIDO PATERNO"> -->
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Caracteristicas</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputEmail3" name="apemat" placeholder="Ingresar caracteristica...">
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
                        <th scope="col">PRODUCTO</th>
                        <th scope="col">PRECIO</th>
                        <th scope="col">MARCA</th>
                        <th scope="col">CARACTERISTICA</th>
                        <th scope="col">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = 'select p.nom_prod,p.precio,m.nom_marca,p.caract from productos p inner join marcas m on p.idmarca=m.idmarca order by p.nom_prod;';
                    $item = 0;

                    foreach ($obj->conectar()->query($sql) as $row) {
                        $item++;
                    ?>
                        <tr>
                            <th scope="row"><?php echo $item ?></th>
                            <td><?php echo $row["nom_prod"] ?></td>
                            <td><?php echo $row["precio"] ?></td>
                            <td><?php echo $row["nom_marca"] ?></td>
                            <td><?php echo $row["caract"] ?></td>
                            <td>
                                <form method="post">
                                    <input type='hidden' name="idprod" value="<?php echo $row['idprod']?>">
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