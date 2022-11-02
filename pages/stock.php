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
  <form method="POST" enctype="multipart/form-data">
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputEmail3" placeholder="Email">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputPassword3" placeholder="Password">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputPassword3" placeholder="Password">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary">Agregar</button>
    </div>
  </div>
</form>
  </div>
  <div class="container pt-4" >
  <table class="table table-striped table">
  <thead>
    <tr>
      <th scope="col">N°</th>
      <th scope="col">PRODUCTO</th>
      <th scope="col">CARACTERISTICA</th>
      <th scope="col">CANTIDAD</th>
      <th scope="col">PRECIO</th>
      <th scope="col">MARCA</th>
      <th scope="col">PROVEEDOR</th>
      <th scope="col">ACCIONES</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $sql= 'select pr.nom_prod,pr.caract,s.cantidad,pr.precio,m.nom_marca,em.raz_social  from  stock s INNER JOIN productos pr ON s.idproducto = pr.idproducto INNER JOIN marcas m ON pr.idmarca=m.idmarca INNER JOIN proveedor p ON s.idproveedor=p.idproveedor INNER JOIN empresa em ON em.RUC=p.RUC WHERE pr.nom_prod LIKE "%%"  ORDER by pr.nom_prod ;
    ';
    $item=0;
            
    foreach ($obj->conectar()->query($sql) as $row) {
        $item++;
        echo '
                <tr>
                    <th scope="row">'.$item.'</th>
                    <td>'.$row["nom_prod"].'</td>
                    <td>'.$row["caract"].'</td>
                    <td>'.$row["cantidad"].'</td>
                    <td>'.$row["precio"].'</td>
                    <td>'.$row["nom_marca"].'</td>
                    <td>'.$row["raz_social"].'</td>
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