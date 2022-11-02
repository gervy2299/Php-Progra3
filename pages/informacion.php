<?php
session_start();
require './conexion.php';
$obj = new ConexionBD();
if ($_SESSION['usuario'] == null || $_SESSION['usuario'] == '') {
    header('Location:../index.php');
}

$usuario = $_SESSION['usuario'];

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
                where idempleado = '".$usuario."'";
        if(mysqli_query($obj->conectar(), $sentenciaSQL)){
            foreach (($obj->conectar()->query($sentenciaSQL)) as $mar) {
                $usuario = $mar['idempleado'];
                $dni = $mar['dni'];
                $nomper = $mar['nom_persona'];
                $papellido = $mar['primer_apellido'];
                $sapellido = $mar['segundo_apellido'];
                $area = $mar['area'];
            }
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
        <div class="container pt-4 content_info">
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
                                        <p><?php echo $dni;?></p>
                                    </div>
                                    <div class="media">
                                        <label>NOMBRES:</label>
                                        <!-- <hr> -->
                                        <p><?php echo $nomper;?></p>
                                    </div>
                                    <div class="media">
                                        <label>APELLIDO PATERNO:</label>
                                        <!-- <hr> -->
                                        <p><?php echo $papellido;?></p>
                                    </div>
                                    <div class="media">
                                        <label>APELLIDO MATERNO:</label>
                                        <!-- <hr> -->
                                        <p><?php echo $sapellido;?></p>
                                    </div>
                                    <div class="media">
                                        <label>AREA ASIGNADA:</label>
                                        <!-- <hr> -->
                                        <p><?php echo $area;?></p>
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
            </div>
        </section>
        </div>
    </main>
    <!--Main layout-->


</body>

</html>