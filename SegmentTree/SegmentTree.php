<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/10
 * Time: 15:29
 */


require_once "../base/myException.php";

class SegmentTree
{
    private $data;
    private $tree;
    private $merger;

    public function __construct($arr, $merger)
    {
        $this->merger = $merger;
        $this->data = [];
        for ($i = 0; $i < sizeof($arr); $i++) {
            $this->data[$i] = $arr[$i];
        }

        for ($i = 0; $i < sizeof($arr) * 4; $i++) {
            $this->tree[$i] = null;
        }
        $this->buildSegmentTree(0, 0, sizeof($this->data) - 1);
    }

    private function buildSegmentTree($treeIndex, $l, $r)
    {

        if ($l == $r) {
            $this->tree[$treeIndex] = $this->data[$l];
            return;
        }
        $leftTreeIndex = $this->leftChild($treeIndex);
        $rightTreeIndex = $this->rightChild($treeIndex);
        $mid = (int)(($l + ($r - $l) / 2));
        $this->buildSegmentTree($leftTreeIndex, $l, $mid);
        $this->buildSegmentTree($rightTreeIndex, $mid + 1, $r);
        $this->tree[$treeIndex] = $this->merger->merge($this->tree[$leftTreeIndex], $this->tree[$rightTreeIndex]);

    }

    public function getSize()
    {
        return sizeof($this->data);
    }

    public function get($index)
    {
        if ($index < 0 || $index > sizeof($this->data)) {
            (new myException("Illegal index"))->throw_me();
        }
        return $this->data[$index];
    }

    private function leftChild($index)
    {
        return 2 * $index + 1;
    }

    private function rightChild($index)
    {
        return 2 * $index + 2;
    }

    public function query($queryL, $queryR)
    {
        if ($queryL < 0 || $queryR >= sizeof($this->data) || $queryL > $queryR) {
            (new myException("Illegal index"))->throw_me();
        }

        return $this->_query(0, 0, sizeof($this->data) - 1, $queryL, $queryR);

    }

    //以treeIndex 为根[l,r]范围查询 [queryL,queryR]的值
    private function _query($treeIndex, $l, $r, $queryL, $queryR)
    {
        if ($l == $queryL && $r == $queryR) {
            return $this->tree[$treeIndex];
        }
        $mid = (int)(($l + ($r - $l) / 2));
        $leftTreeIndex = $this->leftChild($treeIndex);
        $rightTreeIndex = $this->rightChild($treeIndex);
        if ($queryL >= $mid + 1) {
            return $this->_query($rightTreeIndex, $mid + 1, $r, $queryL, $queryR);
        } else if ($queryR <= $mid) {
            return $this->_query($leftTreeIndex, $l, $mid, $queryL, $queryR);
        }

        $leftResult = $this->_query($leftTreeIndex, $l, $mid, $queryL, $mid);
        $rightResult = $this->_query($rightTreeIndex, $mid + 1, $r, $mid + 1, $queryR);
        return $this->merger->merge($leftResult, $rightResult);

    }

    public function set($index, $e)
    {
        if ($index < 0 || $index >= sizeof($this->data)) {
            (new myException("Illegal index"))->throw_me();
        }
        $this->data[$index] = $e;
        $this->_set(0, 0, sizeof($this->data), $index, $e);
    }

    private function _set($treeIndex, $l, $r, $index, $e)
    {
        if ($l == $r) {
            $this->tree[$treeIndex] = $e;
            return;
        }
        $mid = (int)(($l + ($r - $l) / 2));
        $leftTreeIndex = $this->leftChild($treeIndex);
        $rightTreeIndex = $this->rightChild($treeIndex);

        if ($index >= $mid + 1) {
            $this->_set($rightTreeIndex, $mid + 1, $r, $index, $e);
        } else {
            $this->_set($leftTreeIndex, $l, $mid, $index, $e);
        }

        $this->tree[$treeIndex] = $this->merger->merge($this->tree[$leftTreeIndex], $this->tree[$rightTreeIndex]);
    }

    public function toString()
    {
        $string = "[";
        for ($i = 0; $i < sizeof($this->tree); $i++) {
            if ($this->tree[$i] !== null) {
                $string .= $this->tree[$i];
            } else {
                $string .= "null";
            }
            if ($i != sizeof($this->tree) - 1) {
                $string .= ",";
            }
        }
        $string .= "]";
        return $string;
    }
}