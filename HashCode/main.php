<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/13
 * Time: 10:18
 */

require_once "Student.php";

use Hash\Student as Student;

$student = new Student(3,2,'bobo','liu');

echo $student->hashCode()."\n";
echo crc32($student->hashCode());