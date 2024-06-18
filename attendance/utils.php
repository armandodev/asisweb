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
    $id = $class['schedule_id']; // Obtenemos el id de la clase
    $start_time = $class['start_time']; // Obtenemos la hora de inicio de la clase
    $day = $class['day']; // Obtenemos el día de la clase
    $subject = !empty($class['initialism']) ? $class['initialism'] : $class['subject_name']; // Obtenemos el nombre de la asignatura
    $group = $class['group_semester'] . $class['group_letter'] . ' - ' . (!empty($class['abbreviation']) ? $class['abbreviation'] : $class['career_name']); // Obtenemos el nombre del grupo
    $classroom = $class['classroom']; // Obtenemos el salón de la clase

    $schedule[$start_time][$day] = [ // Añadimos la clase al horario
      'id' => $id,
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
            'id' => '',
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
  $subjects = $db->fetch('SELECT subjects.subject_id, subjects.subject_name, subjects.initialism, groups.group_id, groups.group_semester, groups.group_letter, careers.career_name FROM schedule
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

function getScheduleId($subject_id, $group_id, $db)
{
  $schedule_id = $db->fetch('SELECT schedule_id FROM schedule WHERE user_id = :user_id AND subject_id = :subject_id AND group_id = :group_id', ['user_id' => $_SESSION['user']['user_id'], 'subject_id' => $subject_id, 'group_id' => $group_id]);
  if (!$schedule_id) return false;
  return $schedule_id;
}

function getGroupList($group_id, $db)
{
  $students = $db->fetch("SELECT first_name, last_name, group_list.control_number FROM group_list INNER JOIN students ON group_list.control_number = students.control_number WHERE group_id = :group_id ORDER BY last_name, first_name", ['group_id' => $group_id]);
  if (!$students) return false;
  return $students;
}

function getGroupInfo($group_id, $db)
{
  $group = $db->fetch("SELECT group_id, group_semester, group_letter, career_name FROM `groups` INNER JOIN careers ON groups.career_id = careers.career_id WHERE group_id = :group_id", ['group_id' => $group_id]);
  if (!$group) return false;
  return $group;
}

function getSubject($subject_id, $db)
{
  $subject = $db->fetch("SELECT subject_id, subject_name, initialism FROM subjects WHERE subject_id = :subject_id", ['subject_id' => $subject_id]);
  if (!$subject) return false;
  return $subject;
}

function getAttendanceReports($db)
{
  $reports = $db->execute('SELECT * FROM reports WHERE user_id = :user_id', ['user_id' => $_SESSION['user']['user_id']]);
  if ($reports->rowCount() == 0) return [];
  if (!$reports) return [];

  $reports = $reports->fetchAll(PDO::FETCH_ASSOC);
  return $reports;
}
