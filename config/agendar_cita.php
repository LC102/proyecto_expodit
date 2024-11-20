<?php
include 'conexion.php';
require_once '../vendor/autoload.php';
use Dotenv\Dotenv;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../Exception.php';
require '../PHPMailer.php';
require '../SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {


  if($_POST['nombre'] == ''){
      $_SESSION['errors'] = 'El nombre es obligatorio';
  }else{
    die("exit");
  }
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $motivo = $_POST['motivo'];

    $sql = "INSERT INTO citas (nombre, telefono, correo, fecha, hora, motivo)
            VALUES ('$nombre', '$telefono', '$correo', '$fecha', '$hora', '$motivo')";

    if ($conn->query($sql) === TRUE) {
      try{
        $mail = new PHPMailer(true);
    
        // Specify the path and upload your .env file 
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->load();

        $sender_email = $_ENV['SENDER_EMAIL'];
        $sender_password = $_ENV['SENDER_PASSWORD'];
        $mail->SMTPDebug = 0;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth = true;                                   // Enable SMTP authentication
        $mail->Username = $sender_email;                     // SMTP username
        $mail->Password = $sender_password;                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        $mail->CharSet = 'UTF-8';
    
        // Sender and recipient settings
        $mail->setFrom($sender_email, 'Email');
        $mail->addAddress( $correo, $nombre ); // Add a recipient
    
        // Email content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = 'Email tets"';
        $mail->Body = "TESTBody";
        $mail->send();
        echo 'Message has been sent successfully';


      }catch(Exception $e){
        echo $e->getMessage();
      }
    } else {
        // Mostrar mensaje de error en una ventana emergente
        echo "<script>
                alert('Error al agendar la cita: " . $conn->error . "');
                window.history.back();
              </script>";
    }
}

$conn->close();
?>


