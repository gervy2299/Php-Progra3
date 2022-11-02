<?php
session_start();
require './conexion.php';
$obj = new ConexionBD();
if ($_SESSION['usuario'] == null || $_SESSION['usuario'] == '') {
    header('Location:../index.php');
}

$usuario = $_SESSION['usuario'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php $obj->header(); ?>
    <script src="./js/home.js"></script>
</head>

<body>
    <?php   
    $obj->Menus($_SESSION['usuario']);
    ?>

    <!--Main layout-->
    <main style="margin-top: 10vh">
        <div class="container pt-4">
    <h2 class="text-center">Ventas</h2>
    <br>
             VENTAS <?php echo $usuario; ?>
        </div>
    </main>
    <!--Main layout-->


</body>

</html>