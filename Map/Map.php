<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/9
 * Time: 9:47
 */

interface Map
{
    public function add($key, $value);

    public function remove($key);

    public function contains($key);

    public function get($key);

    public function set($key, $value);

    public function getSize();

    public function isEmpty();
}