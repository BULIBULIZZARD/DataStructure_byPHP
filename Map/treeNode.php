<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/7
 * Time: 11:06
 */
namespace Map;

class treeNode
{
    public $key;
    public $value;
    public $left;
    public $right;

    public function __construct($key = null,$value = null)
    {
        $this->key = $key;
        $this->value = $value;
        $this->left=null;
        $this->right=null;
    }

    public function toString(){
        return $this->key." : ".$this->value;
    }
}