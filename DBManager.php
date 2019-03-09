<?php


class DBManager
{

    /**
     * Get student query
     *
     * @param $id
     * @return array
     */
    public function getStudent($id) {
        $db_connection = mysqli_connect('localhost', 'root', 'root', 'quantox');

        $query = $db_connection->query('SELECT DISTINCT s.id, s.name
FROM students s
WHERE s.id=' . $id);
        $result = $query->fetch_all();

        $student_data = [];
        foreach ($result as $row) {
            $student_data[] = [
                'id' => $row[0],
                'student_name' => $row[1],
            ];
        }

        return $student_data;
    }

    /**
     * Get Board ID that student belongs to
     *
     * @param $student_id
     * @return object
     */
    public function getBoard($student_id) {
        $db_connection = mysqli_connect('localhost', 'root', 'root', 'quantox');
        $query = $db_connection->query('SELECT board_id from students WHERE id=' . $student_id);

        $board = $query->fetch_array();

        return $board;
    }

    /**
     * Get student grades query
     *
     * @param $id
     * @return array
     */
    public function getStudentGrades($id) {
        $db_connection = mysqli_connect('localhost', 'root', 'root', 'quantox');

        $query = $db_connection->query('SELECT g.value
FROM students s
INNER JOIN student_grades sg ON s.id = sg.student_id  
INNER JOIN grades g ON sg.grade_id = g.grade_id
WHERE s.id=' . $id);
        $result = $query->fetch_all();

        $grades = [];
        foreach ($result as $row) {
            $grades[] = $row;
        }

        return $grades;
    }
}