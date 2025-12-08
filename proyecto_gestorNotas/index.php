<?php
session_start();
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>CRUD Proyecto</title>
    <style>
        /* Reset y tipografía */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
        }

        body {
            background-color: #f9f9f9;
            color: #333;
        }

        /* Header y menú */
        header {
            background-color: #ffffff;
            padding: 20px 40px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 22px;
            font-weight: 700;
            color: #222;
            letter-spacing: 1px;
        }

        nav ul {
            list-style: none;
            display: flex;
            gap: 20px;
        }

        nav ul li a {
            text-decoration: none;
            padding: 8px 14px;
            border-radius: 6px;
            color: #555;
            font-weight: 500;
            transition: all 0.25s ease;
            position: relative;
        }

        /* Hover minimalista */
        nav ul li a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            left: 0;
            bottom: 0;
            background-color: #4a90e2;
            transition: width 0.3s ease;
        }

        nav ul li a:hover {
            color: #222;
        }

        nav ul li a:hover::after {
            width: 100%;
        }

        /* Colores por rol */
        .admin-only {
            border: 1px solid #e67e22;
            color: #e67e22;
        }

        .admin-only:hover {
            background-color: #e67e22;
            color: #fff;
        }

        .alumno-only {
            border: 1px solid #2ecc71;
            color: #2ecc71;
        }

        .alumno-only:hover {
            background-color: #2ecc71;
            color: #fff;
        }

        /* Main */
        main {
            padding: 80px 20px;
            text-align: center;
            max-width: 900px;
            margin: 0 auto;
        }

        main h1 {
            font-size: 36px;
            margin-bottom: 20px;
            color: #222;
        }

        main p {
            font-size: 18px;
            color: #666;
            line-height: 1.6;
        }

        /* Botón minimalista */
        .button-sim {
            display: inline-block;
            margin-top: 30px;
            padding: 12px 28px;
            background-color: #4a90e2;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .button-sim:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0,0,0,0.15);
            background-color: #357ab8;
        }

        /* Responsive */
        @media(max-width: 768px) {
            nav ul {
                flex-direction: column;
                gap: 12px;
                margin-top: 10px;
            }
        }

    </style>
</head>
<body>
    <header>
        <nav>
            <div class="logo">CRUD Colegio</div>
            <ul>
                <li><a href="login.php">Iniciar sesión</a></li>
                <li><a href="register.php">Registrarse</a></li>
                <li><a href="logout.php">Cerrar sesión</a></li>
                <li><a href="student-dashboard.php" class="alumno-only">Editar Perfil</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === "admin"): ?>
        <h1>Bienvenido Admin, está es tu página para modificar y gestionar los alumnos, modulos y notas</h1>
        <p>Aquí abajo podrás acceder a los diferentes paneles de administración, solo haz clic en <em>"Gestionar Colegio"</em>.</p>
        <a href="admin-dashboard.php" class="button-sim">Gestionar Colegio</a>
        <?php else: ?>
        <h1>Bienvenido Alumno, a continuación podrás ver todos tus modulos y notas correspondientes</h1>
        
        <!-- Aqui ira todo el contenido para mostrar de modulos y notas segun el usuario -->
        <?php endif; ?>
    </main>
</body>
</html>
