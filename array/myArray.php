<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/6
 * Time: 12:27
 */

require_once '../base/myException.php';

class myArray
{
    private $data = [];
    private $capacity;
    private $size;

    /**
     * myArray constructor.
     * @param $capacity
     * default $capacity 10
     */
    public function __construct($capacity = 10)
    {
        if (is_array($capacity)){
            for ($i=0;$i<sizeof($capacity);$i++){
                $this->data[$i]=$capacity[$i];
            }
            $this->size=sizeof($capacity);
            $this->capacity=sizeof($capacity);
        }else{
            $this->data = [$capacity];
            $this->capacity = $capacity;
            $this->size = 0;
        }

    }

    /**
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @return int
     */
    public function getCapacity()
    {
        return $this->capacity;
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return $this->size == 0;
    }

    /**
     * @param $e
     */
    public function addLast($e)
    {
        $this->add($this->size, $e);
    }

    /**
     * @param $e
     */
    public function addFirst($e)
    {
        $this->add(0, $e);
    }

    /**
     * @param $index
     * @param $e
     */
    public function add($index, $e)
    {
        if ($this->size == $this->capacity) {
            $this->resize(2 * sizeof($this->data));
        }
        if ($index < 0 || $index > $this->size) {
            (new myException("Add failed. index less then 0 or  greater than size\n"))->throw_me();
            return;
        }
        for ($i = $this->size - 1; $i >= $index; $i--) {
            $this->data[$i + 1] = $this->data[$i];

        }
        $this->data[$index] = $e;
        $this->size++;
    }

    /**
     * @return string
     */
    public function toString()
    {
        $result = "";
        $result .= "Array:size = " . $this->size . " ,capacity = " . $this->capacity . " \n";
        $result .= "[";
        for ($i = 0; $i < $this->size; $i++) {
            $result .= $this->data[$i];
            if ($i != $this->size - 1) {
                $result .= ",";
            }
        }
        $result .= "]\n";
        return $result;
    }

    /**
     * @param $index
     * @return mixed|string
     */
    public function get($index)
    {
        if ($index < 0 || $index >= $this->size) {
            (new myException("Add failed. index less then 0 or  greater than size\n"))->throw_me();
            return 'out of range';
        }
        return $this->data[$index];
    }
    public function getLast(){
        return $this->get($this->size-1);
    }
    public function getFirst(){
        return $this->get(0);
    }

    /**
     * @param $index
     * @param $e
     * @return bool
     */
    public function set($index, $e)
    {
        if ($index < 0 || $index >= $this->size) {
            (new myException("Add failed. index less then 0 or  greater than size\n"))->throw_me();
            return false;
        }
        $this->data[$index] = $e;
        return true;
    }

    /**
     * @param $e
     * @return bool
     */
    public function contains($e)
    {
        for ($i = 0; $i < $this->size; $i++) {
            if ($this->data[$i] == $e) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param $e
     * @return int
     */
    public function find($e)
    {
        for ($i = 0; $i < $this->size; $i++) {
            if ($this->data[$i] == $e) {
                return $i;
            }
        }
        return -1;
    }


    /**
     * @param $index
     * @return mixed|null
     */
    public function remove($index)
    {
        if ($index < 0 || $index >= $this->size) {
            (new myException("Add failed. index less then 0 or  greater than size\n"))->throw_me();
            return null;
        }
        $ret = $this->data[$index];
        for ($i = $index + 1; $i < $this->size; $i++) {
            $this->data[$i - 1] = $this->data[$i];
        }
        $this->size--;
        $this->data[$this->size] = null;

        if ($this->size == (int)($this->capacity / 4) && $this->capacity >= 10) {
            $this->resize((int)($this->capacity / 2));
        }
        return $ret;
    }

    /**
     * @return mixed|null
     */
    public function removeFirst()
    {
        return $this->remove(0);
    }

    /**
     * @return mixed|null
     */
    public function removeLast()
    {
        return $this->remove($this->size - 1);
    }

    /**
     * @param $e
     */
    public function removeElement($e)
    {
        $index = $this->find($e);
        if ($index != -1) {
            $this->remove($index);
        }
    }


    private function resize($newCapacity)
    {
        $this->capacity = $newCapacity;
    }

    public function swap($i,$j){
        if ($i<0||$i>=$this->size||$j<0||$j>=$this->size)
            (new myException("Illegal index"))->throw_me();

        $t = $this->data[$i];
        $this->data[$i]=$this->data[$j];
        $this->data[$j]=$t;
    }

    public function printData()
    {
        print_r($this->data);
    }

}