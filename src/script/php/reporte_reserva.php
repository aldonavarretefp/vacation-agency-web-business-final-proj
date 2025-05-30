<?php
<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "eq13Travelworld";

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
        <link rel='stylesheet' href='../../css/style.css'>
        <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap' rel='stylesheet'>
        <style>
            .report-container {
                max-width: 1200px;
                margin: 2rem auto;
                padding: 2rem;
                background-color: white;
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }
            
            .page-header {
                background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('../../images/hero-bg.jpg');
                background-size: cover;
                background-position: center;
                color: white;
                text-align: center;
                padding: 6rem 0;
                margin-bottom: 3rem;
            }
            
            .report-title {
                color: white;
                margin-bottom: 1rem;
                font-size: 3rem;
                font-weight: 700;
            }
            
            .report-subtitle {
                font-size: 1.2rem;
                opacity: 0.9;
            }
            
            .report-table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 2rem;
                background: white;
                border-radius: 8px;
                overflow: hidden;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            }
            
            .report-table th, .report-table td {
                padding: 1rem;
                text-align: left;
                border-bottom: 1px solid #eee;
            }
            
            .report-table th {
                background: var(--primary-color);
                color: white;
                font-weight: 600;
                text-transform: uppercase;
                font-size: 0.9rem;
                letter-spacing: 0.5px;
            }
            
            .report-table tr:hover {
                background-color: #f8f9fa;
            }
            
            .report-table td {
                color: #555;
            }
            
            .report-summary {
                background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
                color: white;
                padding: 2rem;
                border-radius: 8px;
                margin-top: 2rem;
            }
            
            .report-summary h3 {
                color: white;
                margin-bottom: 1rem;
                font-size: 1.5rem;
            }
            
            .summary-stats {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 1rem;
                margin-top: 1rem;
            }
            
            .stat-item {
                background: rgba(255, 255, 255, 0.1);
                padding: 1rem;
                border-radius: 6px;
                text-align: center;
            }
            
            .stat-number {
                font-size: 2rem;
                font-weight: 700;
                display: block;
            }
            
            .stat-label {
                font-size: 0.9rem;
                opacity: 0.9;
            }
            
            .btn-group {
                display: flex;
                gap: 1rem;
                justify-content: center;
                margin-top: 2rem;
            }
            
            .btn {
                display: inline-block;
                background: var(--primary-color);
                color: white;
                padding: 0.8rem 1.5rem;
                border-radius: 5px;
                text-decoration: none;
                font-weight: 500;
                transition: all 0.3s ease;
                border: none;
                cursor: pointer;
            }
            
            .btn:hover {
                background: var(--secondary-color);
                transform: translateY(-2px);
            }
            
            .btn-secondary {
                background: #6c757d;
            }
            
            .btn-secondary:hover {
                background: #545b62;
            }
            
            @media print {
                .btn-group, header, footer {
                    display: none;
                }
                .page-header {
                    background: var(--primary-color);
                    print-color-adjust: exact;
                }
            }
            
            @media (max-width: 768px) {
                .report-table {
                    font-size: 0.8rem;
                }
                
                .report-table th,
                .report-table td {
                    padding: 0.5rem;
                }
                
                .summary-stats {
                    grid-template-columns: 1fr;
                }
            }
        </style>
    </head>
    <body>
        <header>
            <div class='container'>
                <div class='header-content'>
                    <a href='../../../index.html' class='logo'>Travel<span>World</span></a>
                    <nav>
                        <ul>
                            <li><a href='../../../index.html'>Inicio</a></li>
                            <li><a href='../../pages/destinos.html'>Destinos</a></li>
                            <li><a href='../../pages/paquetes.html'>Paquetes</a></li>
                            <li><a href='../../pages/nosotros.html'>Nosotros</a></li>
                            <li><a href='../../pages/contacto.html'>Contacto</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </header>

        <section class='page-header'>
            <div class='container'>
                <h1 class='report-title'>Reporte de Reservas</h1>
                <p class='report-subtitle'>Administración de reservas - TravelWorld</p>
            </div>
        </section>

        <section class='section'>
            <div class='container'>
                <div class='report-container'>
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
                        <h3>📊 Resumen del Reporte</h3>
                        <div class='summary-stats'>
                            <div class='stat-item'>
                                <span class='stat-number'>" . $totalReservas . "</span>
                                <span class='stat-label'>Total de Reservas</span>
                            </div>
                            <div class='stat-item'>
                                <span class='stat-number'>" . $totalPersonas . "</span>
                                <span class='stat-label'>Total de Personas</span>
                            </div>
                            <div class='stat-item'>
                                <span class='stat-number'>" . date('d/m/Y') . "</span>
                                <span class='stat-label'>Fecha del Reporte</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class='btn-group'>
                        <button class='btn' onclick='window.print()'>🖨️ Imprimir Reporte</button>
                        <a href='../../pages/paquetes.html' class='btn btn-secondary'>⬅️ Volver a Paquetes</a>
                    </div>
                </div>
            </div>
        </section>

        <footer>
            <div class='container'>
                <div class='footer-content'>
                    <div class='footer-column'>
                        <h3>TravelWorld</h3>
                        <p>Tu agencia de viajes de confianza desde 2005.</p>
                    </div>
                    <div class='footer-column'>
                        <h3>Enlaces rápidos</h3>
                        <ul>
                            <li><a href='../../../index.html'>Inicio</a></li>
                            <li><a href='../../pages/destinos.html'>Destinos</a></li>
                            <li><a href='../../pages/paquetes.html'>Paquetes</a></li>
                            <li><a href='../../pages/nosotros.html'>Nosotros</a></li>
                            <li><a href='../../pages/contacto.html'>Contacto</a></li>
                        </ul>
                    </div>
                    <div class='footer-column'>
                        <h3>Contacto</h3>
                        <ul>
                            <li>Email: info@travelworld.com</li>
                            <li>Teléfono: +123 456 7890</li>
                            <li>Dirección: Av. Principal 123, Ciudad</li>
                        </ul>
                    </div>
                    <div class='footer-column'>
                        <h3>Síguenos</h3>
                        <ul class='social-links'>
                            <li><a href='https://facebook.com' target='_blank'>Facebook</a></li>
                            <li><a href='https://instagram.com' target='_blank'>Instagram</a></li>
                            <li><a href='https://twitter.com' target='_blank'>Twitter</a></li>
                        </ul>
                    </div>
                </div>
                <div class='copyright'>
                    <p>&copy; 2023 TravelWorld. Todos los derechos reservados.</p>
                </div>
            </div>
        </footer>
    </body>
    </html>";
} else {
    echo "<!DOCTYPE html>
    <html lang='es'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Sin Reservas - TravelWorld</title>
        <link rel='stylesheet' href='../../css/style.css'>
    </head>
    <body>
        <div class='container' style='text-align: center; margin-top: 4rem;'>
            <h2>No hay reservas registradas</h2>
            <a href='../../pages/paquetes.html' class='btn'>Volver a Paquetes</a>
        </div>
    </body>
    </html>";
}

// Cerrar la conexión
$conn->close();
?>