<?php
// Incluir el archivo de configuración de la base de datos y cualquier otra configuración necesaria
require_once './../config.php';

// Verificar si se está recibiendo una solicitud POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir datos del formulario y asegurar que los datos están presentes
    $controlNumber = isset($_POST['control_number']) ? $_POST['control_number'] : null;
    $firstName = isset($_POST['first_name']) ? $_POST['first_name'] : null;
    $lastName = isset($_POST['last_name']) ? $_POST['last_name'] : null;
    $generation = isset($_POST['generation']) ? $_POST['generation'] : null;
    $groupSemester = isset($_POST['group_semester']) ? $_POST['group_semester'] : null;
    $groupLetter = isset($_POST['group_letter']) ? $_POST['group_letter'] : null;
    $careerName = isset($_POST['career_name']) ? $_POST['career_name'] : null;

    // Verificar si todos los datos requeridos están presentes
    if (!$controlNumber || !$firstName || !$lastName || !$generation || !$groupSemester || !$groupLetter || !$careerName) {
        $response = [
            'success' => false,
            'message' => 'Faltan datos obligatorios'
        ];
        // Devolver la respuesta como JSON
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }

    try {
        // Preparar la consulta SQL para actualizar el estudiante
        $sql = "UPDATE students 
                SET first_name = :first_name, 
                    last_name = :last_name, 
                    generation = :generation 
                WHERE control_number = :control_number";

        // Preparar y ejecutar la consulta
        $stmt = $db->prepare($sql);
        $stmt->execute([
            'control_number' => $controlNumber,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'generation' => $generation
        ]);

        // Verificar si la actualización fue exitosa
        if ($stmt->rowCount() > 0) {
            // Actualización exitosa
            $response = [
                'success' => true,
                'message' => 'Estudiante actualizado correctamente'
            ];
        } else {
            // No se encontró ningún estudiante para actualizar
            $response = [
                'success' => false,
                'message' => 'No se encontró ningún estudiante para actualizar'
            ];
        }
    } catch (PDOException $e) {
        // Error al ejecutar la consulta SQL
        $response = [
            'success' => false,
            'message' => 'Error al actualizar el estudiante: ' . $e->getMessage()
        ];
    }

    // Devolver la respuesta como JSON
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
} else {
    // Si la solicitud no es POST, devolver un error
    $response = [
        'success' => false,
        'message' => 'Método de solicitud no permitido'
    ];

    // Devolver la respuesta como JSON
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
?>

