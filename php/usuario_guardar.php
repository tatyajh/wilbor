<?php
require_once 'main.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Obtener y limpiar datos del formulario
    $nombre = limpiar_cadena($_POST['nombre']);
    $apellido = limpiar_cadena($_POST['apellido']);
    $usuario = limpiar_cadena($_POST['usuario']);
    $email = limpiar_cadena($_POST['email']);
    $clave = limpiar_cadena($_POST['clave']);
    $telefono = limpiar_cadena($_POST['telefono']);
    
    // Establecer conexión con la base de datos
    $pdo = conexion();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    try {
        // Prueba de conexión con la base de datos
        $result = $pdo->query("SELECT NOW();");
        $currentTime = $result->fetch(PDO::FETCH_ASSOC);
        echo "La conexión a la base de datos es exitosa. Hora actual del servidor: " . $currentTime['NOW()'] . "<br>";

        // Verificar si el usuario o email ya existen
        $consulta = $pdo->prepare("SELECT * FROM usuario WHERE usuario_usuario = :usuario OR usuario_email = :email LIMIT 1");
        $consulta->execute([':usuario' => $usuario, ':email' => $email]);

        if ($consulta->fetch()) {
            echo 'El nombre de usuario o el correo electrónico ya están en uso.';
        } else {
            // Si no existen, insertar el nuevo usuario
            $claveHash = password_hash($clave, PASSWORD_BCRYPT);
            $consulta = $pdo->prepare("INSERT INTO usuario (usuario_nombre, usuario_apellido, usuario_usuario, usuario_email, usuario_clave, usuario_telefono) VALUES (:nombre, :apellido, :usuario, :email, :clave, :telefono)");

            if ($consulta->execute([':nombre' => $nombre, ':apellido' => $apellido, ':usuario' => $usuario, ':email' => $email, ':clave' => $claveHash, ':telefono' => $telefono])) {
                header("Location: ../HTML/InicioSesion.html");
                exit();
            } else {
                echo 'Ocurrió un error al registrar el usuario.';
            }
        }
    } catch (PDOException $e) {
        echo "Error en la operación de base de datos: " . $e->getMessage();
    }
}
?>
