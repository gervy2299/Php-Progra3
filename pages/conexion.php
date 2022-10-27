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
  }

?>