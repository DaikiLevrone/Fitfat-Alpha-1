<?php
$servername = "localhost";  
$username = "root";  
$password = "";  
$database = "Fitfat";  

// Conectarse a la base de datos
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("La conexión a la base de datos ha fallado: " . $conn->connect_error);
}

// Obtener el nombre del alimento desde la solicitud GET
$foodName = $_GET['nombre'];

// Consultar la base de datos para buscar el alimento
$sql = "SELECT nombre, calorias, proteinas, carbohidratos, grasas FROM comidas WHERE nombre = ?";
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("s", $foodName);
    $stmt->execute();
    $stmt->bind_result($nombre, $calorias, $proteinas, $carbohidratos, $grasas);

    if ($stmt->fetch()) {
        // Encontramos el alimento, devolverlo en formato JSON
        echo json_encode(array(
            "nombre" => $nombre,
            "calorias" => $calorias,
            "proteinas" => $proteinas,
            "carbohidratos" => $carbohidratos,
            "grasas" => $grasas
        ));
    } else {
        // Alimento no encontrado en la base de datos
        echo json_encode(null);
    }

    $stmt->close();
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
