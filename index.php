<?php

include 'Student.php';

// Get student ID from query string, there are 5 students in database
$student_id = $_GET['student'];

// Initialize student object
$student = new Student($student_id);
$student_data = $student->getStudent($student_id);

// Get board id, 1 is CSM, 2 is CSMB
$board_id = $student->getBoard($student_id)['board_id'];
$avg_grade = $student->calculateAvg($student_id);
$grades = $student->getStudentGrades($student_id);
// Calculate if student passes or not
if ($board_id == 1) {
    $pass = 'fail';
    if ($avg_grade['avg_grade'] >= 7) {
        $pass = 'pass';
    }
} elseif($board_id == 2) {
    $pass = 'fail';
    if (count($grades) > 2) {
        sort($grades);
        array_shift($grades);
    }
    if (max($grades)[0] > 8) {
        $pass = 'pass';
    }

} else {
    return 'Board ID missing';
}
$data = $student_data[0] + $avg_grade + ['grades' => $grades] + ['pass' => $pass];
$json_response = json_encode($data);

// Return json response or xml
if ($board_id == 1) {
    echo $json_response;
} else {
    $xml = $student->array2xml(json_decode($json_response));
    echo $xml;
}