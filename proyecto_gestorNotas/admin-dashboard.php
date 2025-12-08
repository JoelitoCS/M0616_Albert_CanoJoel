<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Admin</title>
    <style>
        /* Reset y tipografía */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f6fa;
            color: #333;
        }

        /* Header */
        header {
            background-color: #4a90e2;
            color: white;
            padding: 30px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        header h1 {
            font-size: 32px;
            margin-bottom: 10px;
        }

        header p {
            font-size: 18px;
            opacity: 0.9;
        }

        /* Dashboard links */
        .dashboard {
            display: flex;
            flex-direction: column;
            gap: 20px;
            max-width: 900px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .card {
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.15);
        }

        .card a {
            text-decoration: none;
            color: #4a90e2;
            font-weight: 600;
            font-size: 18px;
            display: block;
            transition: color 0.3s ease;
        }

        .card a:hover {
            color: #357ab8;
        }

        /* Iconos (opcional, simples) */
        .card span {
            font-size: 36px;
            display: block;
            margin-bottom: 15px;
            color: #4a90e2;
        }

        /* Responsive */
        @media(max-width: 500px) {
            .dashboard {
                grid-template-columns: 1fr;
            }
        }

    </style>
</head>
<body>
    <header>
        <h1>Bienvenido, Admin</h1>
        <p>Selecciona una opción para comenzar a gestionar los siguientes apartados:</p>
    </header>

    <div class="dashboard">
        <div class="card">
            <span>👤</span>
            <a href="users-dhas">Usuarios</a>
            <h4 style="font-weight: 300;">En este apartado podrás crear, modificar y eliminar a cualquier estudiante registrado.</h4>
        </div>
        <div class="card">
            <span>📚</span>
            <a href="#">Módulos</a>
            <h4 style="font-weight: 300;">En este apartado podrás crear, modificar y eliminar cualquier módulo.</h4>
        </div>
        <div class="card">
            <span>📝</span>
            <a href="#">Notas</a>
            <h4 style="font-weight: 300;">En este apartado podrás crear, modificar y eliminar cualquiera de las notas registradas.</h4>
        </div>
    </div>
</body>
</html>
