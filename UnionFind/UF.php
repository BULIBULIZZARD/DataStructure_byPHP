<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/11
 * Time: 18:55
 */

interface UF
{
    public function getSize();

    public function isConnected($p, $q);

    public function unionElements($p, $q);
}