<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "usuario_db";
$password = "password_db";
$dbname = "Eq13Travelworld";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta SQL para obtener todas las reservas
$sql = "SELECT * FROM reservas ORDER BY fecha_registro DESC";
$result = $conn->query($sql);

// Verificar si hay resultados
if ($result->num_rows > 0) {
    // Iniciar la página HTML
    echo "<!DOCTYPE html>
    <html lang='es'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Reporte de Reservas - TravelWorld</title>
        <link rel='stylesheet' href='styles.css'>
        <style>
            .report-container {
                max-width: 1200px;
                margin: 2rem auto;
                padding: 2rem;
                background-color: white;
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }
            
            .report-title {
                color: var(--primary-color);
                margin-bottom: 1.5rem;
                text-align: center;
            }
            
            .report-table {
                width: 100%;
                border-collapse: collapse;
            }
            
            .report-table th, .report-table td {
                padding: 0.8rem;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }
            
            .report-table th {
                background-color: var(--primary-color);
                color: white;
            }
            
            .report-table tr:hover {
                background-color: #f5f5f5;
            }
            
            .report-summary {
                margin-top: 2rem;
                padding: 1rem;
                background-color: #f9f9f9;
                border-radius: 4px;
            }
            
            .print-btn {
                display: inline-block;
                background-color: var(--primary-color);
                color: white;
                padding: 0.6rem 1.2rem;
                border-radius: 4px;
                text-decoration: none;
                margin-top: 1rem;
                cursor: pointer;
            }
            
            @media print {
                .print-btn {
                    display: none;
                }
            }
        </style>
    </head>
    <body>
        <div class='report-container'>
            <h1 class='report-title'>Reporte de Reservas</h1>
            
            <table class='report-table'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Paquete</th>
                        <th>Fecha de Viaje</th>
                        <th>Personas</th>
                        <th>Fecha de Registro</th>
                    </tr>
                </thead>
                <tbody>";
    
    // Contador para el total de reservas
    $totalReservas = 0;
    $totalPersonas = 0;
    
    // Mostrar los datos de cada fila
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["id"] . "</td>
                <td>" . $row["nombre"] . "</td>
                <td>" . $row["email"] . "</td>
                <td>" . $row["telefono"] . "</td>
                <td>" . $row["paquete"] . "</td>
                <td>" . $row["fecha_viaje"] . "</td>
                <td>" . $row["num_personas"] . "</td>
                <td>" . $row["fecha_registro"] . "</td>
              </tr>";
        
        $totalReservas++;
        $totalPersonas += $row["num_personas"];
    }
    
    echo "</tbody>
        </table>
        
        <div class='report-summary'>
            <h3>Resumen</h3>
            <p><strong>Total de reservas:</strong> " . $totalReservas . "</p>
            <p><strong>Total de personas:</strong> " . $totalPersonas . "</p>
            <p><strong>Fecha del reporte:</strong> " . date('Y-m-d H:i:s') . "</p>
        </div>
        
        <button class='print-btn' onclick='window.print()'>Imprimir Reporte</button>
    </div>
    </body>
    </html>";
} else {
    echo "No hay reservas registradas.";
}

// Cerrar la conexión
$conn->close();
?>