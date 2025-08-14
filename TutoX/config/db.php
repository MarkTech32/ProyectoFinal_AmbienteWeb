<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "AmbWeb";

$conn = new mysqli($servername,$username, $password , $database);

if($conn -> connect_error){

    die($conn -> connect_error);

} else {
   echo"la conexcion OKAY";

}




//---------INSERTAR EN LA BD ----------//
/*
$sql = "INSERT INTO reservas(name,email,mensaje) VALUES ('Juan','juan2gmail.com','reserva a las 8pm de la noche en viernes')";

if ($conn ->query(query: $sql)){

    echo"Registro creado exitosamente";

} else {
    echo "error al agregar el registro";
}

*/
/*
//---------LEER EN LA BD ----------//
$sql = "SELECT *  FROM reservas";
$result = $conn -> query(query: $sql);

if ($result -> num_rows > 0) {

   while($row = $result -> fetch_assoc()){
      
  echo  $row["id"]."-".$row["name"]. "-".$row["email"]."-".$row["mensaje"]."<br>";

   }

} else {
    echo "no hay registros en reservas";
}

*/
// ---------UPDATE------------//
/*
$sql = "UPDATE reservas SET name  =  'Jose' where id=1";

if ($conn ->query(query: $sql)){

    echo"Update realizado exitosamente";

} else {
    echo "error al actualizar el registro";
}

*/



// ---------DELETE------------//
/*
$sql = "DELETE FROM reservas where id=2";

if ($conn ->query(query: $sql)){

    echo"Eliminacion realizado exitosamente";

} else {
    echo "error al eliminar el registro";
}
    
*/