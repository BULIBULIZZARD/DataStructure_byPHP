<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/9
 * Time: 11:54
 */

require_once "../array/myArray.php";

class MaxHeap
{
    private $data;

    public function __construct($capacity = 10)
    {


        $this->data = new myArray($capacity);
        if (is_array($capacity)){
            echo "is array";
            for ($i=$this->data->getSize()-1;$i>=0;$i--){
                $this->siftDown($i);
            }
        }
    }


    public function size()
    {
        return $this->data->getSize();
    }

    public function isEmpty()
    {
        return $this->data->isEmpty();
    }


    /**
     * @param $index
     * @return int
     * 返回完全二叉树数组表示中的 父亲节点的索引
     */
    private function parent($index)
    {
        if ($index == 0) {
            (new myException("index -0 doesn't have parent"))->throw_me();
        }
        return (int)(($index - 1) / 2);
    }

    /**
     * @param $index
     * @return int
     * 左孩子节点的索引
     */
    private function leftChild($index)
    {
        return (int)($index * 2 + 1);
    }

    /**
     * @param $index
     * @return int
     * 右孩子节点的索引
     */
    private function rightChild($index)
    {
        return (int)($index * 2 + 2);
    }

    public function add($e)
    {
        $this->data->addLast($e);
        $this->siftUp($this->data->getSize() - 1);
    }

    public function siftUp($k)
    {
        while ($k > 0 && $this->data->get($k) > $this->data->get($this->parent($k))) {
            $this->data->swap($k, $this->parent($k));
            $k = $this->parent($k);
        }
    }

    public function findMax()
    {
        if ($this->data->getSize() == 0) {
            (new myException("Heap is empty"))->throw_me();
        }
        return $this->data->get(0);
    }

    public function extractMax()
    {
        $ret = $this->findMax();

        $this->data->swap(0, $this->data->getSize() - 1);
        $this->data->removeLast();
        $this->siftDown(0);

        return $ret;
    }

    public function siftDown($k)
    {
        while ($this->leftChild($k) < $this->data->getSize()) {
            $j = $this->leftChild($k);
            if ($j + 1 < $this->data->getSize() && $this->data->get($j + 1) > $this->data->get($j)) {
                $j = $this->rightChild($k);
            }

            if ($this->data->get($k)>=$this->data->get($j)){
                break;
            }
            $this->data->swap($k, $j);
            $k = $j;
        }
    }

    /**
     * @param $e
     * @return mixed|string
     * 返回最大值并将新元素添加进堆 进行下沉
     */
    public function replace($e){
        $ret = $this->findMax();
        $this->data->set(0,$e);
        $this->siftDown(0);
        return $ret;
    }



}