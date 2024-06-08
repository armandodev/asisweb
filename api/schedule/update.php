<?php
require_once './../../config.php';

// Verificar si la solicitud es POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Obtener los datos del formulario
  $user_id = $_POST['user_id'];
  $ids = $_POST['id'];
  $subjects = $_POST['subject'];
  $groups = $_POST['group'];
  $start_times = $_POST['start_time'];

  // Iterar sobre los datos recibidos
  for ($i = 0; $i < count($ids); $i++) {
    $id = $ids[$i];
    $subject = $subjects[$i];
    $group = $groups[$i];
    $start_time = $start_times[$i];

    if ($id) {
      $sql = 'SELECT subject_id, group_id FROM schedule WHERE schedule_id = :schedule_id';
      $result = $db->execute($sql, ['schedule_id' => $id]);
      $class = $result->fetch(PDO::FETCH_ASSOC);

      if ($class['subject_id'] == $subject && $class['group_id'] == $group) {
        continue;
      }

      if (!$subject || !$group) {
        // Eliminar la clase si no hay materia o grupo
        $sql = 'DELETE FROM schedule WHERE schedule_id = :schedule_id';
        $db->execute($sql, ['schedule_id' => $id]);
        continue;
      }

      // Actualizar la clase
      $sql = 'UPDATE schedule SET subject_id = :subject_id, group_id = :group_id WHERE schedule_id = :schedule_id';
      $db->execute($sql, ['subject_id' => $subject, 'group_id' => $group, 'schedule_id' => $id]);
    } else {
      if (!$subject || !$group) {
        continue;
      }
      $day = $i % 5 + 1;

      // Insertar una nueva clase
      $sql = 'INSERT INTO schedule (subject_id, group_id, user_id, start_time, day) VALUES (:subject_id, :group_id, :user_id, :start_time, :day)';
      $db->execute($sql, ['subject_id' => $subject, 'group_id' => $group, 'user_id' => $user_id, 'start_time' => $start_time, 'day' => $day]);
    }
  }

  echo 'Datos actualizados correctamente';
  exit();
} else {
  echo 'Método no permitido';
  exit();
}
