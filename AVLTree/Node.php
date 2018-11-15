<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/7
 * Time: 11:06
 */
namespace AVL;

class Node
{
    public $key;
    public $value;
    public $left;
    public $right;
    public $height;

    public function __construct($key = null,$value = null)
    {
        $this->key = $key;
        $this->value = $value;
        $this->left=null;
        $this->right=null;
        $this->height=1;
    }

    public function toString(){
        return $this->key." : ".$this->value;
    }
}