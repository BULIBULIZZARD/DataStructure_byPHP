<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/7
 * Time: 20:42
 */

/**
 * Class BST
 * Binary Search Tree
 * no repeat
 */
require_once "Node.php";
require_once "../base/myException.php";

class BST
{
    private $root;
    private $size;

    public function __construct()
    {
        $this->root = null;
        $this->size = 0;
    }

    public function size()
    {
        return $this->size;
    }

    public function isEmpty()
    {
        return $this->size == 0;
    }

    public function add($e)
    {

        $this->root = $this->_add($this->root, $e);
    }

    private function _add($node, $e)
    {
        if ($node == null) {
            $this->size++;
            return $node = new treeNode($e);
        }
        if ($node->e > $e) {
            $node->left = $this->_add($node->left, $e);
        } else if ($node->e < $e) {
            $node->right = $this->_add($node->right, $e);
        }
        return $node;
    }

    public function contains($e)
    {
        return $this->_contains($this->root, $e);
    }

    private function _contains($node, $e)
    {
        if ($node == null) {
            return false;
        }
        if ($e == $node->e) {
            return true;
        } else if ($e < $node->e) {
            return $this->_contains($node->left, $e);
        } else {
            return $this->_contains($node->right, $e);
        }
    }

    /**
     * 递归前序遍历
     */
    public function preOrder()
    {
        $this->_preOrder($this->root);
    }

    private function _preOrder($node)
    {
        if ($node == null) return;
        echo $node->e . "\n";

        $this->_preOrder($node->left);
        $this->_preOrder($node->right);
    }

    /**
     * 非递归前序遍历
     * Stack DSF
     */
    public function preOrderNR()
    {
        $stack = [];
        array_push($stack, $this->root);
        while (sizeof($stack) != 0) {
            $cur = array_pop($stack);
            echo $cur->e . "\n";
            if ($cur->right != null) {
                array_push($stack, $cur->right);
            }
            if ($cur->left != null) {
                array_push($stack, $cur->left);
            }
        }
    }

    /**
     *  层序遍历
     *  Queue BSF
     */
    public function levelOrder()
    {
        $stack = [];
        array_push($stack, $this->root);
        while (sizeof($stack) != 0) {
            $cur = array_shift($stack);
            echo $cur->e . "\n";
            if ($cur->left != null) {
                array_push($stack, $cur->left);
            }
            if ($cur->right != null) {
                array_push($stack, $cur->right);
            }
        }
    }

    /**
     *  递归中序遍历
     */
    public function inOrder()
    {
        $this->_inOrder($this->root);
    }

    private function _inOrder($node)
    {
        if ($node == null) return;

        $this->_inOrder($node->left);
        echo $node->e . "\n";
        $this->_inOrder($node->right);
    }

    /**
     *  递归后序遍历
     */
    public function postOrder()
    {
        $this->_postOrder($this->root);
    }

    private function _postOrder($node)
    {
        if ($node == null) return;

        $this->_postOrder($node->left);
        $this->_postOrder($node->right);
        echo $node->e . "\n";
    }


    public function printTree()
    {
        $this->_printTree($this->root, 0);
    }

    private function _printTree($node, $depth)
    {
        if ($node == null) return;
        for ($i = 0; $i < $depth; $i++)
            echo '-';
        echo $node->e . "\n";

        $this->_printTree($node->left, $depth + 1);
        $this->_printTree($node->right, $depth + 1);

    }

    /**
     * @return mixed
     * 寻找BST 最小元素
     */
    public function minimum()
    {
        if ($this->size == 0) {
            (new myException("BST is empty!"))->throw_me();
        }
        return $this->_minimum($this->root)->e;

    }

    private function _minimum($node)
    {
        if ($node->left == null) {
            return $node;
        }
        return $this->_minimum($node->left);
    }


    /**
     * @return mixed
     * 寻找BST 最大元素
     */
    public function maximum()
    {
        if ($this->size == 0) {
            (new myException("BST is empty!"))->throw_me();
        }
        return $this->_maximum($this->root)->e;

    }

    private function _maximum($node)
    {
        if ($node->rigtht == null) {
            return $node;
        }
        return $this->_maximum($node->rigtht);
    }


    public function removeMin()
    {
        $ret = $this->minimum();
        $this->root = $this->_removeMin($this->root);
        return $ret;
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


    public function removeMax()
    {
        $ret = $this->maximum();
        $this->root = $this->_removeMax($this->root);
        return $ret;
    }

    private function _removeMax($node)
    {
        if ($node->right == null) {
            $leftNode = $node->left;
            $node->left = null;
            $this->size--;
            return $leftNode;
        }
        $node->right = $this->_removeMax($node->right);
        return $node;
    }

    public function remove($e)
    {
        $this->root = $this->_remove($this->root, $e);
    }

    private function _remove($node, $e)
    {
        if ($node == null) {
            return null;
        }
        if ($e < $node->e) {
            $node->left = $this->_remove($node->left, $e);
        } else if ($e > $node->e) {
            $node->right = $this->_remove($node->right, $e);
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