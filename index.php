<?php

include 'Student.php';

$student_id = $_GET['student'];

$student = new Student($student_id);
$data = $student->getStudent($student_id);
// Get board id, 1 is CSM, 2 is CSMB
$board_id = $student->getBoard($student_id);

$json_response = json_encode($data);
var_dump($json_response, $board_id);die;
