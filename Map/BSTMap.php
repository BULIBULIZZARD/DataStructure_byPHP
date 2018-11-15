<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/9
 * Time: 10:40
 */
require_once "Map.php";
require_once "treeNode.php";
require_once "../base/myException.php";

use Map\treeNode;

class BSTMap implements Map
{

    private $root;
    private $size;

    public function __construct()
    {
        $this->root = null;
        $this->size = 0;
    }

    private function getNode($node ,$key){
        if($node==null)
            return null;
        if ($node->key == $key){
            return $node;
        }else if ($node->key > $key){
            return $this->getNode($node->left,$key);
        }else{
            return $this->getNode($node->right,$key);
        }
    }

    public function add($key, $value)
    {
        $this->root = $this->_add($this->root, $key, $value);
    }

    private function _add($node, $key, $value)
    {
        if ($node == null) {
            $this->size++;
            return $node = new treeNode($key, $value);
        }
        if ($node->key > $key) {
            $node->left = $this->_add($node->left, $key, $value);
        } else if ($node->key < $key) {
            $node->right = $this->_add($node->right, $key, $value);
        } else {
            $node->value = $value;
        }
        return $node;
    }



    public function contains($key)
    {
        return $this->getNode($this->root,$key)!=null;
    }

    public function get($key)
    {
        $node = $this->getNode($this->root,$key);
        return $node==null?null:$node->value;
    }

    public function set($key, $value)
    {
        $node = $this->getNode($this->root,$key);
        if ($node==null){
            (new myException($key."doesn't exist!"))->throw_me();
        }else{
            $node->value = $value;
        }
    }

    public function getSize()
    {
        return $this->size;
    }

    public function isEmpty()
    {
        return $this->size == 0;
    }


    /**
     * @param $node
     * @return mixed
     *
     */
    private function _minimum($node)
    {
        if ($node->left == null) {
            return $node;
        }
        return $this->_minimum($node->left);
    }

    private function _removeMin($node)
    {
        if ($node->left == null) {
            $rightNode = $node->right;
            $node->right = null;
            $this->size--;
            return $rightNode;
        }
        $node->left = $this->_removeMin($node->left);
        return $node;
    }



    public function remove($key)
    {
        $node = $this->getNode($this->root,$key);
        if ($node!=null){
            $this->root = $this->_remove($this->root, $key);
            return $node->value;
        }

        return null;
    }

    private function _remove($node, $key)
    {
        if ($node == null) {
            return null;
        }
        if ($key < $node->key) {
            $node->left = $this->_remove($node->left, $key);
        } else if ($key > $node->key) {
            $node->right = $this->_remove($node->right, $key);
        } else {
            if ($node->left == null) {
                $rightNode = $node->right;
                $node->right = null;
                $this->size--;
                return $rightNode;
            }
            if ($node->right == null) {
                $leftNode = $node->left;
                $node->left = null;
                $this->size--;
                return $leftNode;
            }

            $successor = $this->_minimum($node->right);
            $successor->right = $this->_removeMin($node->right);
            $successor->left = $node->left;
            $node->left = null;
            $node->right = null;
            return $successor;
        }
        return $node;
    }
}