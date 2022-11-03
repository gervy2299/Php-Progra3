<?php
session_start();
require './conexion.php';
$obj = new ConexionBD();
if ($_SESSION['usuario'] == null || $_SESSION['usuario'] == '') {
    header('Location:../index.php');
}

$idprod = (isset($_POST['idprod']))?$_POST['idprod']:"";
$txtnomProd = (isset($_POST['nomProd']))?$_POST['nomProd']:"";
$txtPrecio = (isset($_POST['precio']))?$_POST['precio']:"";
$txtMarca = (isset($_POST['marca']))?$_POST['marca']:"";
$txtCaracte = (isset($_POST['caract']))?$_POST['caract']:"";

$accion = (isset($_POST['accion']))?$_POST['accion']:"";

switch ($accion) {

    case 'Insertar':
        $sentenciaSQL = "select f_ins_productos('$txtnomProd',$txtPrecio, '$txtMarca', '$txtCaracte');";
        if(mysqli_query($obj->conectar(), $sentenciaSQL)){
            header('location: ./productos.php');
        }
        break;

    case 'Modificar':
        echo 'seleccionando';
        $sentenciaSQL = "select f_upt_producto('".$idprod."', '".$txtnomProd."', '".$txtCaracte."',".$txtPrecio.", '".$txtMarca."');";
        //echo '<br/><br/><br/><br/> <div style="margin-left: 500px">'.$sentenciaSQL.'</div>';
        if(mysqli_query($obj->conectar(), $sentenciaSQL)){
            header('location: ./productos.php');
        }
        
        break;

    case 'Cancelar':
            header('location: ./productos.php');
        break;

    case 'Seleccionar':
        echo 'seleccionando';
        // $sentenciaSQL = "SELECT * FROM proveedor where idproducto = '".$idprod."';";
        $sentenciaSQL = "select 
        p.idproducto as idprov
        ,nom_prod as nomProd
        ,p.precio as precio
        ,m.nom_marca as marca
        ,p.caract as caract
        from productos p 
        inner join marcas m on p.idmarca=m.idmarca WHERE idproducto = '".$idprod."' order by p.nom_prod;";
        if(mysqli_query($obj->conectar(), $sentenciaSQL)){
            foreach (($obj->conectar()->query($sentenciaSQL)) as $prov) {
                $txtnomProd = $prov['nomProd'];
                $txtPrecio = $prov['precio'];
                $txtMarca = $prov['marca'];
                $txtCaracte = $prov['caract'];
                $cbMarca = $prov['marca'];
            }
        }

        
        break;
    
    case 'Borrar':
        $sentenciaSQL = "DELETE FROM productos where idproducto = '".$idprod."';";
        if(mysqli_query($obj->conectar(), $sentenciaSQL)){
            header('location: ./productos.php');
        }
        break;
}

?>

<!--?php
  $mysqli = new mysqli('containers-us-west-108.railway.app', 'root', 'HkVNr6yKdrGZI74P03Rk', 'railway','7450');
?-->

<!DOCTYPE html>
<html lang="es">

<head>
    <?php $obj->Header(); ?>
</head>

<body>
    <?php $obj->Menus($_SESSION['usuario']); ?>

    <!--Main layout-->
    <main style="margin-top: 7vh">
        <div class="container pt-4">
    <h2 class="text-center">Productos</h2>
    <br>
            <form method="post" enctype="multipart/form-data">
                <!-- <form method="post" enctype="multipart/form-data"> -->
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">NOMBRE</label>
                    <div class="col-sm-10">
                        <input type="text" value="<?php echo $txtnomProd?>" class="form-control" id="inputEmail3" name="nomProd" placeholder="Ingresar nombre producto...">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">PRECIO</label>
                    <div class="col-sm-10">
                        <input type="text" value="<?php echo $txtPrecio?>" class="form-control" id="inputEmail3" name="precio" placeholder="Ingresar precio del producto...">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">MARCA</label>
                    <div class="col-sm-10">
                    <!-- <select class="form-group" name="marca">
                    <option value="0"><?php echo $cbMarca; ?></option>
                      <?php/*
                        $query = $mysqli -> query ("SELECT * FROM marcas");
                        while ($valores = mysqli_fetch_array($query)) {
                          echo '<option value="'.$valores['idmarca'].'">'.$valores['nom_marca'].'</option>';
                        }*/
                      ?>
                      <option value="/<?//php echo $cbMarca; ?>" selected></option>
                    </select> -->
                     <input type="text" value="<?php echo $txtMarca?>" class="form-control" id="inputEmail3" name="marca" placeholder="Ingresar marca del producto...">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">CARACTERISTICA</label>
                    <div class="col-sm-10">
                        <input type="text" value="<?php echo $txtCaracte?>" class="form-control" id="inputEmail3" name="caract" placeholder="Ingresar caracteriscas del producto...">
                    </div>
                </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10 text-center">
                        <button type="submit" <?php if($accion=='Seleccionar'){echo 'disabled';}?> name='accion' value="Insertar" class="btn btn-primary">Insertar</button>
                        <button type="submit" <?php if($accion!='Seleccionar'){echo 'disabled';}?> name='accion' value="Modificar" class="btn btn-warning">Modificar</button>
                        <button type="submit" <?php if($accion!='Seleccionar'){echo 'disabled';}?> name='accion' value="Cancelar" class="btn btn-secondary">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="container pt-4 ">
            <table class="table table-striped table">
                <thead>
                    <tr>
                        <th scope="col">N°</th>
                        <th scope="col">NOMBRE</th>
                        <th scope="col">PRECIO</th>
                        <th scope="col">MARCA</th>
                        <th scope="col">CARACTERISTICA</th>
                        <th scope="col">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = 'select p.idproducto as idprod,nom_prod,p.precio,m.nom_marca,p.caract from productos p inner join marcas m on p.idmarca=m.idmarca order by p.nom_prod;';
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
                                    <input type='hidden' name="idprod" value="<?php echo $row['idprod'];?>"></input>
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