<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/12
 * Time: 19:33
 */

namespace RBTree;

class Node
{
//    private $RED = true;
//    private $BLACK = false;

    public $key;
    public $value;
    public $left;
    public $right;
    public $color;

    public function __construct($key, $value)
    {
        $this->key = $key;
        $this->value = $value;
        $this->left = null;
        $this->right = null;
        $this->color = true;
    }



}