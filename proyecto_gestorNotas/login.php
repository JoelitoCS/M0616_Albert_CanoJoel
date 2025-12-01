<?php
session_start();
require_once 'config.php';

//1. Verificar si el formlario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    //2. Recoger los datos del formulario
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    //3. Preparar la consulta para buscar el usuario por email
    $stmt = $mysqli->prepare("SELECT id, nombre, apellidos , email, password, role FROM users WHERE email = ?");
    
    //4. Comprobar si la preparación fue exitosa
    if (!$stmt){
        die("Error en la preparación de la consulta: " . $mysqli->error);
    }

    //5. Vincular los parámetros
    $stmt->bind_param("s", $email);
    //6. Ejecutar la consulta
    $stmt->execute();
    //7. Obtener el resultado
    $result = $stmt->get_result();
    //8. Verificar si se encontró un usuario
    if ($result->num_rows === 1){
        $user = $result->fetch_assoc();
        //9. Verificar la contraseña
        if (password_verify($password, $user['password'])){
            //10. Iniciar sesión y almacenar datos del usuario en la sesión
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['nom'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_rol'] = $user['rol'];
            
            echo "Inicio de sesión exitoso. Bienvenido, " . htmlspecialchars($user['nom']) . "!";
            header("Location: index.php");
            exit();
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "No se encontró ningún usuario con ese email.";
    }

    $stmt->close();
    $mysqli->close();

}

?>

<!-- formulario para comprobar login con username y password -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0
">
    <title>Login de Usuario</title>
</head>
<body>
    <h2>Login de Usuario</h2>
    <form method="POST" action="login.php">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Iniciar Sesión">
    </form>
</body>
</html>