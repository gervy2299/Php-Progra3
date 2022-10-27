<?php
 session_start(); 
 $_SESSION['usuario'] = $_POST['usuario'];
 require_once'./conexion.php';
 $action=$_POST["btaccede"];
 
 switch($action){
  case"aceptar":{
    $cnx=new ConexionBD();
    $sql="select * from empleados where idempleado='".$_POST["usuario"]."' and DNI='".$_POST["pass"]."'";
    $resultado = $cnx->conectar()->query($sql);
    if ($resultado->num_rows==0) {
    echo 'ingresaste';
     header('location:home.php');
    }
    else{
     header('location:index.php');
    }
    break;
  }
 }

//  EMP0001
//  70554420
?>