<?php
function getGroupInfo($group_id, $db)
{
  $sql = "SELECT group_id, group_semester, group_letter, career_name FROM groups INNER JOIN careers ON groups.career_id = careers.career_id WHERE group_id = :group_id";
  $group = $db->execute($sql, ['group_id' => $group_id]);
  $group = $group->fetch(PDO::FETCH_ASSOC);

  return $group;
}

function getGroupList($group_id, $db)
{
  $sql = "SELECT first_name, last_name, group_list.control_number, curp, generation FROM group_list INNER JOIN students ON group_list.control_number = students.control_number WHERE group_id = :group_id ORDER BY last_name, first_name";
  $students = $db->execute($sql, ['group_id' => $group_id]);
  $students = $students->fetchAll(PDO::FETCH_ASSOC);

  return $students;
}
