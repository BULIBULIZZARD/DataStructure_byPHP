<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/11
 * Time: 18:59
 */

require_once "UF.php";
require_once "../base/myException.php";

class UnionFind1 implements UF
{
    private $id;

    public function __construct($size)
    {
        for ($i = 0; $i < $size; $i++) {
            $this->id[$i] = $i;
        }
    }

    public function getSize()
    {
        return sizeof($this->id);
    }


    /**
     * @param $p
     * @return mixed
     * 查询p所在集合编号
     * O(1)
     */
    private function find($p)
    {
        if ($p < 0 || $p >= sizeof($this->id))
            (new myException("p is out of range"))->throw_me();
        return $this->id[$p];
    }

    /**
     * @param $p
     * @param $q
     * @return bool
     * 查看p q 是否属于同一个集合
     * O(1)
     */
    public function isConnected($p, $q)
    {
        return $this->find($p) == $this->find($q);
    }

    /**
     * @param $p
     * @param $q
     * 将p q 集合合并 保留q_id
     * O(n)
     */
    public function unionElements($p, $q)
    {
        $pID = $this->find($p);
        $qID = $this->find($q);
        if ($pID == $qID) {
            return;
        }

        for ($i = 0; $i < sizeof($this->id); $i++) {
            if ($this->id[$i] == $pID) {
                $this->id[$i] = $qID;
            }
        }
    }
}