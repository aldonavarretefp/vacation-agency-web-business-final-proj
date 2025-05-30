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
    $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';
    $asunto = $_POST['asunto'];
    $tipo_consulta = $_POST['tipo_consulta'];
    $destino_interes = isset($_POST['destino_interes']) ? $_POST['destino_interes'] : '';
    $mensaje = $_POST['mensaje'];
    $suscripcion = isset($_POST['suscripcion']) ? 1 : 0;
    $fecha_registro = date('Y-m-d H:i:s');
    
    // Preparar la consulta SQL
    $sql = "INSERT INTO contactos (nombre, email, telefono, asunto, tipo_consulta, destino_interes, mensaje, suscripcion, fecha_registro) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    // Preparar la sentencia
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssss", $nombre, $email, $telefono, $asunto, $tipo_consulta, $destino_interes, $mensaje, $suscripcion, $fecha_registro);
    
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