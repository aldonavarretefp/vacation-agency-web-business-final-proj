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

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $paquete = $_POST['paquete'];
    $fecha_viaje = $_POST['fecha_viaje'];
    $num_personas = $_POST['num_personas'];
    $servicios = isset($_POST['servicios']) ? implode(", ", $_POST['servicios']) : '';
    $comentarios = isset($_POST['comentarios']) ? $_POST['comentarios'] : '';
    $fecha_registro = date('Y-m-d H:i:s');
    
    // Preparar la consulta SQL
    $sql = "INSERT INTO reservas (nombre, email, telefono, paquete, fecha_viaje, num_personas, servicios, comentarios, fecha_registro) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    // Preparar la sentencia
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssss", $nombre, $email, $telefono, $paquete, $fecha_viaje, $num_personas, $servicios, $comentarios, $fecha_registro);
    
    // Ejecutar la consulta
    if ($stmt->execute()) {
        // Redirigir a una página de confirmación
        header("Location: ../../html/confirmacion.html");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    
    // Cerrar la sentencia
    $stmt->close();
}

// Cerrar la conexión
$conn->close();
?>