<?php
 session_start();
 require'./conexion.php';
 $obj=new ConexionBD();
 if($_SESSION['usuario']==null || $_SESSION['usuario']==''){
    header('Location:../index.php');
 }
    
?>

<!DOCTYPE html>
<html lang="en">

<head> <?php $obj->header(); ?> </head>

<body>
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <?php $obj->Menus($_SESSION['usuario']);$obj->Fondo(); ?>
    </div>
    
</body>

</html>