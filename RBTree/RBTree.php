<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/12
 * Time: 19:37
 */

namespace RBTree;

require_once "Node.php";
require_once "../base/myException.php";

use RBTree\Node as Node;
use myException;

class RBTree
{
    private static $RED = true;
    private static $BLACK = false;
    private $root;
    private $size;

    public function __construct()
    {
        $this->root = null;
        $this->size = 0;
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return $this->size == 0;
    }

    /**
     * @param $node
     * @return bool
     * 判断node节点的颜色
     */
    private function isRed($node)
    {
        if ($node == null)
            return self::$BLACK;

        return $node->color;
    }

    /**
     * @param $node
     * @return Node
     *        node                          x
     *       /    \       左旋转         /    \
     *      T1    x     -------->      node  T3
     *          /  \                 /   \
     *        T2   T3              T1    T2
     */
    private function leftRotate($node)
    {
        $x = $node->right;
        //左旋转
        $node->right = $x->left;
        $x->left = $node;

        $x->color = $node->color;
        $node->color = self::$RED;

        return $x;
    }

    /**
     * @param $node
     * @return Node
     *          node                             x
     *         /  \      右旋转               /   \
     *       x    T2    ---------->         y    node
     *     /  \                                 /  \
     *    y   T1                              T1    T2
     */
    private function rightRotate($node)
    {
        $x = $node->left;
        //右旋转
        $node->left = $x->right;
        $x->right = $node;

        $x->color = $node->color;
        $node->color = self::$RED;
        return $x;
    }

    private function flipColor($node)
    {
        $node->color = self::$RED;
        $node->left->color = self::$BLACK;
        $node->right->color = self::$BLACK;
    }


    /**
     * @param $key
     * @param $value
     * 向红黑树中添加新元素
     */
    public function add($key, $value)
    {
        $this->root = $this->_add($this->root, $key, $value);
        $this->root->color = self::$BLACK;
    }

    /**
     * @param $node
     * @param $key
     * @param $value
     * @return Node
     * 以node为根向红黑树中添加 key value 的递归算法
     * 返回树根
     *       B                             B                          B                          R
     *      /                            /                         /   \                      /   \
     *     R      - leftRotate ->      R      - rightRotate ->   R     R   - flipColor ->   B     B
     *      \                        /
     *       R                     R
     */
    private function _add($node, $key, $value)
    {
        if ($node == null) {
            $this->size++;
            return $node = new Node($key, $value);
        }
        if ($node->key > $key) {
            $node->left = $this->_add($node->left, $key, $value);
        } else if ($node->key < $key) {
            $node->right = $this->_add($node->right, $key, $value);
        } else {
            $node->value = $value;
        }

        if ($this->isRed($node->right) && !$this->isRed($node->left))
            $node = $this->leftRotate($node);

        if ($this->isRed($node->left) && $this->isRed($node->left->left))
            $node = $this->rightRotate($node);

        if ($this->isRed($node->left) && $this->isRed($node->right))
            $this->flipColor($node);

        return $node;
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