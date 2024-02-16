<?php
session_start();
require_once 'main.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = limpiar_cadena($_POST['usuario']);
    $clave = limpiar_cadena($_POST['clave']);

    $conexion = conexion();
    $consulta = $conexion->prepare("SELECT * FROM usuario WHERE usuario_usuario = :usuario LIMIT 1");
    $consulta->execute([':usuario' => $usuario]);
    $resultado = $consulta->fetch(PDO::FETCH_ASSOC);

    if ($resultado && password_verify($clave, $resultado['usuario_clave'])) {
         $_SESSION['usuario_id'] = $resultado['usuario_id'];
        header("Location: ../HTML/Productos.html"); 
        exit();
    } else {
        echo 'Usuario o contraseña incorrectos.';
    }
}
?>
