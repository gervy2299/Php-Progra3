<?php
session_start();
require './conexion.php';
$obj = new ConexionBD();
if ($_SESSION['usuario'] == null || $_SESSION['usuario'] == '') {
  header('Location:../index.php');
}

$txtDni = (isset($_POST['dni'])) ? $_POST['dni'] : "";
$txtNombre = (isset($_POST['nombres'])) ? $_POST['nombres'] : "";
$txtPapellido = (isset($_POST['apepat'])) ? $_POST['apepat'] : "";
$txtSapellido = (isset($_POST['apemat'])) ? $_POST['apemat'] : "";

$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";

switch ($accion) {

  case 'Modificar':
    $sentenciaSQL = "UPDATE personas SET nom_persona = '" . $txtNombre . "', primer_apellido ='" . $txtPapellido . "', segundo_apellido='" . $txtSapellido . "' WHERE DNI = '" . $txtDni . "';";
    if (mysqli_query($obj->conectar(), $sentenciaSQL)) {
      header('location: ./personas.php');
    }
    break;

  case 'Cancelar':
    header('location: ./personas.php');
    break;

  case 'Seleccionar':
    echo 'seleccionando';
    // $sentenciaSQL = "SELECT * FROM proveedor where idproveedor = '".$idprov."';";
    $sentenciaSQL = "SELECT * from personas WHERE DNI = '" . $txtDni . "';";
    if (mysqli_query($obj->conectar(), $sentenciaSQL)) {
      foreach (($obj->conectar()->query($sentenciaSQL)) as $prov) {
        $txtDni = $prov['DNI'];
        $txtNombre = $prov['nom_persona'];
        $txtPapellido = $prov['primer_apellido'];
        $txtSapellido = $prov['segundo_apellido'];
      }
    }
    break;

  case 'Borrar':
    $sentenciaSQL = "DELETE FROM personas where DNI = '" . $txtDni . "';";
    if (mysqli_query($obj->conectar(), $sentenciaSQL)) {
      header('location: ./personas.php');
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
          <div class="col-sm-10 text-center">
            <button type="submit" <?php if ($accion == 'Seleccionar') {
                                    echo 'disabled';
                                  } ?> name='accion' value="Insertar" class="btn btn-primary">Insertar</button>
            <button type="submit" <?php if ($accion != 'Seleccionar') {
                                    echo 'disabled';
                                  } ?> name='accion' value="Modificar" class="btn btn-warning">Modificar</button>
            <button type="submit" <?php if ($accion != 'Seleccionar') {
                                    echo 'disabled';
                                  } ?> name='accion' value="Cancelar" class="btn btn-secondary">Cancelar</button>
          </div>
        </div>
      </form>
    </div>
    <div class="container pt-4">
      <table class="table table-striped table">
        <thead>
          <tr>
            <th scope="col">N°</th>
            <th scope="col">PRODUCTO</th>
            <th scope="col">PRECIO</th>
            <th scope="col">MARCA</th>
            <th scope="col">CARACTERISTICA</th>
            <th scope="col">ACCIONES</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql = 'select p.idproducto, p.nom_prod,p.precio,m.nom_marca,p.caract from productos p inner join marcas m on p.idmarca=m.idmarca order by p.nom_prod;';
          $item = 0;
          foreach ($obj->conectar()->query($sql) as $row) {
            $item++;
          ?>
            <tr>
              <th scope="row"><?php echo $item ?></th>
              <td><?php echo $row["nom_prod"] ?></td>
              <td><?php echo $row["precio"] ?></td>
              <td><?php echo $row["nom_marca"] ?></td>
              <td><?php echo $row["caract"] ?></td>
              <td>
                <form method="post">
                  <input type='hidden' name="dni" value="<?php echo $row['idproducto'] ?>"></input>
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