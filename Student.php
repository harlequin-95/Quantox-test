<?php

include 'DBManager.php';

class Student extends DBManager
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Calculate average grade
     *
     * @param $id
     * @return array
     */
    public function calculateAvg($id) {
        $grades = $this->getStudentGrades($id);
        $avg_grades = [];
        foreach ($grades as $grade) {
            $avg_grades[] = $grade[0];
        }
        $a = array_filter($avg_grades);
        $average = array_sum($a)/count($a);

        return ['avg_grade' => $average];
    }

    /**
     * Parse json to xml
     *
     * @param $jsonFile_decoded
     * @return mixed
     */
    function array2xml($jsonFile_decoded){

        $xml = new SimpleXMLElement('<student/>');

        $xml->addChild('id', $jsonFile_decoded->id);
        $xml->addChild('name', $jsonFile_decoded->student_name);
        $xml->addChild('avg_grade', $jsonFile_decoded->avg_grade);
        foreach ($jsonFile_decoded->grades as $grade) {
            foreach ($grade as $value) {
                $xml->addChild('grades', $value);
            }
        }
        $xml->addChild('pass', $jsonFile_decoded->pass);
        Header('Content-type: text/xml');

        return $xml->asXML();
    }


}