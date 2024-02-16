<?php
$host = "localhost"; 
$dbname = "inventario"; 
$username = "root"; 
$password = ""; 

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   
    $nombreApellido = $_POST['nombreapellido'] ?? '';
    $correoElectronico = $_POST['correoelectronico'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $mensaje = $_POST['mensaje'] ?? '';
    $contacto = $_POST['contacto'] ?? '';
    $horario = $_POST['horario'] ?? ''; 
    $deseaRecibirNovedades = isset($_POST['novedades']) ? 1 : 0; 

 
    $sql = "INSERT INTO contactos (nombreApellido, correoElectronico, telefono, mensaje, contacto, horario, deseaRecibirNovedades) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt= $conn->prepare($sql);
    $stmt->execute([$nombreApellido, $correoElectronico, $telefono, $mensaje, $contacto, $horario, $deseaRecibirNovedades]);

    echo "Formulario enviado con éxito";
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
