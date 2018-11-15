<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/6
 * Time: 18:48
 */

interface Stack
{
    public function getSize();
    public function isEmpty();
    public function push($e);
    public function pop();
    public function peek();
}