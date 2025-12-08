<?php

session_start();
require 'config.php';
if ($_SESSION['user_role'] !== 'admin') exit("Sense permisos");
$result = $mysqli->query("
SELECT 
    n.id,
    n.nota,
    u.nombre AS usuario,
    m.nombre AS modulo,
    m.codigo AS codigo_modulo,
    m.descripcion AS descripcion_modulo
FROM notas n
JOIN users u ON n.id_usuario = u.id
JOIN modulos m ON n.id_modulo = m.id
");
$notas = $result->fetch_all(MYSQLI_ASSOC);
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

    /* Título */
    h1 {
        text-align: center;
        margin-bottom: 40px;
        font-size: 2.5rem;
        color: #34495e;
        letter-spacing: 1px;
        font-weight: 600;
    }

    /* Botón */
    .add-btn {
        display: block;
        width: 200px;
        margin: 0 auto 40px auto;
        padding: 12px 0;
        background-color: #2980b9;
        color: #fff;
        text-align: center;
        text-decoration: none;
        font-size: 1.1rem;
        font-weight: 500;
        border-radius: 50px;
        transition: all 0.3s ease;
        box-shadow: 0 6px 15px rgba(41, 128, 185, 0.3);
    }

    .add-btn:hover {
        background-color: #3498db;
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 8px 20px rgba(41, 128, 185, 0.4);
    }

    /* Contenedor de tabla */
    .table-container {
        max-width: 1400px;
        margin: 0 auto 60px auto;
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        overflow-x: auto;
        padding: 20px 25px;
    }

    /* Tabla */
    table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        font-size: 1rem;
    }

    /* Encabezado */
    th {
        background: #ecf0f1;
        color: #2c3e50;
        font-weight: 600;
        padding: 14px 12px;
        text-align: left;
        border-bottom: 2px solid #bdc3c7;
    }

    /* Filas */
    td {
        padding: 12px 12px;
        border-bottom: 1px solid #ecf0f1;
        vertical-align: middle;
        word-break: break-word;
    }

    /* Efecto hover */
    tr:hover {
        background-color: #f1f5f8;
        transition: background 0.3s;
    }

    /* Celdas específicas */
    td.cuerpo {
        max-width: 220px;
    }

    td.imagen {
        max-width: 180px;
    }

    td.subtitulo {
        max-width: 140px;
    }

    /* Links */
    a {
        color: #2980b9;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.2s;
    }

    a:hover {
        text-decoration: underline;
    }
</style>


<h1>Notas</h1>
<a class="add-btn" href="addNotas.php">+ Añadir Nota</a>
<div class="table-container">
    <table>
        <tr>
            <th>ID</th>
            <th>Nota</th>
            <th>Código</th>
            <th>Descripción</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($notas as $n): ?>
            <tr>
                <td><?= $n['id'] ?></td>
                <td><?= $n['nota'] ?></td>
                <td><?= $n['codigo_modulo'] ?></td>
                <td><?= $n['descripcion_modulo'] ?></td>
                <td>
                    <a href="editNotas.php?id=<?= $n['id'] ?>">Editar</a> |
                    <a onclick="return confirm('¿Seguro que quieres eliminarlo?')" href="deleteNotas.php?id=<?= $n['id'] ?>">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <div style="margin-top: 
    40px;">
        <a href="admin-dashboard.php">Volver al Dashboard</a>
    </div>

</div>