<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/8
 * Time: 19:39
 */

interface Set
{
    function add($e);
    function remove($e);
    function contains($e);
    function getSize();
    function isEmpty();
}