<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/10
 * Time: 15:44
 */

interface Merger
{
    /**
     * @param $a
     * @param $b
     * @return mixed
     * 线段树融合接口 按需实现
     */
    function merge($a,$b);
}