<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/13
 * Time: 10:24
 */

namespace Hash;

class Student
{
    private $grade;
    private $cls;
    private $firstName;
    private $lastName;

    public function __construct($grade, $cls, $firstName, $lastName)
    {
        $this->grade=$grade;
        $this->cls=$cls;
        $this->firstName=$firstName;
        $this->lastName=$lastName;
    }

    public function hashCode(){
        $B = 31;
        $hash = 0;
        $hash = $hash*$B+$this->grade;
        $hash = $hash*$B+$this->cls;
        $hash = $hash*$B+$this->firstName;
        $hash = $hash*$B+$this->lastName;
        return $hash;
    }
}