<?php

require_once './../../config.php';

if (!isset($_SESSION['user']) || !$_SESSION['user']['role']) {
    header('Location: ./../profile.php');
    exit();
}

$response = ['status' => 'error', 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $control_number = $_POST['control_number'] ?? null;
    $first_name = $_POST['first_name'] ?? null;
    $last_name = $_POST['last_name'] ?? null;
    $generation = $_POST['generation'] ?? null;
    $group_semester = $_POST['group_semester'] ?? null;
    $group_letter = $_POST['group_letter'] ?? null;
    $career_name = $_POST['career_name'] ?? null;

    if (!$control_number || !$first_name || !$last_name || !$generation || !$group_semester || !$group_letter || !$career_name) {
        $response['message'] = 'Todos los campos son obligatorios.';
        error_log('Campos obligatorios faltantes: ' . json_encode($_POST));
    } else {
        try {
            $db->beginTransaction();

            $update_student = $db->execute("
                UPDATE students
                SET first_name = :first_name, last_name = :last_name, generation = :generation
                WHERE control_number = :control_number
            ", [
                'control_number' => $control_number,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'generation' => $generation
            ]);

            if ($update_student) {
                $update_group = $db->execute("
                    UPDATE groups
                    JOIN group_list ON groups.group_id = group_list.group_id
                    SET group_semester = :group_semester, group_letter = :group_letter, career_id = (SELECT career_id FROM careers WHERE career_name = :career_name LIMIT 1)
                    WHERE group_list.control_number = :control_number
                ", [
                    'group_semester' => $group_semester,
                    'group_letter' => $group_letter,
                    'career_name' => $career_name,
                    'control_number' => $control_number
                ]);

                if ($update_group) {
                    $db->commit();
                    $response['status'] = 'success';
                    $response['message'] = 'Datos del alumno actualizados correctamente.';
                } else {
                    $db->rollBack();
                    $response['message'] = 'Error al actualizar el grupo del alumno.';
                    error_log('Error al actualizar el grupo del alumno.');
                }
            } else {
                $db->rollBack();
                $response['message'] = 'Error al actualizar los datos del alumno.';
                error_log('Error al actualizar los datos del alumno.');
            }
        } catch (Exception $e) {
            $db->rollBack();
            $response['message'] = 'Error: ' . $e->getMessage();
            error_log('Excepción capturada: ' . $e->getMessage());
        }
    }
} else {
    $response['message'] = 'Método no permitido.';
    error_log('Método no permitido.');
}

header('Content-Type: application/json');
echo json_encode($response);
?>
