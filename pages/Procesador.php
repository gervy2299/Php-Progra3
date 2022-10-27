<?php
 session_start(); 
 $usuario = $_POST['usuario'];
 $_SESSION["usuario"] = $usuario;
 require_once'./conexion.php';
 
 switch($_POST["btaccede"]){
  case"aceptar":{
    $cnx=new ConexionBD();
    // $sql = "select true";
    $sql="select * from empleados where idempleado='".$_POST["usuario"]."' and DNI='".$_POST["pass"]."'";
    $resultado = $cnx->conectar()->query($sql);
    if ($resultado->num_rows==1) {
      // echo 'accdiste '.$_SESSION["usuario"];
     header('location:./home.php');
    }
    else{
      // echo 'no accdiste';
     header('location:../index.php');
    }
    break;
  }
 }

//  EMP0001
//  70554420
?>