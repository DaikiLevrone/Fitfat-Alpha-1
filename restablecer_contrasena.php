<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$servername = "localhost";
$username = "root";
$password = "";
$database = "Fitfat";

// Conectarse a la base de datos
$conn = new mysqli($servername, $username, $password, $database);

// Verifica la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["token"])) {
    $token = $_POST["token"];
    $nueva_contrasena = $_POST["nueva_contrasena"];
    
    // Verificar si el token existe en la base de datos y obtener el correo asociado
    $sql = "SELECT correo FROM usuarios WHERE token = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Actualizar la contraseña en la base de datos
        $sql = "UPDATE usuarios SET contrasena = ? WHERE token = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $nueva_contrasena, $token);
        $stmt->execute();
        
        // Eliminar el token para que no se pueda utilizar nuevamente
        $sql = "UPDATE usuarios SET token = NULL WHERE token = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $token);
        $stmt->execute();
        
        echo "Contraseña restablecida exitosamente. Puedes <a href='http://localhost:3000/restablecer_contrasena.html'>iniciar sesión</a>.";
    } else {
        echo "Token no válido o expirado. Por favor, solicita otro enlace de restablecimiento de contraseña.";
    }
} else {
    // Redirigir al usuario a la página de inicio o mostrar un mensaje de error.
}
?>
