<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/11
 * Time: 19:18
 */
require_once "UF.php";
require_once "../base/myException.php";

class UnionFind2 implements UF
{
    private $parent;

    public function __construct($size)
    {
        for ($i = 0; $i < $size; $i++) {
            $this->parent[$i] = $i;
        }
    }

    public function getSize()
    {
        return sizeof($this->parent);
    }

    /**
     * @param $p
     * @return int
     * 查找元素p所在集合
     * O(h) h树高度
     */
    private function find($p)
    {
        if ($p < 0 || $p >= sizeof($this->parent)){
            (new myException("p is out of range"))->throw_me();
        }
        while ($p != $this->parent[$p])
        {
            $p = $this->parent[$p];
        }
        return $p;
    }

    /**
     * @param $p
     * @param $q
     * @return bool
     * O(h) h树高度
     */
    public function isConnected($p, $q)
    {
        return $this->find($p) == $this->find($q);
    }

    /**
     * @param $p
     * @param $q
     * p 的根节点指向 q的根节点
     * o(h) h树高度
     */
    public function unionElements($p, $q)
    {
        $pRoot = $this->find($p);
        $qRoot = $this->find($q);
        if ($pRoot == $qRoot) {
            return;
        }
        $this->parent[$pRoot] = $qRoot;
    }
}