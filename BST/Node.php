<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/7
 * Time: 20:44
 */


class treeNode
{
    public $e;
    public $left;
    public $right;

    public function __construct($e)
    {
        $this->e = $e;
        $this->left = null;
        $this->right = null;
    }
}