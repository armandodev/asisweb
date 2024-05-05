<?php
function getGroupList($group_id, $db)
{
  $sql = "SELECT first_name, last_name, group_list.control_number, curp, generation FROM group_list INNER JOIN students ON group_list.control_number = students.control_number WHERE group_id = :group_id";
  $students = $db->execute($sql, ['group_id' => $group_id]);
  $students = $students->fetchAll(PDO::FETCH_ASSOC);

  return $students;
}
