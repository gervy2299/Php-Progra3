<?php
session_start();
require './conexion.php';
$obj = new ConexionBD();
if ($_SESSION['usuario'] == null || $_SESSION['usuario'] == '') {
    header('Location:../index.php');
}

$idprov = (isset($_POST['idprov']))?$_POST['idprov']:"";
$txtDni = (isset($_POST['dni']))?$_POST['dni']:"";
$txtNombre = (isset($_POST['nombres']))?$_POST['nombres']:"";
$txtPapellido = (isset($_POST['apepat']))?$_POST['apepat']:"";
$txtSapellido = (isset($_POST['apemat']))?$_POST['apemat']:"";
$txtRuc = (isset($_POST['ruc']))?$_POST['ruc']:"";
$txtEmpresa = (isset($_POST['nomemp']))?$_POST['nomemp']:"";
$txtDir = (isset($_POST['diremp']))?$_POST['diremp']:"";

$accion = (isset($_POST['accion']))?$_POST['accion']:"";

switch ($accion) {

    case 'Modificar':
        echo 'seleccionando';
        $sentenciaSQL = "SELECT * FROM proveedor where idproveedor = '".$idprov."';";
        if(mysqli_query($obj->conectar(), $sentenciaSQL)){
            foreach (($obj->conectar()->query($sentenciaSQL)) as $prov) {
                $txtDni = $prov['DNI'];
                $txtRuc = $prov['RUC'];
            }
        }
        break;

    case 'Cancelar':
        $sentenciaSQL = "DELETE FROM proveedor where idproveedor = '".$idprov."';";
        if(mysqli_query($obj->conectar(), $sentenciaSQL)){
            header('location: ./proveedores.php');
        }
        break;

    case 'Seleccionar':
        echo 'seleccionando';
        // $sentenciaSQL = "SELECT * FROM proveedor where idproveedor = '".$idprov."';";
        $sentenciaSQL = "SELECT 
            pro.idproveedor as idprov,
            per.DNI as DNI,
            per.nom_persona as nombre, 
            per.primer_apellido as papellido,
            per.segundo_apellido as sapellido,
            em.RUC as RUC,
            em.raz_social as empresa,
            em.direc as direccion
        FROM proveedor pro
        inner join personas per on pro.DNI=per.DNI
        inner join empresa em on pro.RUC=em.RUC WHERE idproveedor = '".$idprov."';";
        if(mysqli_query($obj->conectar(), $sentenciaSQL)){
            foreach (($obj->conectar()->query($sentenciaSQL)) as $prov) {
                $txtDni = $prov['DNI'];
                $txtNombre = $prov['nombre'];
                $txtPapellido = $prov['papellido'];
                $txtSapellido = $prov['sapellido'];
                $txtRuc = $prov['RUC'];
                $txtEmpresa = $prov['empresa'];
                $txtDir = $prov['direccion'];
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

<!DOCTYPE html>
<html lang="en">

<head>
    <?php $obj->Header(); ?>
</head>

<body>
    <?php $obj->Menus($_SESSION['usuario']); ?>

    <!--Main layout-->
    <main style="margin-top: 7vh">
        <div class="container pt-4">
    <h2 class="text-center">Proveedores</h2>
    <br>
            <form action="./iud_proveedores.php" method="post" enctype="multipart/form-data">
                <!-- <form method="post" enctype="multipart/form-data"> -->
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">DNI</label>
                    <div class="col-sm-10">
                        <input type="number" value="<?php echo $txtDni?>" class="form-control" id="inputEmail3" name="dni" placeholder="DNI">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">NOMBRES</label>
                    <div class="col-sm-10">
                        <input type="text" value="<?php echo $txtNombre?>" class="form-control" id="inputEmail3" name="nombres" placeholder="NOMBRES">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">APELLIDO PATERNO</label>
                    <div class="col-sm-10">
                        <input type="text" value="<?php echo $txtPapellido?>" class="form-control" id="inputEmail3" name="apepat" placeholder="APELLIDO PATERNO">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">APELLIDO MATERNO</label>
                    <div class="col-sm-10">
                        <input type="text" value="<?php echo $txtSapellido?>" class="form-control" id="inputEmail3" name="apemat" placeholder="APELLIDO MATERNO">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">RUC</label>
                    <div class="col-sm-10">
                        <input type="number" value="<?php echo $txtRuc?>" class="form-control" id="inputEmail3" name="ruc" placeholder="RUC">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">NOMBRE DE LA EMPRESA</label>
                    <div class="col-sm-10">
                        <input type="text" value="<?php echo $txtEmpresa?>" class="form-control" id="inputEmail3" name="nomemp" placeholder="NOMBRE DE LA EMPRESA">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">DIRECCION DE LA EMPRESA</label>
                    <div class="col-sm-10">
                        <input type="text" value="<?php echo $txtDir?>" class="form-control" id="inputEmail3" name="diremp" placeholder="NOMBRE DE LA EMPRESA">
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
        <div class="container pt-4">
            <table class="table table-striped table">
                <thead>
                    <tr>
                        <th scope="col">N°</th>
                        <th scope="col">DNI</th>
                        <th scope="col">PERSONAS</th>
                        <th scope="col">RUC</th>
                        <th scope="col">EMPRESA</th>
                        <th scope="col">DIRECCION</th>
                        <th scope="col">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = 'select
                    pro.idproveedor as idprov,
    per.DNI as DNI, 
    concat(per.nom_persona," ", per.primer_apellido," ",per.segundo_apellido) as persona,
    em.RUC as RUC,
    em.raz_social as empresa,
    em.direc as direccion
    from proveedor pro
    inner join personas per on pro.DNI=per.DNI
    inner join empresa em on pro.RUC=em.RUC;';
                    $item = 0;

                    foreach ($obj->conectar()->query($sql) as $row) {
                        $item++;
                    ?>
                        <tr>
                            <th scope="row"><?php echo $item ?></th>
                            <td><?php echo $row["DNI"] ?></td>
                            <td><?php echo $row["persona"] ?></td>
                            <td><?php echo $row["RUC"] ?></td>
                            <td><?php echo $row["empresa"] ?></td>
                            <td><?php echo $row["direccion"] ?></td>
                            <td>
                                <form method="post">
                                    <input type='hidden' name="idprov" value="<?php echo $row['idprov']?>"></input>
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