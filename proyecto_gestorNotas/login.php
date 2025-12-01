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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Usuario</title>
    <style>
        /* Estilo global */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #74ebd5, #ACB6E5);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* Contenedor del formulario */
        .login-container {
            background-color: #ffffffdd;
            padding: 40px 30px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
            width: 350px;
            text-align: center;
        }

        h2 {
            margin-bottom: 25px;
            color: #333;
        }

        /* Estilos de los inputs */
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            margin: 8px 0 20px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
            transition: 0.3s;
            font-size: 14px;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #6a11cb;
            box-shadow: 0 0 5px rgba(106, 17, 203, 0.5);
            outline: none;
        }

        /* Estilo del botón */
        input[type="submit"] {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            transition: 0.3s;
        }

        input[type="submit"]:hover {
            background: linear-gradient(to right, #2575fc, #6a11cb);
            transform: scale(1.03);
        }

        /* Estilo de etiquetas */
        label {
            display: block;
            text-align: left;
            font-weight: bold;
            color: #555;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login de Usuario</h2>
        <form method="POST" action="login.php">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Iniciar Sesión">
        </form>
    </div>
</body>
</html>