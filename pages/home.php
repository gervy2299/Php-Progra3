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
        <?php 
        // $sql2 = 'select concat(per.nom_persona," ",per.primer_apellido) as empleado from empleados em inner join personas per on em.DNI=per.DNI where em.idempleado="'.$_SESSION['usuario'].'"';
        // $res_sql2 = $obj->conectar()->query($sql2);
        // $arr = mysqli_fetch_array($res_sql2);    
        $obj->Menus($_SESSION['usuario']);
        ?>

<!--Main layout-->
<main style="margin-top: 7vh">
  <div class="container pt-4">
  <form>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">DNI</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="inputEmail3" placeholder="DNI">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label">NOMBRE</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="inputPassword3" placeholder="Nombre">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label">APELLIDO PATERNO</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="inputPassword3" placeholder="Apellido Paterno">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label">APELLIDO MATERNO</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="inputPassword3" placeholder="Apellido Materno">
    </div>
  </div>


  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary">Agregar</button>
    </div>
  </div>
</form>
  </div>

  <!-- TABLA -->
  <div class="container pt-4" >
  <table class="table table-striped table-dark">
  <thead>
    <tr>
      <th scope="col">N°</th>
      <th scope="col">Empleado</th>
      <th scope="col">DNI</th>
      <th scope="col">Area</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $sql= 'SELECT
                concat(p.nom_persona," ", p.primer_apellido," ",p.segundo_apellido) as empleado,
                e.DNI as DNI,
                a.area as area
            FROM empleados e
            inner join personas p on e.DNI = p.DNI
            inner join areas a on e.idarea = a.idarea';
    $item=0;
            
    foreach ($obj->conectar()->query($sql) as $row) {
        $item++;
        echo '
                <tr>
                    <th scope="row">'.$item.'</th>
                    <td>'.$row["empleado"].'</td>
                    <td>'.$row["DNI"].'</td>
                    <td>'.$row["area"].'</td>
                    <td><i class="fa-solid fa-pen" style="margin-right: 20px;"></i><i class="fa-solid fa-trash"></i></td>
                </tr> '; 
    }
    
    ?>    
  </tbody>
</table>
  </div>
</main>
<!--Main layout-->

    
</body>

</html>