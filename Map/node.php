<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/7
 * Time: 11:06
 */
namespace Map;

class Node
{
    public $key;
    public $value;
    public $next;

    public function __construct($key = null,$value = null, $next = null)
    {
        $this->key = $key;
        $this->value = $value;
        $this->next = $next;
    }

    public function toString(){
        return $this->key." : ".$this->value;
    }
}