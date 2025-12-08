<?php
session_start();
require_once 'config.php';


//Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //1. Recoger los datos del formulario
    $nom = $_POST['nombre'];
    $email = $_POST['email'];
    $apell = $_POST['apellidos'];
    $password = $_POST['password'];
    $rol = 'user';
    //2. Hasheamos la contraseña antes de guardarla
    $password_hasheada = password_hash($password, PASSWORD_DEFAULT);
    //3. Preparamos la consulta para insertar el nuevo usuario
    $stmt = $mysqli->prepare("INSERT INTO users (nombre, email, apellidos, password, role) VALUES (?, ?, ?, ?, 'student')");

    //4. Comprobamos si la preparación fue exitosa
    if (!$stmt) {
        die("Error en la preparación de la consulta: " . $mysqli->error);
    }
    //5. Vinculamos los parámetros
    $stmt->bind_param("ssss", $nom, $email, $apell, $password_hasheada);
    //6. Ejecutamos la consulta
    if ($stmt->execute()) {
        header("Location: login.php");
        exit();
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
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            width: 350px;
            text-align: center;
        }

        h2 {
            margin-bottom: 25px;
            color: #333;
        }

        /* Estilos de los inputs */
        input[type="email"],
        input[type="password"],
        input[type="text"] {
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
        <h2>Registro de Usuario</h2>
        <!-- CREO EL FORMULARIO PARA NOM EMAIL PASSWORD -->
        <form method="POST" action="register.php">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required><br><br>

            <label for="nombre">Apellidos:</label>
            <input type="text" id="apellidos" name="apellidos" required><br><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required><br><br>

            <input type="submit" value="Registrar">
        </form>
    </div>

</body>

</html>