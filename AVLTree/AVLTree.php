<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/9
 * Time: 10:40
 */

namespace AVL;
require_once "Node.php";
require_once "../base/myException.php";

use AVL\Node as Node;
use myException;

class AVLTree
{

    private $root;
    private $size;

    public function __construct()
    {
        $this->root = null;
        $this->size = 0;
    }

    /**
     * @param $node
     * @return int
     * 获得node节点高度
     */
    private function getHeight($node)
    {
        if ($node == null) {
            return 0;
        }
        return $node->height;
    }

    /**
     * @param $node
     * @return int
     * 计算node节点平衡因子(左右子树高度差)
     */
    private function getBalanceFactor($node)
    {
        if ($node == 0)
            return 0;
        return $this->getHeight($node->left) - $this->getHeight($node->right);
    }

    private function getNode($node, $key)
    {
        if ($node == null)
            return null;
        if ($node->key == $key) {
            return $node;
        } else if ($node->key > $key) {
            return $this->getNode($node->left, $key);
        } else {
            return $this->getNode($node->right, $key);
        }
    }

    /**
     * @param $y
     * @return Node
     *             y                                  x
     *           /  \                              /   \
     *         x    T4        右旋转(y)         z       y
     *      /   \           - - - - - - - →  /  \   /  \
     *    z    T3                           T1  T2 T3  T4
     *  /  \
     * T1 T2
     */
    private function rightRotate($y)
    {
        $x = $y->left;
        $T3 = $x->right;

        $x->right = $y;
        $y->left = $T3;

        $y->height = max($this->getHeight($y->left), $this->getHeight($y->right)) + 1;
        $x->height = max($this->getHeight($x->left), $this->getHeight($x->right)) + 1;

        return $x;
    }

    /**
     * @param $y
     * @return Node
     *      y                                x
     *   /   \                            /    \
     *  T1   x        向左旋转(y)       y      z
     *     /  \      - - - - - - →   /  \   /  \
     *    T2  z                      T1  T2 T3  T4
     *      /  \
     *    T3   T4
     */
    private function leftRotate($y)
    {
        $x = $y->right;
        $T2 = $x->left;

        $x->left = $y;
        $y->right = $T2;

        $y->height = max($this->getHeight($y->left), $this->getHeight($y->right)) + 1;
        $x->height = max($this->getHeight($x->left), $this->getHeight($x->right)) + 1;

        return $x;
    }

    public function add($key, $value)
    {
        $this->root = $this->_add($this->root, $key, $value);
    }

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

        //更新height
        $node->height = 1 + max($this->getHeight($node->left), $this->getHeight($node->right));
        //计算平衡因子
        $balanceFactor = $this->getBalanceFactor($node);

        //平衡维护
        //LL
        if ($balanceFactor > 1 && $this->getBalanceFactor($node->left) >= 0) {
            return $this->rightRotate($node);
        }
        //RR
        if ($balanceFactor < -1 && $this->getBalanceFactor($node->right) <= 0) {
            return $this->leftRotate($node);
        }
        //LR
        if ($balanceFactor > 1 && $this->getBalanceFactor($node->left) < 0) {
            $node->left = $this->leftRotate($node->left);
            return $this->rightRotate($node);
        }
        //RL
        if ($balanceFactor < -1 && $this->getBalanceFactor($node->right) > 0) {
            $node->right = $this->rightRotate($node->right);
            return $this->leftRotate($node);
        }
        return $node;
    }


    public function contains($key)
    {
        return $this->getNode($this->root, $key) != null;
    }

    public function get($key)
    {
        $node = $this->getNode($this->root, $key);
        return $node == null ? null : $node->value;
    }

    public function set($key, $value)
    {
        $node = $this->getNode($this->root, $key);
        if ($node == null) {
            (new myException($key . "doesn't exist!"))->throw_me();
        } else {
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
     * @return bool
     * 判断当前结构是否满足 二分搜索树
     */
    public function isBST()
    {
        $keys = [];
        $this->inOrder($this->root, $keys);
        foreach (range(1, sizeof($keys) - 1) as $i) {
            if ($keys[$i] < $keys[$i - 1]) {
                return false;
            }
        }
        return true;
    }

    /**
     * @param $node
     * @param $keys
     * 中序遍历
     */
    private function inOrder($node, &$keys)
    {
        if ($node == null)
            return;
        $this->inOrder($node->left, $keys);
        array_push($keys, $node->key);
        $this->inOrder($node->right, $keys);
    }

    /**
     * @return bool
     * 判断当前结构是否为平衡
     */
    public function isBalanced()
    {
        return $this->_isBalanced($this->root);
    }


    private function _isBalanced($node)
    {
        if ($node == null) {
            return true;
        }
        $balanceFactor = $this->getBalanceFactor($node);
        if ($balanceFactor > 1)
            return false;
        return $this->_isBalanced($node->left) && $this->_isBalanced($node->right);
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

    public function remove($key)
    {
        $node = $this->getNode($this->root, $key);
        if ($node != null) {
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
        $retNode = null;
        if ($key < $node->key) {
            $node->left = $this->_remove($node->left, $key);
            $retNode = $node;
        } else if ($key > $node->key) {
            $node->right = $this->_remove($node->right, $key);
            $retNode = $node;
        } else {
            if ($node->left == null) {
                $rightNode = $node->right;
                $node->right = null;
                $this->size--;
                $retNode = $rightNode;
            }else if ($node->right == null) {
                $leftNode = $node->left;
                $node->left = null;
                $this->size--;
                $retNode = $leftNode;
            }else{
                $successor = $this->_minimum($node->right);
                $successor->right = $this->_remove($node->right,$successor->key);
                $successor->left = $node->left;
                $node->left = null;
                $node->right = null;
                $this->size--;
                $retNode = $successor;
            }
        }

        if ($retNode==null){
            return null;
        }
        //更新height
        $retNode->height = 1 + max($this->getHeight($retNode->left), $this->getHeight($retNode->right));
        //计算平衡因子
        $balanceFactor = $this->getBalanceFactor($retNode);

        //平衡维护
        //LL
        if ($balanceFactor > 1 && $this->getBalanceFactor($retNode->left) >= 0) {
            return $this->rightRotate($retNode);
        }
        //RR
        if ($balanceFactor < -1 && $this->getBalanceFactor($retNode->right) <= 0) {
            return $this->leftRotate($retNode);
        }
        //LR
        if ($balanceFactor > 1 && $this->getBalanceFactor($retNode->left) < 0) {
            $retNode->left = $this->leftRotate($retNode->left);
            return $this->rightRotate($retNode);
        }
        //RL
        if ($balanceFactor < -1 && $this->getBalanceFactor($retNode->right) > 0) {
            $retNode->right = $this->rightRotate($retNode->right);
            return $this->leftRotate($retNode);
        }
        return $retNode;
    }
}