<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/6
 * Time: 12:11
 */

require_once 'myArray.php';
require_once 'student.php';

$arr = new myArray();
for ($i=0;$i<12;$i++){
    $arr->addLast($i);
}
echo $arr->toString();