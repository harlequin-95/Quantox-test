<?php

include 'DBManager.php';

class Student extends DBManager
{
    private $id;
    private $name;
    private $grades_list;
    private $average;
    private $final_result;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function calculate($id) {
        $student_data = $this->getStudent($id);
        return $student_data;
    }


}