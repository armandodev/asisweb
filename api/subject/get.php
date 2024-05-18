<?php
function getSubject($subject_id, $db)
{
  $sql = "SELECT subject_id, subject_name, initialism FROM subjects WHERE subject_id = :subject_id";
  $subject = $db->execute($sql, ['subject_id' => $subject_id]);
  $subject = $subject->fetch(PDO::FETCH_ASSOC);

  return $subject;
}
