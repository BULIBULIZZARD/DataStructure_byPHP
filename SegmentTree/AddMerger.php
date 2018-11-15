<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/10
 * Time: 16:03
 */

require_once "Merger.php";

class AddMerger implements Merger
{

    function merge($a, $b)
    {
        return $a+$b;
    }
}