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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST["correo"];
    
    // Verificar si el correo existe en la base de datos
    $sql = "SELECT * FROM usuarios WHERE correo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Generar un token único
        $token = bin2hex(random_bytes(50));
        
        // Guardar el token en la base de datos
        $sql = "UPDATE usuarios SET token = ? WHERE correo = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $token, $correo);
        $stmt->execute();
        
        // Enviar un correo al usuario con el enlace para restablecer la contraseña
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'fabriciopradoyt5@gmail.com';
        $mail->Password = 'xhbe mabb oazn liev';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->setFrom('tu_correo@gmail.com', 'Fitfat');
        $mail->addAddress($correo);
        $mail->isHTML(true); // Establecer el correo electrónico en formato HTML
        $mail->CharSet = 'UTF-8'; // Establecer la codificación de caracteres a UTF-8
        $mail->Subject = 'Recuperación de contraseña de Fitfat';
        $mail->Body    = '
        <html>
        <head>
          <style>
            body {
              font-family: Arial, sans-serif;
            }
            .container {
              width: 600px;
              margin: 0 auto;
            }
            .header {
              background-color: rgba(136, 61, 138, 255); /* Color de fondo con opacidad al 60% */
              color: white;
              padding: 10px;
              text-align: center;
            }
            .content {
              margin: 20px 0;
            }
          </style>
        </head>
        <body>
          <div class="container">
            <div class="header">
              <h1>Fitfat</h1>
            </div>
            <div class="content">
              <p>Para restablecer tu contraseña, por favor haz clic en el siguiente enlace:</p>
              <a href="https://www.tusitio.com/restablecer_contrasena.php?token=' . $token . '">Restablecer contraseña</a>
            </div>
          </div>
        </body>
        </html>';
        
        if(!$mail->send()) {
            echo 'Error al enviar el correo.';
            echo 'Error: ' . $mail->ErrorInfo;
        } else {
            header("Location: correo_enviado.html");
        }
    } else {
        header("Location: correo_no_existe.html");
    }
} else {
    // Redirigir al usuario a la página de inicio o mostrar un mensaje de error.
}
?>
