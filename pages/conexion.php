<?php

  class ConexionBD{
    private $psw;
   private $usr;
   private $host;
   private $port;
   private $bd;
   private $conec;   
   public function __construct(){
    $this->host="localhost";
    $this->usr="root";
    $this->psw="";
    $this->bd="pr3_proyecto";
   }
   public function conectar(){
       $this->conec=new mysqli($this->host,$this->usr,$this->psw,$this->bd);
       if($this->conec->connect_error){
        die("No se logro la conexion: ".$this->conec->connect_error);
       }else{
        return $this->conec;
       }
   }

   public function header(){
    echo '
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="../img/logo.png"/>
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- CSS -->
    <link rel="stylesheet" href="../style.css">
        <!-- LINK FONTAWESOME -->
        <script src="https://kit.fontawesome.com/c997deb1aa.js" crossorigin="anonymous"></script>
    <title>Ampere Electrónica</title>
    ';
   }

   public function Menus($usu){
    echo'
    <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/unasam.png" alt="UnasamLogo" height="60" width="60">
    </div>
    <aside class="main-sidebar sidebar-dark-primary elevation-4 bg-danger">
    <a href="/" class="brand-link"><img src="dist/img/unasam.png" alt="UNASAM Logo" 
    class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-bold text-warning">SIGCONDIE</span>
    </a>
    <div class="sidebar">
     <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
       <img src="dist/img/avatar4.png" class="img-circle elevation-2" alt="User Image">
      </div>
     <div class="info"><a href="#" class="d-block">'.$usu.'</a>
    </div></div>
    <nav class="mt-2">
     <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" 
     role="menu" data-accordion="false">
      <li class="nav-item menu-open">
        <a href="#" class="nav-link active">
          <i class="nav-icon fas fa-duotone fa-camera-retro bg-warning"></i>
          <p>Tablas<i class="right fas fa-angle-left"></i></p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="./Facultades.php" class="nav-link active">
              <i class="far fa-circle nav-icon"></i>
              <p>Facultades</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./Facultades.php" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Escuelas</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./Facultades.php" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Tipo proyecto</p>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item menu-open">
        <a href="#" class="nav-link active">
          <i class="nav-icon fas fa fa-bars bg-warning"></i>
          <p>
            Procesos
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="./Facultades.php" class="nav-link active">
              <i class="far fa-circle nav-icon"></i>
              <p>Registro de Estudiantes</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./Facultades.php" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Registro de docentes</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./Facultades.php" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Registro del plan curricular</p>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item menu-open">
        <a href="#" class="nav-link active">
          <i class="nav-icon fas fa fa-bars bg-warning"></i>
          <p>Reportes<i class="right fas fa-angle-left"></i></p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
              <a href="./Facultades.php" target="_blank" class="nav-link active">
              <i class="far fa-circle nav-icon"></i>
              <p>Facultades</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./Facultades.php" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Escuelas</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./EscuelasxFacultad.php" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Escuelas por Facultad</p>
            </a>
          </li>
        </ul>
      </li>          
    </ul>
  </nav>
 </div>
 </aside>';
   }

   public function Fondo(){
    echo'<div class="content-wrapper bg-white"><section class="content">
     <div class="container-fluid"><div class="row">
     <div class="col-md-12" style="background-color: #eFF5EE">
     <img src="dist/img/logo.png" class="img-fluid"></div>
     </div></div></section></div>';
    }

  }

?>