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

<head>
     <?php $obj->header(); ?> 
     <script src="./js/home.js"></script>
</head>

<body>
        <?php $obj->Menus($_SESSION['usuario']);
        echo '<a href="./salir.php" class="nav-link">salir';
        ?>

<!--Main layout-->
<main style="margin-top: 7vh">
  <div class="container pt-4">

  </div>
</main>
<!--Main layout-->

    
</body>

</html>