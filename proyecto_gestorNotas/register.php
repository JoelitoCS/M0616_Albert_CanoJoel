<?php
session_start();
require_once 'config.php';


//Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    //1. Recoger los datos del formulario
    $nom = $_POST['nombre'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $rol = 'user'; 
    //2. Hasheamos la contraseña antes de guardarla
    $password_hasheada = password_hash($password, PASSWORD_DEFAULT);
    //3. Preparamos la consulta para insertar el nuevo usuario
    $stmt = $mysqli->prepare("INSERT INTO users (nombre, email, password, role, data_registre) VALUES (?, ?, ?, 'admin', NOW())");

    //4. Comprobamos si la preparación fue exitosa
    if (!$stmt){
        die("Error en la preparación de la consulta: " . $mysqli->error);
    }
    //5. Vinculamos los parámetros
    $stmt->bind_param("sss", $nom, $email, $password_hasheada);
    //6. Ejecutamos la consulta
    if ($stmt->execute()){
        echo "Registro exitoso. Ahora puedes <a href='login.php'>iniciar sesión</a>.";
    } else {
        echo "Error en el registro: " . $stmt->error;  
    }
    //7. Cerramos la declaración (conexion)
    $stmt->close();
    $mysqli->close();
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
</head>
<body>
    <h2>Registro de Usuario</h2>
    <!-- CREO EL FORMULARIO PARA NOM EMAIL PASSWORD -->
    <form method="POST" action="register.php">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required><br><br>
        
        <input type="submit" value="Registrar">
    </form>
</body>
</html>