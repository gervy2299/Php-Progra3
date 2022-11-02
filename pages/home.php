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
    <h2 class="text-center">Empleados</h2>
    <br>
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
    <div class="col-sm-10 text-center">
      <button type="submit" name="accion" value="Insertar" class="btn btn-primary">Insertar</button>
      <button type="submit" name="accion" value="Modificar" class="btn btn-warning">Modificar</button>
      <button type="submit" name="accion" value="Cancelar" class="btn btn-secondary">Cancelar</button>
    </div>
  </div>
</form>
  </div>

  <!-- TABLA -->
  <div class="container pt-4" >
  <table class="table table-striped table">
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
                e.idempleado as idempleado,
                concat(p.nom_persona," ", p.primer_apellido," ",p.segundo_apellido) as empleado,
                e.DNI as DNI,
                a.area as area
            FROM empleados e
            inner join personas p on e.DNI = p.DNI
            inner join areas a on e.idarea = a.idarea';
    $item=0;
            
    foreach ($obj->conectar()->query($sql) as $row) {
        $item++;
        
        ?>
                <tr>
                    <th scope="row"><?php echo $item; ?></th>
                    <td><?php echo $row["empleado"]?></td>
                    <td><?php echo $row["DNI"] ?></td>
                    <td><?php echo $row["area"] ?></td>
                    <td>
                      <form method="post">
                        <input type='hidden' name="idmarca" value="<?php echo $row['idempleado'];?>">
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