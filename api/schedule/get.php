<?php
function getSchedule($user_id, $db)
{
  $sql = 'SELECT start_time, subject_name, initialism, group_semester, group_letter, career_name, abbreviation, classroom, day FROM schedule
          INNER JOIN subjects ON schedule.subject_id = subjects.subject_id
          INNER JOIN groups ON schedule.group_id = groups.group_id
          INNER JOIN careers ON groups.career_id = careers.career_id
          WHERE user_id = :user_id AND start_time = :start_time';

  $sql_empty = 'SELECT start_time, subject_name, day FROM schedule INNER JOIN subjects ON schedule.subject_id = subjects.subject_id WHERE start_time = :start_time';

  $schedule = [];

  foreach (HOURS as $hour) {
    $class_hour = $hour['hour'];
    $schedule[$class_hour] = [
      'Lunes' => '',
      'Martes' => '',
      'Miércoles' => '',
      'Jueves' => '',
      'Viernes' => ''
    ];
  }

  foreach (HOURS as $hour) {
    $class_hour = $hour['hour'];
    $start_time = $hour['start'];
    $result = $db->execute($sql, ['user_id' => $user_id, 'start_time' => $start_time]);
    $classes = $result->fetchAll(PDO::FETCH_ASSOC);

    foreach ($classes as $class) {
      $day = $class['day'];
      $subject = $class['initialism'] ? $class['initialism'] : $class['subject_name'];
      $group = $class['group_semester'] . $class['group_letter'] . ' - ' . ($class['abbreviation'] ? $class['abbreviation'] : $class['career_name']);
      $classroom = $class['classroom'];

      $schedule[$class_hour][$day] = [
        'subject' => $subject,
        'group' => $group,
        'classroom' => "Aula $classroom"
      ];
    }

    $result = $db->execute($sql_empty, ['start_time' => $start_time]);
    $empty_classes = $result->fetchAll(PDO::FETCH_ASSOC);

    foreach ($empty_classes as $class) {
      $day = $class['day'];
      $subject = $class['subject_name'];

      if ($schedule[$class_hour][$day] === '') {
        $schedule[$class_hour][$day] = [
          'subject' => $subject,
          'group' => '',
          'classroom' => ''
        ];
      }
    }
  }

  return $schedule;
}

function getGroupSchedule($group_id, $db)
{
  $sql = 'SELECT start_time, subject_name, initialism, day FROM schedule
          INNER JOIN subjects ON schedule.subject_id = subjects.subject_id
          WHERE group_id = :group_id AND start_time = :start_time';

  $schedule = [];

  foreach (HOURS as $hour) {
    $class_hour = $hour['hour'];
    $schedule[$class_hour] = [
      'Lunes' => '',
      'Martes' => '',
      'Miércoles' => '',
      'Jueves' => '',
      'Viernes' => ''
    ];
  }

  foreach (HOURS as $hour) {
    $class_hour = $hour['hour'];
    $start_time = $hour['start'];
    $result = $db->execute($sql, ['group_id' => $group_id, 'start_time' => $start_time]);
    $classes = $result->fetchAll(PDO::FETCH_ASSOC);

    foreach ($classes as $class) {
      $day = $class['day'];
      $subject = $class['initialism'] ? $class['initialism'] : $class['subject_name'];

      $schedule[$class_hour][$day] = $subject;
    }
  }

  return $schedule;
}
