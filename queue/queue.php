<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/6
 * Time: 20:10
 */

interface Queue
{
    public function getSize();
    public function isEmpty();
    public function enqueue($e);
    public function dequeue();
    public function getFront();
}