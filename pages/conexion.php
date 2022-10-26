<?php
$host="localhost";
$bd= "pr3_proyecto";
$user = "root";
$pass = "";

$conn = mysqli_connect($host,$user,$pass);

$bd = mysqli_select_db( $conn, $bd );

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
//   echo "Connected successfully";

//   $consulta = "SELECT * from empleados";
// 	$resultado = mysqli_query( $conn, $consulta );


//     echo "<table borde='2'>";
// 	echo "<tr>";
// 	echo "<th>Nombre</th>";
// 	echo "<th>Edad</th>";
// 	echo "</tr>";
	
// 	// Bucle while que recorre cada registro y muestra cada campo en la tabla.
// 	while ($columna = mysqli_fetch_array( $resultado ))
// 	{
// 		echo "<tr>";
// 		echo "<td>" . $columna['DNI'] . "</td><td>" . $columna['idempleado'] . "</td>";
// 		echo "</tr>";
// 	}
	
// 	echo "</table>"; // Fin de la tabla


?>