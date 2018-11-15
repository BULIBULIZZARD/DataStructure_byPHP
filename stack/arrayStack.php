<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/6
 * Time: 12:27
 */

require_once '../base/myException.php';
require_once '../array/myArray.php';
require_once 'stack.php';

class ArrayStack implements Stack
{

    private $array;

    public function __construct($capacity = 10)
    {
        $this->array = new myArray($capacity);
    }

    public function getSize()
    {
        return $this->array->getSize();
    }

    public function isEmpty()
    {
        return $this->array->isEmpty();
    }

    public function push($e)
    {
        $this->array->addLast($e);
    }

    public function pop()
    {
        return $this->array->removeLast();
    }

    public function peek()
    {
        if ($this->array->getSize()==0){
            return null;
        }
        return $this->array->getLast();
    }


    public function getCapacity()
    {
        return $this->array->getCapacity();
    }


    public function toString()
    {
        $string = "";
        $string .= "Stack: ";
        $string .= "[";
        for ($i = 0; $i < $this->array->getSize(); $i++) {
            $string .= $this->array->get($i);
            if ($i != $this->array->getSize() - 1) {
                $string .= ",";
            }
        }
        $string .= "] top\n";
        return $string;
    }
}