<?php
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

// Define una variable para el mensaje de error
$errorMsg = "";

// Verifica si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los valores del formulario
    $correo = $_POST["correo"];
    $contrasena = $_POST["contrasena"];

    // Consulta SQL para verificar las credenciales
    $consulta = "SELECT * FROM usuarios WHERE correo = '$correo' AND contrasena = '$contrasena'";
    $resultado = $conn->query($consulta);

    if ($resultado->num_rows > 0) {
        // Las credenciales son válidas, redirige al usuario a la página home.html
        header("Location: home.html");
    } else {
        header("Location: contraincorrecta.html");
    }
}

// Cierra la conexión a la base de datos
$conn->close();
?>
    <!-- Agrega un mensaje de error -->
    <?php
    if (!empty($errorMsg)) {
        echo '<div class="error-message">' . $errorMsg . '</div>';
    }
    ?>

    <!-- Formulario de inicio de sesión -->
    <form action="inicio_sesion.php" method="post">
        <!-- Campos de entrada de usuario y contraseña -->
        <input type="email" name="correo" required>
        <input type="password" name="contrasena" required>
        
        <!-- Botón de inicio de sesión -->
        <input type="submit" class="btnBanner" value="Iniciar Sesión">
    </form>
    
</body>
</html>
