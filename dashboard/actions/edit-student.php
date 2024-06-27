<?php
require_once './../../config.php';

if (!isset($_SESSION['user'])) {
	header('Location: ./../../login.php');
	exit();
}

if (!$_SESSION['user']['role']) {
	header('Location: ./../../profile.php');
	exit();
}

if (!$_SERVER['REQUEST_METHOD'] === 'POST') {
	header('Location: ./../students.php');
	exit();
}

try {
	if (!isset($_POST['control_number']) || !isset($_POST['first_name']) || !isset($_POST['last_name']) || !isset($_POST['generation'])) throw new Exception('Todos los campos son obligatorios.');

	$control_number = $_POST['control_number'];
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$generation = $_POST['generation'];
	$group_id = $_POST['group_id'];

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

	if (!$update_student) throw new Exception('Error al actualizar los datos del alumno.');

	$update_group = $db->execute("
	UPDATE group_list
	SET group_id = :group_id
	WHERE control_number = :control_number", [
		'group_id' => $group_id,
		'control_number' => $control_number
	]);

	if (!$update_group) throw new Exception('Error al actualizar el grupo del alumno.');

	$_SESSION['info'] = [
		'title' => 'Datos actualizados correctamente.',
		'message' => 'Datos del alumno actualizados correctamente.'
	];
} catch (Exception $e) {
	$_SESSION['info'] = [
		'title' => 'Error',
		'message' => $e->getMessage()
	];
} finally {
	header('Location: ./../students.php');
}
