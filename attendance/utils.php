<?php
function getSchedule($params, $db)
{
  $schedule = []; // Inicializamos el horario vacío
  if (!isset($params['user_id']) && !isset($params['group_id'])) return $schedule; // Retornamos un horario vacío si no hay parámetros válidos

  foreach (range(7, 15) as $hour) { // Iteramos sobre las horas del día
    $formatted_hour = sprintf('%02d:00:00', $hour); // Formateamos la hora en formato '00:00:00'
    $schedule[$formatted_hour] = [ // Añadimos la hora a la tabla con sus respectivos días de la semana
      'Lunes' => '',
      'Martes' => '',
      'Miércoles' => '',
      'Jueves' => '',
      'Viernes' => ''
    ];
  }

  $sql = 'SELECT schedule_id, schedule.subject_id, schedule.group_id, start_time, subjects.subject_name, subjects.initialism, groups.group_semester, groups.group_letter, careers.career_name, careers.abbreviation, groups.classroom, day
      FROM schedule
      INNER JOIN subjects ON schedule.subject_id = subjects.subject_id
      LEFT JOIN `groups` ON schedule.group_id = `groups`.group_id
      LEFT JOIN careers ON `groups`.career_id = careers.career_id';

  $sql .= isset($params['user_id']) ? ' WHERE schedule.user_id = :user_id' : ' WHERE schedule.group_id = :group_id';

  $classes = $db->fetch($sql, $params); // Obtenemos los horarios del grupo o del usuario ingresado
  if (!$classes) $classes = []; // Si no hay clases, retornamos un horario vacío

  // Iteramos sobre las clases obtenidas y las añadimos al horario
  foreach ($classes as $class) {
    $start_time = $class['start_time']; // Obtenemos la hora de inicio de la clase
    $day = $class['day']; // Obtenemos el día de la clase
    $subject = !empty($class['initialism']) ? $class['initialism'] : $class['subject_name']; // Obtenemos el nombre de la asignatura
    $group = $class['group_semester'] . $class['group_letter'] . ' - ' . (!empty($class['abbreviation']) ? $class['abbreviation'] : $class['career_name']); // Obtenemos el nombre del grupo
    $classroom = $class['classroom']; // Obtenemos el salón de la clase

    $schedule[$start_time][$day] = [ // Añadimos la clase al horario
      'subject' => $subject,
      'group' => $group,
      'classroom' => "Aula $classroom",
      'start_time' => $start_time,
    ];
  }

  // Completamos las horas vacías con "Comisión" si el docente es de tiempo completo o con "Sin asignar" si no lo es, solo si consultamos por user_id
  if (isset($params['user_id'])) {
    $user = $db->fetch('SELECT full_time FROM users WHERE user_id = :user_id', ['user_id' => $params['user_id']]); // Obtenemos el estado del docente
    foreach ($schedule as $hour => $days) {
      foreach ($days as $day => $class) {
        if (empty($class)) {
          $schedule[$hour][$day] = [
            'subject' => $user['full_time'] ? 'Comisión' : 'Sin asignar',
            'group' => '',
            'classroom' => '',
            'start_time' => $hour,
          ];
        }
      }
    }
  }

  return $schedule;
}

// Obtiene los grupos y asignaciones que se asignan a un docente a partir de su horario
function getSubjectsBySchedule($params, $db)
{
  // Obtenemos las clases del docente a partir de su horario
  $subjects = $db->fetch('SELECT subjects.subject_id, subjects.subject_name, subjects.initialism, groups.group_semester, groups.group_letter, careers.career_name FROM schedule
      INNER JOIN subjects ON schedule.subject_id = subjects.subject_id
      LEFT JOIN `groups` ON schedule.group_id = `groups`.group_id
      LEFT JOIN careers ON `groups`.career_id = careers.career_id
      WHERE schedule.user_id = :user_id
      ORDER BY groups.group_semester, groups.group_letter', $params);

  // Validamos que recibimos al menos un registro
  if (!$subjects) return [];

  // Eliminamos los grupos duplicados
  $subjects = array_unique($subjects, SORT_REGULAR);
  return $subjects;
}

// Obtiene las listas de los grupos a través de su horario
function getGroupList($group_id, $db)
{
  $group_list = [];
  $schedule = getSchedule(['group_id' => $group_id], $db);

  foreach ($schedule as $hour => $days) {
    foreach ($days as $day => $class) {
      if (!empty($class)) {
        $group_list[] = [
          'group_id' => $class['group_id'],
          'group_semester' => $class['group_semester'],
          'group_letter' => $class['group_letter'],
          'career_name' => $class['career_name'],
          'subject_name' => $class['subject']['subject_name'],
          'initialism' => $class['subject']['initialism'],
          'classroom' => $class['classroom'],
          'day' => $day,
        ];
      }
    }
  } // Obtenemos las listas de los grupos a través de su horario

  return $group_list;
}

// Obtiene los grupos a través de su horario
function getGroupInfo($group_id, $db)
{
  $group_info = [];
  $schedule = getSchedule(['group_id' => $group_id], $db);

  foreach ($schedule as $hour => $days) {
    foreach ($days as $day => $class) {
      if (!empty($class)) {
        $group_info[] = [
          'group_id' => $class['group_id'],
          'group_semester' => $class['group_semester'],
          'group_letter' => $class['group_letter'],
          'career_name' => $class['career_name'],
          'subject_name' => $class['subject']['subject_name'],
          'initialism' => $class['subject']['initialism'],
          'classroom' => $class['classroom'],
          'day' => $day,
        ];
      }
    }
  }

  return $group_info;
}

// Obtiene la asignación de un grupo a un docente a partir de su horario
function getSubject($subject_id, $db)
{
  $subject = [];
  $schedule = getSchedule(['subject_id' => $subject_id], $db);

  foreach ($schedule as $hour => $days) {
    foreach ($days as $day => $class) {
      if (!empty($class)) {
        $subject[] = [
          'subject_id' => $class['subject_id'],
          'subject_name' => $class['subject']['subject_name'],
          'initialism' => $class['subject']['initialism'],
          'group_id' => $class['group_id'],
          'group_semester' => $class['group_semester'],
          'group_letter' => $class['group_letter'],
          'career_name' => $class['career_name'],
          'classroom' => $class['classroom'],
          'start_time' => $hour,
          'day' => $day,
        ];
      }
    }
  }

  return $subject;
}
