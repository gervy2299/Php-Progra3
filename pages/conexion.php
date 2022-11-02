<?php

  class ConexionBD{
    private $psw;
   private $usr;
   private $host;
   private $port;
   private $bd;
   private $conec;   
   public function __construct(){
    $this->host="containers-us-west-108.railway.app";
    $this->usr="root";
    $this->psw="HkVNr6yKdrGZI74P03Rk";
    $this->bd="railway";
    $this->port="7450";
   }
   public function conectar(){
       $this->conec=new mysqli($this->host,$this->usr,$this->psw,$this->bd,$this->port);
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

        $cons = new ConexionBD;
        $sql2 = 'select concat(per.nom_persona," ",per.primer_apellido) as empleado from empleados em inner join personas per on em.DNI=per.DNI where em.idempleado="'.$usu.'"';
        $res_sql2 = $cons->conectar()->query($sql2);
        $arr = mysqli_fetch_array($res_sql2);

    echo'
    <!--Main Navigation-->
<header>
  <!-- Sidebar -->
  <nav
       id="sidebarMenu"
       class="collapse d-lg-block sidebar collapse bg-white"
       >
    <div class="position-sticky">
      <div class="list-group list-group-flush mx-3 mt-4">
        <a href="#"
           class="list-group-item list-group-item-action py-2 ripple active">
           <i class="fa-solid fa-user-astronaut">
            <span>'.$arr[0].'</span>
           </i>
        </a>
        <a
           href="./productos.php"
           class="list-group-item list-group-item-action py-2 ripple"
           aria-current="true"
           >
          <i class="fas fa-tachometer-alt fa-fw me-3"></i
            ><span>Productos</span>
        </a>
        <a
           href="./home.php"
           class="list-group-item list-group-item-action py-2 ripple "
           >
          <i class="fas fa-chart-area fa-fw me-3"></i
            ><span>Empleados</span>
        </a>
        <a
           href="./proveedores.php"
           class="list-group-item list-group-item-action py-2 ripple"
           ><i class="fas fa-lock fa-fw me-3"></i><span>Proveedores</span></a
          >
        <a
           href="./personas.php"
           class="list-group-item list-group-item-action py-2 ripple"
           ><i class="fas fa-chart-line fa-fw me-3"></i
          ><span>Personas</span></a
          >
        <a
           href="stock.php"
           class="list-group-item list-group-item-action py-2 ripple"
           >
          <i class="fas fa-chart-pie fa-fw me-3"></i><span>Stock</span>
        </a>
        <a
           href="./marcas.php"
           class="list-group-item list-group-item-action py-2 ripple"
           ><i class="fas fa-chart-bar fa-fw me-3"></i><span>Marcas</span></a
          >
        <a
           href="#"
           class="list-group-item list-group-item-action py-2 ripple"
           ><i class="fas fa-globe fa-fw me-3"></i
          ><span></span></a
          >
        <a
           href="#"
           class="list-group-item list-group-item-action py-2 ripple"
           ><i class="fas fa-building fa-fw me-3"></i
          ><span></span></a
          >
        <a
           href="#"
           class="list-group-item list-group-item-action py-2 ripple"
           ><i class="fas fa-calendar fa-fw me-3"></i
          ><span></span></a
          >
        <a
           href="#"
           class="list-group-item list-group-item-action py-2 ripple"
           ><i class="fas fa-users fa-fw me-3"></i><span></span></a
          >
        <a
           href="#"
           class="list-group-item list-group-item-action py-2 ripple"
           ><i class="fas fa-money-bill fa-fw me-3"></i><span></span></a
          >
      </div>
    </div>
  </nav>
  <!-- Sidebar -->

  <!-- Navbar -->
  <nav
       id="main-navbar"
       class="navbar navbar-expand-lg navbar-light bg-white fixed-top sombra"
       style="box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;"
       >
    <!-- Container wrapper -->
    <div class="container-fluid">
      <!-- Toggle button -->
      <button
              class="navbar-toggler"
              type="button"
              data-mdb-toggle="collapse"
              data-mdb-target="#sidebarMenu"
              aria-controls="sidebarMenu"
              aria-expanded="false"
              aria-label="Toggle navigation"
              >
        <i class="fas fa-bars"></i>
      </button>

      <!-- Brand -->
      <a class="navbar-brand" href="#">
        <img
             src="../img/logo.png"
             height="25"
             alt=""
             loading="lazy"
             />
             <label>Ampere Electrónica</label>
      </a>
      <!-- Search form -->
      <form class="d-none d-md-flex input-group w-auto my-auto">
        <input
               autocomplete="off"
               type="search"
               class="form-control rounded"
               placeholder="Search (ctrl + "/" to focus)"
               style="min-width: 225px"
               />
        <span class="input-group-text border-0"
              ><i class="fas fa-search"></i
          ></span>
      </form>

      <!-- Right links -->
      <ul class="navbar-nav ms-auto d-flex flex-row">

        <!-- Avatar -->
        <li class="nav-item dropdown">
          <a
             class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center"
             href="./salir.php"
             id="navbarDropdownMenuLink"
             role="button"
             data-mdb-toggle="dropdown"
             aria-expanded="false"
             >
             Logout  
            <img
                 src="../img/logo.png"
                 class="rounded-circle"
                 height="22"
                 alt=""
                 loading="lazy"
                 style="margin-left: 8px;"
                 />
          </a>
        </li>
      </ul>
    </div>
    <!-- Container wrapper -->
  </nav>
  <!-- Navbar -->
</header>
<!--Main Navigation-->';
   }

  }

?>