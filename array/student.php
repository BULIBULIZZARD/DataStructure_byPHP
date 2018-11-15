<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/6
 * Time: 17:48
 */

class Student
{
    private $name;
    private $score;

    public function __construct($studentName,$studentScore)
    {
        $this->name=$studentName;
        $this->score=$studentScore;
    }

    public function toString(){
        return "Student(name: ".$this->name." ,score: ".$this->score." )";
    }
}