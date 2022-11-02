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
</head>

<body>
        <?php $obj->Menus($_SESSION['usuario']);?>

<!--Main layout-->
<main style="margin-top: 7vh">
  <div class="container pt-4">
  <form action="./iud_proveedores.php" method="post" enctype="multipart/form-data">
  <!-- <form method="post" enctype="multipart/form-data"> -->
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">DNI</label>
    <div class="col-sm-10">
      <input type="number" class="form-control" id="inputEmail3" name="dni" placeholder="DNI">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">NOMBRES</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputEmail3" name="nombres" placeholder="NOMBRES">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">APELLIDO PATERNO</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputEmail3" name="apepat" placeholder="APELLIDO PATERNO">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">APELLIDO MATERNO</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputEmail3" name="apemat" placeholder="APELLIDO MATERNO">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">RUC</label>
    <div class="col-sm-10">
      <input type="number" class="form-control" id="inputEmail3" name="ruc" placeholder="RUC">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">NOMBRE DE LA EMPRESA</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputEmail3" name="nomemp" placeholder="NOMBRE DE LA EMPRESA">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">DIRECCION DE LA EMPRESA</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputEmail3" name="diremp" placeholder="NOMBRE DE LA EMPRESA">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary">Insertar</button>
    </div>
  </div>
</form>
  </div>
  <?php
  print_r($_POST);
  ?>
  <div class="container pt-4" >
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
    $sql= 'select
    per.DNI as DNI, 
    concat(per.nom_persona," ", per.primer_apellido," ",per.segundo_apellido) as persona,
    em.RUC as RUC,
    em.raz_social as empresa,
    em.direc as direccion
    from proveedor pro
    inner join personas per on pro.DNI=per.DNI
    inner join empresa em on pro.RUC=em.RUC;';
    $item=0;
            
    foreach ($obj->conectar()->query($sql) as $row) {
        $item++;
        echo '
                <tr>
                    <th scope="row">'.$item.'</th>
                    <td>'.$row["DNI"].'</td>
                    <td>'.$row["persona"].'</td>
                    <td>'.$row["RUC"].'</td>
                    <td>'.$row["empresa"].'</td>
                    <td>'.$row["direccion"].'</td>
                    <td>
                      <a href="#" class="text-warning"><i class="fa-solid fa-pen" style="margin-right: 20px;"></i></a>
                      <a href="#" class="text-danger"><i class="fa-solid fa-trash"></i></a>
                    </td>
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