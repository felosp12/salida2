<?php
// Datos de conexión a la base de datos MySQL
$servername = "localhost";
$username = "root";
$password = "clara1220"; // Cambia "tu_contraseña" por tu contraseña de MySQL
$dbname = "database_name"; // Cambia "database_name" por el nombre real de tu base de datos

// Crear una conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Si se envió el formulario para agregar un nuevo elemento al inventario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item = $_POST['item'];
    $insumo = $_POST['insumo'];
    $cantidad = $_POST['cantidad'];
    $valorUnidad = $_POST['valorUnidad'];
    $valorTotal = $cantidad * $valorUnidad;
    
    // Aquí deberías generar y guardar el código QR, y luego almacenar su ruta en la base de datos
    
    // Preparar la consulta SQL para insertar los datos en la tabla
    $sql = "INSERT INTO inventario (item, insumo, cantidad, valor_unidad, valor_total, codigo_QR) VALUES ('$item', '$insumo', '$cantidad', '$valorUnidad', '$valorTotal', 'ruta_del_codigo_qr')";
    
    // Ejecutar la consulta y verificar si fue exitosa
    if ($conn->query($sql) === TRUE) {
        echo "Nuevo elemento agregado al inventario.";
    } else {
        echo "Error al agregar el elemento al inventario: " . $conn->error;
    }
} else {
    // Si no se envió un formulario POST, se asume que se está solicitando la lista de elementos del inventario
    
    // Preparar y ejecutar la consulta SQL para obtener todos los registros de la tabla "inventario"
    $sql = "SELECT * FROM inventario";
    $result = $conn->query($sql);
    
    if (!$result) {
        // Manejar errores de consulta
        echo json_encode(["error" => "Error en la consulta: " . $conn->error]);
    } else {
        $data = array();
        if ($result->num_rows > 0) {
            // Almacenar los datos obtenidos de la tabla "inventario"
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        
        // Devolver los datos en formato JSON
        echo json_encode($data);
    }
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
