<?php
session_start();
require 'config.php';

if ($_SESSION['user_role'] !== 'admin') exit("Sense permisos");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nombre'];
    $apell = $_POST['apellidos'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_hasheada = password_hash($password, PASSWORD_DEFAULT);
    $foto = $_POST['foto'];

    $stmt = $mysqli->prepare("INSERT INTO users (nombre, apellidos, email, password, foto) VALUES (?, ?, ?, ?, ?)");

    $stmt->bind_param("sssss", $nom, $apell, $email, $password_hasheada, $foto);
    $stmt->execute();
    header("Location: adminUsers.php");
    exit;
}
?>
<style>
/* Reset y tipografía */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Poppins', sans-serif;
    background: #f4f6f8;
    color: #2c3e50;
    min-height: 100vh;
    padding: 20px;
}

/* Contenedor del formulario */
.form-container {
    max-width: 500px;
    margin: 60px auto;
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    padding: 40px 30px;
}

/* Etiquetas */
.form-container label {
    font-weight: 500;
    color: #34495e;
    margin-bottom: 6px;
    display: block;
}

/* Inputs y textarea */
.form-container input[type="text"],
.form-container input[type="email"],
.form-container input[type="password"],
.form-container textarea {
    width: 100%;
    padding: 12px 14px;
    margin-bottom: 20px;
    border: 1px solid #dcdfe6;
    border-radius: 8px;
    background: #f9f9f9;
    color: #2c3e50;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.form-container input[type="text"]:focus,
.form-container input[type="email"]:focus,
.form-container input[type="password"]:focus,
.form-container textarea:focus {
    border-color: #2980b9;
    background: #ffffff;
    outline: none;
    box-shadow: 0 4px 12px rgba(41, 128, 185, 0.2);
}

/* Textarea más cómodo */
.form-container textarea {
    min-height: 80px;
    resize: vertical;
}

/* Botón */
.form-container input[type="submit"] {
    width: 100%;
    padding: 14px 0;
    background-color: #2980b9;
    color: #fff;
    font-size: 1.1rem;
    font-weight: 500;
    border: none;
    border-radius: 50px;
    cursor: pointer;
    box-shadow: 0 6px 15px rgba(41, 128, 185, 0.3);
    transition: all 0.3s ease;
}

.form-container input[type="submit"]:hover {
    background-color: #3498db;
    transform: translateY(-3px) scale(1.03);
    box-shadow: 0 8px 20px rgba(41, 128, 185, 0.4);
}
</style>

<div class="form-container">
    <form method="POST">
        <h1 style="margin-bottom:30px; font-size:20px;">Añadir Usuario</h1>
        <label>Nombre:</label><br>
        <input type="text" name="nombre" required><br><br>

        <label>Apellidos:</label><br>
        <input type="text" name="apellidos" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Contraseña:</label><br>
        <textarea name="password" required></textarea><br><br>

        <label>Foto:</label><br>
        <input type="text" name="foto"><br><br>

        <input type="submit" value="Añadir Usuario">
    </form>
</div>