<?php
session_start();
require './conexion.php';
$obj = new ConexionBD();
if ($_SESSION['usuario'] == null || $_SESSION['usuario'] == '') {
    header('Location:../index.php');
}

$usuario = $_SESSION['usuario'];

$dni = (isset($_POST['dni'])) ? $_POST['dni'] : "";
$nomper = (isset($_POST['nombres'])) ? $_POST['nombres'] : "";
$papellido = (isset($_POST['apepat'])) ? $_POST['apepat'] : "";
$sapellido = (isset($_POST['apemat'])) ? $_POST['apemat'] : "";
$area = (isset($_POST['area'])) ? $_POST['area'] : "";
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";

$sentenciaSQL = "SELECT  
                emp.idempleado,
                per.dni,
                per.nom_persona,
                per.primer_apellido,
                per.segundo_apellido,
                ar.area
                from empleados emp
                inner join personas per on emp.dni = per.dni
                inner join areas ar on emp.idarea = ar.idarea
                where idempleado = '" . $usuario . "'";
if (mysqli_query($obj->conectar(), $sentenciaSQL)) {
    foreach (($obj->conectar()->query($sentenciaSQL)) as $mar) {
        $usuario = $mar['idempleado'];
        $dni = $mar['dni'];
        $nomper = $mar['nom_persona'];
        $papellido = $mar['primer_apellido'];
        $sapellido = $mar['segundo_apellido'];
        $area = $mar['area'];
    }
}


switch ($accion) {

    case 'Cancelar':
        header('location: ./informacion.php');
        break;

    case 'Actualizar':
        // $sentenciaSQL = "select f_upt_empleado('".$dni."','".$nomper."','".$papellido."','".$sapellido."','".$usuario."','".$area."');";
        $nomper = (isset($_POST['nombres'])) ? $_POST['nombres'] : "";
        $papellido = (isset($_POST['apepat'])) ? $_POST['apepat'] : "";
        $sapellido = (isset($_POST['apemat'])) ? $_POST['apemat'] : "";
        // echo '<br><br><br><br><div style="margin-left: 500px;">' . $nomper . '_' . $papellido . '_' . $sapellido . '_' . $dni . '</div>';
        $sentenciaSQL = "UPDATE personas SET nom_persona='" . $nomper . "', primer_apellido='" . $papellido . "', segundo_apellido='" . $sapellido . "' WHERE dni = '" . $dni . "'";
        if (mysqli_query($obj->conectar(), $sentenciaSQL)) {
            // header('location: ./informacion.php');
        }
        break;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php $obj->header(); ?>
    <script src="./js/home.js"></script>
</head>

<body>
    <?php
    // $sql2 = 'select concat(per.nom_persona," ",per.primer_apellido) as empleado from empleados em inner join personas per on em.DNI=per.DNI where em.idempleado="'.$_SESSION['usuario'].'"';
    // $res_sql2 = $obj->conectar()->query($sql2);
    // $arr = mysqli_fetch_array($res_sql2);    
    $obj->Menus($_SESSION['usuario']);
    ?>

    <!--Main layout-->
    <main style="margin-top: 10vh">
        <div class="container content_info">
            <!-- <?php echo $usuario; ?> -->
            <section class="section about-section gray-bg" id="about">
                <div class="container">
                    <div class="row align-items-center flex-row-reverse">
                        <div class="col-lg-6">
                            <div class="about-text go-to">
                                <h3 class="dark-color">Mi Información:</h3>
                                <h6 class="theme-color lead">Trabajador en Ampere Electrónica.</h6>
                                <div class="row about-list">
                                    <div class="col-md-12">
                                        <div class="media">
                                            <label>DNI:</label>
                                            <!-- <hr> -->
                                            <p><?php echo $dni; ?></p>
                                        </div>
                                        <div class="media">
                                            <label>NOMBRES:</label>
                                            <!-- <hr> -->
                                            <p><?php echo $nomper; ?></p>
                                        </div>
                                        <div class="media">
                                            <label>APELLIDO PATERNO:</label>
                                            <!-- <hr> -->
                                            <p><?php echo $papellido; ?></p>
                                        </div>
                                        <div class="media">
                                            <label>APELLIDO MATERNO:</label>
                                            <!-- <hr> -->
                                            <p><?php echo $sapellido; ?></p>
                                        </div>
                                        <div class="media">
                                            <label>AREA ASIGNADA:</label>
                                            <!-- <hr> -->
                                            <p><?php echo $area; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="about-avatar">
                                <img class="img_info" src="https://bootdey.com/img/Content/avatar/avatar7.png" title="" alt="">
                            </div>
                        </div>
                    </div>
                    <!-- <div class="counter">                
                    <div class="row">
                        <div class="col-6 col-lg-3">
                            <div class="count-data text-center">
                                <h6 class="count h2" data-to="500" data-speed="500">500</h6>
                                <p class="m-0px font-w-600">Happy Clients</p>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3">
                            <div class="count-data text-center">
                                <h6 class="count h2" data-to="150" data-speed="150">150</h6>
                                <p class="m-0px font-w-600">Project Completed</p>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3">
                            <div class="count-data text-center">
                                <h6 class="count h2" data-to="850" data-speed="850">850</h6>
                                <p class="m-0px font-w-600">Photo Capture</p>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3">
                            <div class="count-data text-center">
                                <h6 class="count h2" data-to="190" data-speed="190">190</h6>
                                <p class="m-0px font-w-600">Telephonic Talk</p>
                            </div>
                        </div>
                    </div>
                </div> -->
                    <div class="content">
                        <div class="row">
                            <div class="col-sm-12 text-center">

                                <form method="post" enctype="multipart/form-data">
                                    <button type="submit" name="accion" value="Seleccionar" class="btn btn-primary">Editar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <br><br>
                    <div class="container" style="<?php if ($accion != 'Seleccionar') {
                                                        echo 'display:none';
                                                    } ?>">
                        <div>
                            <form method="post" enctype="multipart/form-data">
                                <!-- <form method="post" enctype="multipart/form-data"> -->
                                <input type="hidden" value="<?php echo $usuario; ?>" class="form-control" id="inputEmail3" name="usuario" placeholder="Ingresar nombre de marca...">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">DNI:</label>
                                    <div class="col-sm-10">
                                        <input type="text" value="<?php echo $dni; ?>" disabled class="form-control" id="inputEmail3" name="dni" placeholder="Ingresar nombre de marca...">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">NOMBRES:</label>
                                    <div class="col-sm-10">
                                        <input type="text" value="<?php echo $nomper; ?>" class="form-control" id="inputEmail3" name="nombres" placeholder="Ingresar nombre de marca...">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">APELLIDO PATERNO:</label>
                                    <div class="col-sm-10">
                                        <input type="text" value="<?php echo $papellido; ?>" class="form-control" id="inputEmail3" name="apepat" placeholder="Ingresar nombre de marca...">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">APELLIDO MATERNO:</label>
                                    <div class="col-sm-10">
                                        <input type="text" value="<?php echo $sapellido; ?>" class="form-control" id="inputEmail3" name="apemat" placeholder="Ingresar nombre de marca...">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">AREA ASIGNADA:</label>
                                    <div class="col-sm-10">
                                        <input type="text" disabled value="<?php echo $area; ?>" class="form-control" id="inputEmail3" name="area" placeholder="Ingresar nombre de marca...">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10 text-center">
                                        <button type="submit" <?php if ($accion != 'Seleccionar') {
                                                                    echo 'disabled';
                                                                } ?> name="accion" value="Actualizar" class="btn btn-primary">Actualizar</button>
                                        <button type="submit" <?php if ($accion != 'Seleccionar') {
                                                                    echo 'disabled';
                                                                } ?> name="accion" value="Cancelar" class="btn btn-secondary">Cancelar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <!--Main layout-->


</body>

</html>